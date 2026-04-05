<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SitePaletteService
{
    /** Cache palette per URL (24 hours). */
    private const CACHE_TTL_SECONDS = 86400;

    /**
     * @return array<int, array{primary_hex: string, secondary_hex: string}>
     */
    public static function palettesForFeatured(): array
    {
        $out = [];
        foreach (config('projects.featured', []) as $index => $project) {
            $fallback = [
                'primary_hex' => $project['ui']['primary_hex'] ?? '#64748b',
                'secondary_hex' => $project['ui']['secondary_hex'] ?? '#94a3b8',
            ];
            $url = $project['url'] ?? '';
            if ($url === '') {
                $out[$index] = $fallback;

                continue;
            }

            $cacheKey = 'site_palette:'.md5($url);
            $out[$index] = Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($url, $fallback) {
                $fetched = self::fetchPaletteFromUrl($url);

                return $fetched ?? $fallback;
            });
        }

        return $out;
    }

    /**
     * @return array{primary_hex: string, secondary_hex: string}|null
     */
    public static function fetchPaletteFromUrl(string $url): ?array
    {
        $html = self::httpGet($url);
        if ($html === null) {
            return null;
        }

        $combined = $html;

        if (preg_match_all('/<link[^>]+href=["\']([^"\']+\.css[^"\']*)["\'][^>]*>/i', $html, $m)) {
            $n = 0;
            foreach ($m[1] as $href) {
                $resolved = self::resolveUrl($url, $href);
                if (! self::sameHost($url, $resolved)) {
                    continue;
                }
                $css = self::httpGet($resolved);
                if ($css !== null) {
                    $combined .= "\n".$css;
                    $n++;
                    if ($n >= 4) {
                        break;
                    }
                }
            }
        }

        $semantic = self::paletteFromSemanticUtilityClasses($combined);
        if ($semantic !== null) {
            return $semantic;
        }

        $hexes = self::collectHexFrequencies($combined);
        if (count($hexes) === 0) {
            return null;
        }

        $primary = self::pickPrimary($hexes);
        $secondary = self::pickSecondary($hexes, $primary);

        return [
            'primary_hex' => $primary,
            'secondary_hex' => $secondary,
        ];
    }

    /**
     * Prefer Tailwind-style brand utilities (e.g. text-trust-900 { color: #... }).
     *
     * @return array{primary_hex: string, secondary_hex: string}|null
     */
    private static function paletteFromSemanticUtilityClasses(string $blob): ?array
    {
        preg_match_all(
            '/\.(?:text|bg|border|ring)-(?:trust|warm|emerald|teal|cyan|violet|sky|amber)-(?:\d{2,3})\b[^{]*\{[^}]*#([0-9a-fA-F]{6})/i',
            $blob,
            $m
        );
        $freq = [];
        foreach ($m[1] as $h) {
            $norm = '#'.strtoupper($h);
            $freq[$norm] = ($freq[$norm] ?? 0) + 1;
        }
        if (count($freq) < 2) {
            return null;
        }
        arsort($freq);
        $keys = array_keys($freq);
        $primary = $keys[0];
        $secondary = $keys[1];
        foreach ($keys as $h) {
            if ($h !== $primary && self::colorDistance($h, $primary) > 25) {
                $secondary = $h;
                break;
            }
        }

        return [
            'primary_hex' => $primary,
            'secondary_hex' => $secondary,
        ];
    }

    private static function httpGet(string $url): ?string
    {
        try {
            $response = Http::timeout(18)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; PortfolioPalette/1.0)',
                    'Accept' => 'text/html,application/xhtml+xml,text/css,*/*;q=0.8',
                ])
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            return $response->body();
        } catch (\Throwable) {
            return null;
        }
    }

    private static function baseUrl(string $url): string
    {
        $p = parse_url($url);
        $scheme = $p['scheme'] ?? 'https';
        $host = $p['host'] ?? '';

        return $scheme.'://'.$host;
    }

    private static function resolveUrl(string $pageUrl, string $href): string
    {
        $href = trim($href);
        if (preg_match('#^https?://#i', $href)) {
            return $href;
        }
        if (str_starts_with($href, '//')) {
            return (parse_url($pageUrl, PHP_URL_SCHEME) ?: 'https').':'.$href;
        }
        $base = rtrim(self::baseUrl($pageUrl), '/');
        if (str_starts_with($href, '/')) {
            return $base.$href;
        }

        $dir = dirname($pageUrl);

        return rtrim($dir, '/').'/'.$href;
    }

    private static function sameHost(string $a, string $b): bool
    {
        $ha = parse_url($a, PHP_URL_HOST);
        $hb = parse_url($b, PHP_URL_HOST);

        return $ha && $hb && strcasecmp((string) $ha, (string) $hb) === 0;
    }

    /**
     * @return array<string, int> hex (uppercase #RRGGBB) => count
     */
    private static function collectHexFrequencies(string $blob): array
    {
        preg_match_all('/#([0-9a-fA-F]{6})\b/', $blob, $m);
        $counts = [];
        foreach ($m[0] as $h) {
            $norm = '#'.strtoupper(substr($h, 1));
            $counts[$norm] = ($counts[$norm] ?? 0) + 1;
        }
        arsort($counts);

        return array_filter(
            $counts,
            static fn (int $count, string $hex): bool => ! self::isNeutral($hex),
            ARRAY_FILTER_USE_BOTH
        );
    }

    private static function isNeutral(string $hex): bool
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) !== 6) {
            return true;
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $y = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
        if ($y > 0.9 || $y < 0.035) {
            return true;
        }

        return self::chroma($r, $g, $b) < 0.035;
    }

    /** Colorfulness 0–1 (max channel spread). */
    private static function chroma(int $r, int $g, int $b): float
    {
        $rn = $r / 255;
        $gn = $g / 255;
        $bn = $b / 255;

        return max($rn, $gn, $bn) - min($rn, $gn, $bn);
    }

    /** @param  array<string, int>  $hexes */
    private static function pickPrimary(array $hexes): string
    {
        foreach (array_keys($hexes) as $hex) {
            if (self::isGoodAccent($hex)) {
                return $hex;
            }
        }
        foreach (array_keys($hexes) as $hex) {
            if (! self::isNeutral($hex)) {
                return $hex;
            }
        }

        return '#64748b';
    }

    /**
     * @param  array<string, int>  $hexes
     */
    private static function pickSecondary(array $hexes, string $primary): string
    {
        foreach (array_keys($hexes) as $hex) {
            if ($hex === $primary) {
                continue;
            }
            if (! self::isGoodAccent($hex)) {
                continue;
            }
            if (self::colorDistance($hex, $primary) > 28) {
                return $hex;
            }
        }
        foreach (array_keys($hexes) as $hex) {
            if ($hex === $primary || self::isNeutral($hex)) {
                continue;
            }
            if (self::colorDistance($hex, $primary) > 28) {
                return $hex;
            }
        }

        return self::adjustBrightness($primary, 1.18);
    }

    private static function isGoodAccent(string $hex): bool
    {
        if (self::isNeutral($hex)) {
            return false;
        }
        $hex = ltrim($hex, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        return self::chroma($r, $g, $b) >= 0.06;
    }

    private static function colorDistance(string $a, string $b): float
    {
        $ra = hexdec(substr($a, 1, 2));
        $ga = hexdec(substr($a, 3, 2));
        $ba = hexdec(substr($a, 5, 2));
        $rb = hexdec(substr($b, 1, 2));
        $gb = hexdec(substr($b, 3, 2));
        $bb = hexdec(substr($b, 5, 2));

        return sqrt(($ra - $rb) ** 2 + ($ga - $gb) ** 2 + ($ba - $bb) ** 2);
    }

    private static function adjustBrightness(string $hex, float $factor): string
    {
        $r = min(255, (int) round(hexdec(substr($hex, 1, 2)) * $factor));
        $g = min(255, (int) round(hexdec(substr($hex, 3, 2)) * $factor));
        $b = min(255, (int) round(hexdec(substr($hex, 5, 2)) * $factor));

        return sprintf('#%02X%02X%02X', $r, $g, $b);
    }
}
