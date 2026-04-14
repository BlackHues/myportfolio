<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request)) {
            $userAgent = substr((string) $request->userAgent(), 0, 1000);
            $ipAddress = $request->ip();
            $deviceInfo = $this->parseDeviceInfo($userAgent);
            $geo = $this->resolveGeo($ipAddress);

            VisitorLog::create([
                'path' => '/'.$request->path(),
                'full_url' => substr((string) $request->fullUrl(), 0, 2048),
                'query_string' => substr((string) $request->getQueryString(), 0, 2048),
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'device_type' => $deviceInfo['device_type'],
                'device_model' => $deviceInfo['device_model'],
                'browser' => $deviceInfo['browser'],
                'os' => $deviceInfo['os'],
                'is_bot' => $deviceInfo['is_bot'],
                'referer' => substr((string) $request->headers->get('referer'), 0, 1000),
                'utm_source' => $this->utmValue($request, 'utm_source'),
                'utm_medium' => $this->utmValue($request, 'utm_medium'),
                'utm_campaign' => $this->utmValue($request, 'utm_campaign'),
                'utm_term' => $this->utmValue($request, 'utm_term'),
                'utm_content' => $this->utmValue($request, 'utm_content'),
                'country' => $geo['country'],
                'region' => $geo['region'],
                'city' => $geo['city'],
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }

    private function shouldTrack(Request $request): bool
    {
        if (!$request->isMethod('GET')) {
            return false;
        }

        if ($request->ajax() || $request->prefetch()) {
            return false;
        }

        return !$request->is('admin/*')
            && !$request->is('up')
            && !$request->is('favicon.ico')
            && !$request->is('robots.txt');
    }

    private function utmValue(Request $request, string $key): ?string
    {
        $value = (string) $request->query($key, '');
        $trimmed = trim($value);

        return $trimmed === '' ? null : substr($trimmed, 0, 255);
    }

    private function parseDeviceInfo(string $ua): array
    {
        $uaLower = strtolower($ua);

        return [
            'device_type' => $this->detectDeviceType($uaLower),
            'device_model' => $this->detectDeviceModel($ua),
            'browser' => $this->detectBrowser($ua),
            'os' => $this->detectOs($ua),
            'is_bot' => $this->isBot($uaLower),
        ];
    }

    private function detectDeviceType(string $ua): string
    {
        if ($this->isBot($ua)) {
            return 'bot';
        }

        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'iphone') || str_contains($ua, 'android')) {
            return 'mobile';
        }

        return 'desktop';
    }

    private function detectBrowser(string $ua): string
    {
        if (preg_match('/Edg\/([\d\.]+)/i', $ua)) {
            return 'Edge';
        }

        if (preg_match('/OPR\/([\d\.]+)/i', $ua)) {
            return 'Opera';
        }

        if (preg_match('/Chrome\/([\d\.]+)/i', $ua)) {
            return 'Chrome';
        }

        if (preg_match('/Firefox\/([\d\.]+)/i', $ua)) {
            return 'Firefox';
        }

        if (preg_match('/Safari\/([\d\.]+)/i', $ua) && !preg_match('/Chrome\/|Chromium\/|Edg\//i', $ua)) {
            return 'Safari';
        }

        return 'Other';
    }

    private function detectOs(string $ua): string
    {
        $map = [
            'Windows' => '/Windows NT/i',
            'Android' => '/Android/i',
            'iOS' => '/iPhone|iPad|iPod/i',
            'macOS' => '/Macintosh|Mac OS X/i',
            'Linux' => '/Linux/i',
            'Chrome OS' => '/CrOS/i',
        ];

        foreach ($map as $name => $pattern) {
            if (preg_match($pattern, $ua)) {
                return $name;
            }
        }

        return 'Other';
    }

    private function detectDeviceModel(string $ua): ?string
    {
        if (preg_match('/Android[^;]*;\s*([^;\)]+)\s+Build\//i', $ua, $matches)) {
            return substr(trim($matches[1]), 0, 120);
        }

        if (preg_match('/\((iPhone|iPad)[^)]*\)/i', $ua, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function isBot(string $ua): bool
    {
        return preg_match('/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|whatsapp|telegram|discord|skypeuripreview/i', $ua) === 1;
    }

    private function resolveGeo(?string $ipAddress): array
    {
        if (!$ipAddress || $this->isPrivateOrLoopbackIp($ipAddress)) {
            return ['country' => null, 'region' => null, 'city' => null];
        }

        $cacheKey = 'geoip:'.sha1($ipAddress);

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($ipAddress): array {
            try {
                $response = Http::timeout(1.8)
                    ->retry(1, 100)
                    ->get("http://ip-api.com/json/{$ipAddress}", [
                        'fields' => 'status,country,regionName,city',
                    ]);

                if (!$response->ok()) {
                    return ['country' => null, 'region' => null, 'city' => null];
                }

                $payload = (array) $response->json();
                if (($payload['status'] ?? '') !== 'success') {
                    return ['country' => null, 'region' => null, 'city' => null];
                }

                return [
                    'country' => $this->truncateNullable($payload['country'] ?? null, 120),
                    'region' => $this->truncateNullable($payload['regionName'] ?? null, 120),
                    'city' => $this->truncateNullable($payload['city'] ?? null, 120),
                ];
            } catch (\Throwable) {
                return ['country' => null, 'region' => null, 'city' => null];
            }
        });
    }

    private function truncateNullable(mixed $value, int $maxLen): ?string
    {
        $text = trim((string) $value);
        if ($text === '') {
            return null;
        }

        return substr($text, 0, $maxLen);
    }

    private function isPrivateOrLoopbackIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
}
