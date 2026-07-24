<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Arjun Kumar H — Full Stack Developer & MBA graduate. Laravel, React, React Native, and polished product builds.">
    <meta name="keywords" content="Arjun Kumar H, Full Stack Developer, Laravel, React, React Native, MBA, web development">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <title>Arjun Kumar H · Full Stack Developer & MBA</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Arjun Kumar H · Full Stack Developer & MBA">
    <meta property="og:description" content="Premium full stack builds — Laravel, React, React Native, and polished product delivery.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ url('/images/arjun-hero-cutout.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Arjun Kumar H · Full Stack Developer & MBA">
    <meta name="twitter:description" content="Premium full stack builds — Laravel, React, React Native, and polished product delivery.">
    <meta name="twitter:image" content="{{ url('/images/arjun-hero-cutout.png') }}">
    <link rel="icon" type="image/svg+xml" href="/ak-favicon.svg?v=1">
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Person",
            "name": "Arjun Kumar H",
            "url": "{{ url('/') }}",
            "image": "{{ url('/images/arjun-hero-cutout.png') }}",
            "jobTitle": "Full Stack Developer",
            "description": "Full Stack Developer and MBA graduate building scalable web and mobile products.",
            "email": "arjunh2194@gmail.com",
            "telephone": "+919995956770",
            "address": {
                "@@type": "PostalAddress",
                "addressLocality": "Thiruvananthapuram",
                "addressRegion": "Kerala",
                "addressCountry": "IN"
            },
            "sameAs": [
                "https://www.linkedin.com/in/arjunkumar21/"
            ]
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700;12..96,800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <style>
        :root {
            --bg: #041C1A;
            --bg-2: #0B2F2B;
            --green: #16E38A;
            --gold: #FFC94A;
            --white: #F8F8F8;
            --gray: #AAB5B1;
            --glass: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.12);
            --glow-green: 0 0 40px rgba(22, 227, 138, 0.35);
            --glow-gold: 0 0 40px rgba(255, 201, 74, 0.28);
            --radius: 20px;
            --nav-w: 88px;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: "Outfit", system-ui, sans-serif;
            background: var(--bg);
            color: var(--white);
            overflow-x: hidden;
            line-height: 1.55;
        }

        h1, h2, h3, h4, .display {
            font-family: "Bricolage Grotesque", "Outfit", sans-serif;
            font-optical-sizing: auto;
            letter-spacing: -0.02em;
            line-height: 1.08;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* —— Atmosphere —— */
        .site-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(ellipse 70% 50% at 15% 10%, rgba(22, 227, 138, 0.14), transparent 55%),
                radial-gradient(ellipse 55% 45% at 85% 20%, rgba(255, 201, 74, 0.1), transparent 50%),
                radial-gradient(ellipse 60% 40% at 50% 90%, rgba(22, 227, 138, 0.08), transparent 55%),
                linear-gradient(180deg, #041C1A 0%, #062420 40%, #041C1A 100%);
        }
        .aurora {
            position: absolute;
            inset: -20% -10%;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(22, 227, 138, 0.22), transparent 42%),
                radial-gradient(ellipse at 80% 20%, rgba(255, 201, 74, 0.12), transparent 40%),
                radial-gradient(ellipse at 60% 70%, rgba(11, 47, 43, 0.8), transparent 45%);
            filter: blur(60px);
            animation: aurora-drift 18s ease-in-out infinite alternate;
            opacity: 0.85;
        }
        @keyframes aurora-drift {
            from { transform: translate3d(-2%, 0, 0) scale(1); }
            to { transform: translate3d(3%, 2%, 0) scale(1.05); }
        }
        #particle-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0.55;
        }

        .shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding-left: var(--nav-w);
        }
        @media (max-width: 900px) {
            .shell { padding-left: 0; padding-bottom: 72px; }
        }

        /* —— Vertical nav —— */
        .side-nav {
            position: fixed;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 50;
            width: 64px;
            padding: 14px 10px;
            border-radius: 24px;
            background: rgba(8, 36, 33, 0.72);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .side-nav .brand {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-family: "Bricolage Grotesque", sans-serif;
            font-weight: 800;
            font-size: 0.72rem;
            color: var(--bg);
            background: linear-gradient(145deg, var(--green), #0fb872);
            box-shadow: var(--glow-green);
            margin-bottom: 6px;
            text-decoration: none;
        }
        .side-nav a.nav-ico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--gray);
            text-decoration: none;
            transition: color 0.25s ease, background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
            position: relative;
        }
        .side-nav a.nav-ico:hover,
        .side-nav a.nav-ico.is-active {
            color: var(--white);
            background: rgba(22, 227, 138, 0.12);
            box-shadow: inset 0 0 0 1px rgba(22, 227, 138, 0.35);
            transform: translateY(-1px);
        }
        .side-nav a.nav-ico[data-tip]::after {
            content: attr(data-tip);
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%) translateX(-4px);
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 500;
            white-space: nowrap;
            background: rgba(11, 47, 43, 0.95);
            border: 1px solid var(--glass-border);
            color: var(--white);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        .side-nav a.nav-ico:hover::after {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }
        .side-nav .socials {
            margin-top: 8px;
            padding-top: 10px;
            border-top: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .side-nav .socials a {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            color: var(--gray);
            text-decoration: none;
            transition: color 0.2s ease, background 0.2s ease;
        }
        .side-nav .socials a:hover { color: var(--green); background: rgba(22,227,138,0.1); }

        .mobile-bar {
            display: none;
            position: fixed;
            left: 12px;
            right: 12px;
            bottom: 12px;
            z-index: 50;
            height: 58px;
            border-radius: 18px;
            background: rgba(8, 36, 33, 0.88);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(16px);
            padding: 0 8px;
            align-items: center;
            justify-content: space-around;
        }
        .mobile-bar a {
            color: var(--gray);
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            text-decoration: none;
        }
        .mobile-bar a.is-active,
        .mobile-bar a:hover { color: var(--green); background: rgba(22,227,138,0.12); }
        @media (max-width: 900px) {
            .side-nav { display: none; }
            .mobile-bar { display: flex; }
        }

        /* —— Shared —— */
        .wrap {
            width: min(1180px, calc(100% - 2.5rem));
            margin: 0 auto;
        }
        @media (max-width: 640px) {
            .wrap { width: min(100%, calc(100% - 1.5rem)); }
        }

        .glass {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: var(--radius);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255,255,255,0.06);
        }

        .section {
            padding: 5.5rem 0;
            position: relative;
        }
        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 0.85rem;
        }
        .section-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--green);
            box-shadow: 0 0 12px var(--green);
        }
        .section-title {
            font-size: clamp(1.85rem, 4vw, 2.75rem);
            font-weight: 700;
            color: var(--white);
            max-width: 18ch;
        }
        .section-lead {
            margin-top: 0.85rem;
            color: var(--gray);
            font-size: 1rem;
            max-width: 42ch;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            border-radius: 999px;
            padding: 0.85rem 1.45rem;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease, border-color 0.25s ease;
            cursor: pointer;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--green), #0fbf72);
            color: #04221e;
            box-shadow: var(--glow-green);
        }
        .btn-primary:hover { box-shadow: 0 0 50px rgba(22, 227, 138, 0.5); }
        .btn-ghost {
            background: rgba(255,255,255,0.05);
            border-color: var(--glass-border);
            color: var(--white);
            backdrop-filter: blur(10px);
        }
        .btn-ghost:hover {
            border-color: rgba(22, 227, 138, 0.45);
            box-shadow: 0 0 24px rgba(22, 227, 138, 0.15);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.72rem;
            font-weight: 500;
            color: #d7f8ea;
            background: rgba(22, 227, 138, 0.1);
            border: 1px solid rgba(22, 227, 138, 0.22);
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }
        .d1 { transition-delay: 0.08s; }
        .d2 { transition-delay: 0.16s; }
        .d3 { transition-delay: 0.24s; }
        .d4 { transition-delay: 0.32s; }

        /* —— Hero —— */
        .hero {
            min-height: 100svh;
            display: grid;
            align-items: center;
            padding: 4rem 0 3rem;
            position: relative;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 2.5rem;
            align-items: center;
        }
        @media (max-width: 980px) {
            .hero-grid { grid-template-columns: 1fr; gap: 2rem; }
        }
        .availability {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.4rem 0.85rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--green);
            background: rgba(22, 227, 138, 0.08);
            border: 1px solid rgba(22, 227, 138, 0.25);
        }
        .availability .dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: var(--green);
            box-shadow: 0 0 10px var(--green);
            animation: pulse-dot 1.8s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.55; transform: scale(0.85); }
        }
        .hero h1 {
            margin: 1.1rem 0 0;
            font-size: clamp(2.4rem, 6vw, 4.2rem);
            font-weight: 700;
            letter-spacing: -0.035em;
        }
        .hero h1 span.accent {
            background: linear-gradient(120deg, var(--green), #8af5c4 45%, var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero-roles {
            margin-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
        }
        .hero-bio {
            margin-top: 1.25rem;
            color: var(--gray);
            font-size: 1.02rem;
            max-width: 38ch;
        }
        .hero-ctas {
            margin-top: 1.75rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .hero-stage {
            position: relative;
            display: grid;
            place-items: center;
            min-height: 420px;
        }
        .hero-ring {
            position: absolute;
            width: min(92%, 420px);
            aspect-ratio: 1;
            border-radius: 999px;
            border: 1px solid rgba(255, 201, 74, 0.35);
            box-shadow: 0 0 0 1px rgba(22, 227, 138, 0.12), var(--glow-gold);
            animation: spin-slow 28s linear infinite;
        }
        .hero-ring::before {
            content: "";
            position: absolute;
            inset: 18px;
            border-radius: inherit;
            border: 1px dashed rgba(22, 227, 138, 0.35);
            animation: spin-slow 18s linear infinite reverse;
        }
        .hero-ring::after {
            content: "";
            position: absolute;
            inset: -30px;
            border-radius: inherit;
            background: radial-gradient(circle, rgba(255, 201, 74, 0.18), transparent 62%);
            filter: blur(18px);
            z-index: -1;
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .hero-portrait-wrap {
            position: relative;
            z-index: 2;
            width: min(78%, 340px);
            aspect-ratio: 1;
            border-radius: 50%;
            overflow: hidden;
            animation: float-y 6s ease-in-out infinite;
            box-shadow: 0 30px 40px rgba(0, 0, 0, 0.35);
        }
        .hero-portrait {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 18%;
            filter: grayscale(1) contrast(1.08);
            mix-blend-mode: screen;
        }
        @keyframes float-y {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float-card {
            position: absolute;
            z-index: 3;
            padding: 0.85rem 1rem;
            max-width: 200px;
            animation: float-y 7s ease-in-out infinite;
        }
        .float-card.right {
            right: 0;
            top: 28%;
            animation-delay: 0.6s;
        }
        .float-card.left {
            left: 0;
            bottom: 14%;
            animation-delay: 1.2s;
        }
        .float-card .ico {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: rgba(22, 227, 138, 0.15);
            color: var(--green);
            margin-bottom: 0.45rem;
        }
        .float-card p {
            margin: 0;
            font-size: 0.78rem;
            color: var(--gray);
        }
        .float-card strong {
            display: block;
            color: var(--white);
            font-size: 0.82rem;
            margin-bottom: 0.2rem;
        }
        @media (max-width: 640px) {
            .float-card { display: none; }
            .hero-stage { min-height: 340px; }
        }

        /* —— Stats —— */
        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.85rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
        @media (max-width: 980px) { .stats { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 560px) { .stats { grid-template-columns: repeat(2, 1fr); } }
        .stat-card {
            padding: 1.15rem 1rem;
            text-align: left;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            border-color: rgba(22, 227, 138, 0.35);
            box-shadow: 0 16px 36px rgba(0,0,0,0.3), 0 0 24px rgba(22,227,138,0.12);
        }
        .stat-card .ico {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: rgba(22, 227, 138, 0.12);
            color: var(--green);
            margin-bottom: 0.75rem;
        }
        .stat-card .num {
            font-family: "Bricolage Grotesque", sans-serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--white);
        }
        .stat-card .lbl {
            margin-top: 0.25rem;
            font-size: 0.78rem;
            color: var(--gray);
        }

        /* —— Skills bento —— */
        .bento {
            margin-top: 2.25rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.9rem;
        }
        @media (max-width: 980px) { .bento { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .bento { grid-template-columns: 1fr; } }
        .bento-card {
            padding: 1.25rem;
            min-height: 160px;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .bento-card:hover {
            transform: translateY(-5px);
            border-color: rgba(22, 227, 138, 0.4);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3), 0 0 30px rgba(22,227,138,0.1);
        }
        .bento-card.wide { grid-column: span 2; }
        @media (max-width: 560px) { .bento-card.wide { grid-column: span 1; } }
        .bento-card h3 {
            margin: 0 0 0.85rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .bento-card h3 i { color: var(--green); }
        .bento-card .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        /* —— Projects —— */
        .project-rail {
            margin-top: 2.25rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        @media (max-width: 800px) { .project-rail { grid-template-columns: 1fr; } }
        .project-card {
            position: relative;
            overflow: hidden;
            padding: 0;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        }
        .project-card:hover {
            transform: translateY(-6px);
            border-color: rgba(22, 227, 138, 0.4);
            box-shadow: 0 24px 50px rgba(0,0,0,0.35), 0 0 40px rgba(22,227,138,0.12);
        }
        .project-visual {
            height: 170px;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 20% 30%, rgba(22,227,138,0.35), transparent 45%),
                radial-gradient(circle at 80% 40%, rgba(255,201,74,0.22), transparent 40%),
                linear-gradient(145deg, #0B2F2B, #051f1c);
        }
        .project-visual.has-image {
            background: #041C1A;
        }
        .project-visual .project-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
            transition: transform 0.45s ease;
        }
        .project-card:hover .project-visual .project-image {
            transform: scale(1.04);
        }
        .project-visual .mock {
            position: absolute;
            inset: 24px 20px 0;
            border-radius: 14px 14px 0 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
            border: 1px solid rgba(255,255,255,0.15);
            border-bottom: 0;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.25);
        }
        .project-visual .mock::before {
            content: "";
            position: absolute;
            top: 12px;
            left: 14px;
            right: 14px;
            height: 8px;
            border-radius: 999px;
            background: rgba(22, 227, 138, 0.35);
        }
        .project-visual .mock::after {
            content: "";
            position: absolute;
            top: 32px;
            left: 14px;
            width: 42%;
            height: 48px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            box-shadow: 56px 0 0 rgba(255,201,74,0.12), 0 58px 0 rgba(255,255,255,0.05);
        }
        .live-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #04221e;
            background: var(--green);
            box-shadow: var(--glow-green);
        }
        .live-badge .pulse {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #04221e;
            animation: pulse-dot 1.5s ease-in-out infinite;
        }
        .project-body {
            padding: 1.15rem 1.2rem 1.3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .project-body h3 {
            margin: 0;
            font-size: 1.15rem;
        }
        .project-body h3 a {
            color: var(--white);
            text-decoration: none;
        }
        .project-body h3 a:hover { color: var(--green); }
        .project-body .desc {
            margin: 0.55rem 0 0.9rem;
            color: var(--gray);
            font-size: 0.88rem;
            flex: 1;
        }
        .project-body .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            margin-bottom: 0.9rem;
        }
        .project-body .cta {
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.8rem;
            color: var(--green);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.02em;
            transition: gap 0.25s ease, color 0.25s ease;
        }
        .project-body .cta .cta-arrow {
            display: inline-flex;
            transition: transform 0.25s ease;
        }
        .project-body .cta:hover {
            gap: 0.7rem;
            color: #7dffb5;
        }
        .project-body .cta:hover .cta-arrow {
            transform: translateX(4px);
        }

        /* —— Certs —— */
        .cert-grid {
            margin-top: 2.25rem;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.85rem;
        }
        @media (max-width: 980px) { .cert-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 560px) { .cert-grid { grid-template-columns: repeat(2, 1fr); } }
        .cert-card {
            padding: 1.2rem 1rem;
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .cert-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 201, 74, 0.4);
        }
        .cert-card .logo {
            width: 48px;
            height: 48px;
            margin: 0 auto 0.75rem;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.06);
            color: var(--gold);
            font-size: 1.2rem;
        }
        .cert-card h3 {
            margin: 0;
            font-size: 0.88rem;
        }
        .cert-card p {
            margin: 0.35rem 0 0;
            font-size: 0.72rem;
            color: var(--gray);
        }
        .cert-card .check {
            margin-top: 0.65rem;
            color: var(--green);
            font-size: 0.85rem;
        }

        /* —— Journey (GSAP pinned timeline) —— */
        .journey-pin-section {
            position: relative;
            padding: 0;
            min-height: 100vh;
        }
        .journey-pin-inner {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4.5rem 0 3rem;
            box-sizing: border-box;
        }
        .journey-stage {
            margin-top: 1.75rem;
            display: grid;
            grid-template-columns: 8px 1fr;
            gap: 1.35rem;
            align-items: stretch;
            min-height: min(58vh, 420px);
        }
        .journey-progress-track {
            position: relative;
            width: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            overflow: hidden;
            align-self: stretch;
        }
        .journey-progress-bar {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            transform-origin: top center;
            transform: scaleY(0);
            border-radius: inherit;
            background: linear-gradient(180deg, var(--green), rgba(255, 201, 74, 0.85));
            box-shadow: 0 0 16px rgba(22, 227, 138, 0.45);
        }
        .journey-viewport {
            position: relative;
            min-height: min(58vh, 440px);
            isolation: isolate;
        }
        .journey-item {
            position: absolute;
            inset: 0;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0.35rem 0.25rem 0.35rem 0.15rem;
            border: 0;
            border-radius: 0;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            box-shadow: none;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(28px);
            will-change: opacity, transform;
        }
        .journey-item.is-active {
            z-index: 3;
            pointer-events: auto;
        }
        .journey-item .year {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--gold);
        }
        .journey-item h3 {
            margin: 0.55rem 0 0;
            font-size: clamp(1.35rem, 3vw, 2rem);
            letter-spacing: -0.02em;
        }
        .journey-item p {
            margin: 0.7rem 0 0;
            color: var(--gray);
            font-size: 1rem;
            max-width: 48ch;
            line-height: 1.55;
        }
        .journey-item .journey-detail {
            margin-top: 0.55rem;
            color: rgba(170, 181, 177, 0.9);
            font-size: 0.9rem;
            max-width: 46ch;
            line-height: 1.5;
            border-left: 2px solid rgba(22, 227, 138, 0.45);
            padding-left: 0.75rem;
        }
        .journey-meta {
            margin-top: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .journey-counter {
            font-family: "Syne", "Outfit", sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.04em;
        }
        .journey-counter span {
            color: var(--green);
        }
        .journey-dots {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }
        .journey-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            border: 0;
            padding: 0;
            cursor: default;
            transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }
        .journey-dot.is-on {
            background: var(--green);
            transform: scale(1.25);
            box-shadow: 0 0 12px rgba(22, 227, 138, 0.55);
        }
        .journey-hint {
            margin-top: 0.85rem;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(170, 181, 177, 0.75);
        }
        @media (max-width: 640px) {
            .journey-pin-inner {
                padding: 3.5rem 0 2rem;
            }
            .journey-stage,
            .journey-viewport {
                min-height: min(52vh, 360px);
            }
            .journey-item {
                padding: 1.15rem 1.1rem;
            }
        }
        .journey-no-gsap .journey-item {
            position: relative;
            inset: auto;
            opacity: 1;
            visibility: visible;
            transform: none;
            margin-bottom: 0.85rem;
            pointer-events: auto;
        }
        .journey-no-gsap .journey-viewport {
            min-height: 0;
        }
        .journey-no-gsap .journey-progress-bar {
            transform: scaleY(1);
        }

        /* —— Contact —— */
        .contact-grid {
            margin-top: 2.25rem;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 1rem;
        }
        @media (max-width: 900px) { .contact-grid { grid-template-columns: 1fr; } }
        .contact-info {
            padding: 1.75rem;
        }
        .contact-info h3 {
            margin: 0.5rem 0 0;
            font-size: 1.6rem;
        }
        .contact-info .sig {
            margin-top: 1.25rem;
            font-family: "Bricolage Grotesque", sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            background: linear-gradient(120deg, var(--green), var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .contact-links {
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }
        .contact-links a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            text-decoration: none;
            color: var(--white);
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--glass-border);
            transition: border-color 0.25s ease, background 0.25s ease;
        }
        .contact-links a:hover {
            border-color: rgba(22, 227, 138, 0.4);
            background: rgba(22, 227, 138, 0.08);
        }
        .contact-links a span.left {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 0.88rem;
        }
        .contact-links a span.left i { color: var(--green); }
        .contact-links a span.right {
            font-size: 0.75rem;
            color: var(--gray);
        }

        .contact-form {
            padding: 1.75rem;
        }
        .contact-form label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 0.4rem;
        }
        .contact-form .field { margin-bottom: 1rem; }
        .contact-two {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        @media (max-width: 560px) {
            .contact-two { grid-template-columns: 1fr; }
        }
        .contact-form input,
        .contact-form select,
        .contact-form textarea {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            background: rgba(0, 0, 0, 0.25);
            color: var(--white);
            padding: 0.85rem 1rem;
            font: inherit;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .contact-form input::placeholder,
        .contact-form textarea::placeholder { color: rgba(170, 181, 177, 0.55); }
        .contact-form input:focus,
        .contact-form select:focus,
        .contact-form textarea:focus {
            border-color: rgba(22, 227, 138, 0.55);
            box-shadow: 0 0 0 3px rgba(22, 227, 138, 0.12);
        }
        .contact-form select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2316E38A' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.4rem;
        }
        .contact-form select option { background: #0B2F2B; color: #F8F8F8; }
        .alert {
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .alert-ok {
            background: rgba(22, 227, 138, 0.12);
            border: 1px solid rgba(22, 227, 138, 0.35);
            color: #b8f7d8;
        }
        .alert-err {
            background: rgba(255, 100, 100, 0.1);
            border: 1px solid rgba(255, 120, 120, 0.35);
            color: #ffc9c9;
        }

        .site-footer {
            border-top: 1px solid var(--glass-border);
            padding: 2rem 0 3rem;
            margin-top: 2rem;
        }
        .site-footer .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }
        .site-footer p { margin: 0; color: var(--gray); font-size: 0.82rem; }
        .site-footer strong { color: var(--white); }
        .site-footer .links { display: flex; gap: 0.5rem; }
        .site-footer .links a {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--gray);
            text-decoration: none;
            border: 1px solid var(--glass-border);
            background: rgba(255,255,255,0.04);
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        .site-footer .links a:hover {
            color: var(--green);
            border-color: rgba(22, 227, 138, 0.4);
        }
    </style>
</head>
<body>
<div class="site-bg" aria-hidden="true">
    <div class="aurora"></div>
    <canvas id="particle-canvas"></canvas>
</div>

<aside class="side-nav" aria-label="Primary">
    <a href="#top" class="brand" title="Arjun Kumar H">AK</a>
    <a href="#top" class="nav-ico is-active" data-tip="Home" data-section="top"><i class="fa-solid fa-house"></i></a>
    <a href="#about" class="nav-ico" data-tip="About" data-section="about"><i class="fa-solid fa-user"></i></a>
    <a href="#skills" class="nav-ico" data-tip="Skills" data-section="skills"><i class="fa-solid fa-code"></i></a>
    <a href="#projects" class="nav-ico" data-tip="Projects" data-section="projects"><i class="fa-solid fa-diagram-project"></i></a>
    <a href="#certs" class="nav-ico" data-tip="Certifications" data-section="certs"><i class="fa-solid fa-certificate"></i></a>
    <a href="#contact" class="nav-ico" data-tip="Contact" data-section="contact"><i class="fa-solid fa-envelope"></i></a>
    <a href="#journey" class="nav-ico" data-tip="Journey" data-section="journey"><i class="fa-solid fa-route"></i></a>
    <div class="socials">
        <a href="https://www.linkedin.com/in/arjunkumar21/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="https://wa.me/919995956770" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
        <a href="mailto:arjunh2194@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
    </div>
</aside>

<nav class="mobile-bar" aria-label="Mobile">
    <a href="#top" class="is-active" data-section="top"><i class="fa-solid fa-house"></i></a>
    <a href="#skills" data-section="skills"><i class="fa-solid fa-code"></i></a>
    <a href="#projects" data-section="projects"><i class="fa-solid fa-diagram-project"></i></a>
    <a href="#contact" data-section="contact"><i class="fa-solid fa-envelope"></i></a>
    <a href="#journey" data-section="journey"><i class="fa-solid fa-route"></i></a>
</nav>

<div class="shell" id="top">
    {{-- HERO --}}
    <header class="hero wrap" id="about">
        <div class="hero-grid">
            <div class="hero-copy">
                <div class="availability reveal"><span class="dot"></span> Available for new opportunities</div>
                <h1 class="reveal d1">Hello, I'm <span class="accent">Arjun</span> Kumar H</h1>
                <div class="hero-roles reveal d2">
                    <span class="pill">Full Stack Developer</span>
                    <span class="pill">Laravel</span>
                    <span class="pill">React & React Native</span>
                    <span class="pill">MBA Graduate</span>
                </div>
                <p class="hero-bio reveal d3">
                    I design and ship scalable, user-friendly web and mobile products — from business platforms to polished brand sites — with clean architecture, sharp UI, and search-ready delivery.
                </p>
                <div class="hero-ctas reveal d4">
                    <a class="btn btn-primary" href="#contact"><i class="fa-solid fa-paper-plane"></i> Let's Connect</a>
                    <a class="btn btn-ghost" href="#projects"><i class="fa-solid fa-arrow-down"></i> View Work</a>
                    <a class="btn btn-ghost" href="mailto:arjunh2194@gmail.com?subject=Resume%20Request"><i class="fa-solid fa-file-arrow-down"></i> Resume</a>
                </div>
            </div>
            <div class="hero-stage reveal d2">
                <div class="hero-ring" aria-hidden="true"></div>
                <div class="hero-portrait-wrap">
                    <img class="hero-portrait" src="{{ asset('images/arjun-hero-cutout.png') }}" alt="Arjun Kumar H" width="420" height="520" loading="eager">
                </div>
                <div class="float-card glass right">
                    <div class="ico"><i class="fa-solid fa-code"></i></div>
                    <strong>Product mindset</strong>
                    <p>Turning ideas into products with clean code and great UI.</p>
                </div>
                <div class="float-card glass left">
                    <div class="ico"><i class="fa-solid fa-globe"></i></div>
                    <strong>Website craftsman</strong>
                    <p>Fast, polished sites built to convert and grow.</p>
                </div>
            </div>
        </div>
    </header>

    {{-- STATS --}}
    <section class="wrap" aria-label="Highlights">
        <div class="stats">
            <article class="stat-card glass reveal">
                <div class="ico"><i class="fa-solid fa-briefcase"></i></div>
                <div class="num">4+</div>
                <div class="lbl">Years Experience</div>
            </article>
            <article class="stat-card glass reveal d1">
                <div class="ico"><i class="fa-solid fa-rocket"></i></div>
                <div class="num">30+</div>
                <div class="lbl">Projects Completed</div>
            </article>
            <article class="stat-card glass reveal d2">
                <div class="ico"><i class="fa-solid fa-layer-group"></i></div>
                <div class="num">20+</div>
                <div class="lbl">Technologies</div>
            </article>
            <article class="stat-card glass reveal d3">
                <div class="ico"><i class="fa-solid fa-graduation-cap"></i></div>
                <div class="num">MBA</div>
                <div class="lbl">Graduate · CET</div>
            </article>
        </div>
    </section>

    {{-- SKILLS --}}
    <section class="section" id="skills">
        <div class="wrap">
            <p class="section-kicker reveal">Capabilities</p>
            <h2 class="section-title reveal d1">Skills & technologies</h2>
            <p class="section-lead reveal d2">A stacked toolkit across product, platform, and growth — arranged for how I actually ship.</p>
            <div class="bento">
                <article class="bento-card glass reveal">
                    <h3><i class="fa-solid fa-desktop"></i> Frontend</h3>
                    <div class="tags">
                        <span class="pill">React.js</span><span class="pill">Next.js</span><span class="pill">HTML5</span>
                        <span class="pill">CSS3</span><span class="pill">Tailwind</span><span class="pill">JavaScript</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d1">
                    <h3><i class="fa-solid fa-server"></i> Backend</h3>
                    <div class="tags">
                        <span class="pill">Laravel</span><span class="pill">Yii2</span><span class="pill">Django</span>
                        <span class="pill">REST APIs</span><span class="pill">PHP</span><span class="pill">Python</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d2">
                    <h3><i class="fa-solid fa-mobile-screen"></i> Mobile</h3>
                    <div class="tags">
                        <span class="pill">React Native</span><span class="pill">Expo</span><span class="pill">Android</span>
                        <span class="pill">iOS</span><span class="pill">Firebase</span><span class="pill">FCM</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d3">
                    <h3><i class="fa-solid fa-cloud"></i> Cloud</h3>
                    <div class="tags">
                        <span class="pill">AWS</span><span class="pill">Linux</span><span class="pill">VPS</span>
                        <span class="pill">CI/CD</span>
                    </div>
                </article>
                <article class="bento-card glass reveal">
                    <h3><i class="fa-solid fa-database"></i> Database</h3>
                    <div class="tags">
                        <span class="pill">MySQL</span><span class="pill">PostgreSQL</span><span class="pill">Redis</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d1">
                    <h3><i class="fa-solid fa-bullhorn"></i> Marketing</h3>
                    <div class="tags">
                        <span class="pill">SEO</span><span class="pill">Google Ads</span><span class="pill">Analytics</span>
                        <span class="pill">Search Console</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d2">
                    <h3><i class="fa-solid fa-gears"></i> DevOps</h3>
                    <div class="tags">
                        <span class="pill">Git</span><span class="pill">Docker</span><span class="pill">Nginx</span>
                        <span class="pill">Linux</span>
                    </div>
                </article>
                <article class="bento-card glass reveal d3">
                    <h3><i class="fa-solid fa-robot"></i> AI Tools</h3>
                    <div class="tags">
                        <span class="pill">Cursor</span><span class="pill">ChatGPT</span><span class="pill">Copilot</span>
                        <span class="pill">Prompting</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- PROJECTS --}}
    <section class="section" id="projects">
        <div class="wrap">
            <p class="section-kicker reveal">Featured work</p>
            <h2 class="section-title reveal d1">Products & platforms</h2>
            <p class="section-lead reveal d2">Business platforms, commerce, and brand sites — shipped with polish and performance.</p>
            <div class="project-rail">
                @foreach (config('projects.featured', []) as $i => $project)
                    @php
                        $projectImage = $project['image'] ?? null;
                        $projectImageUrl = null;
                        if (is_string($projectImage) && $projectImage !== '') {
                            if (str_starts_with($projectImage, 'http://') || str_starts_with($projectImage, 'https://')) {
                                $projectImageUrl = $projectImage;
                            } else {
                                $relative = ltrim($projectImage, '/');
                                if (is_file(public_path($relative))) {
                                    $projectImageUrl = asset($relative);
                                }
                            }
                        }
                    @endphp
                    <article class="project-card glass reveal {{ $i > 0 ? 'd' . min($i, 3) : '' }}">
                        <div class="project-visual {{ $projectImageUrl ? 'has-image' : '' }}">
                            <span class="live-badge"><span class="pulse"></span> Live</span>
                            @if ($projectImageUrl)
                                <img
                                    class="project-image"
                                    src="{{ $projectImageUrl }}"
                                    alt="{{ $project['title'] }} preview"
                                    loading="lazy"
                                    width="640"
                                    height="360"
                                >
                            @else
                                <div class="mock" aria-hidden="true"></div>
                            @endif
                        </div>
                        <div class="project-body">
                            <h3><a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer">{{ $project['title'] }}</a></h3>
                            <p class="desc">{{ $project['description'] }}</p>
                            <div class="meta">
                                <span class="pill">{{ $project['region_badge'] ?? 'Web' }}</span>
                                <span class="pill">Responsive</span>
                                <span class="pill">SEO</span>
                            </div>
                            <a class="cta" href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer">
                                {{ $project['cta_label'] ?? 'View project' }}
                                <span class="cta-arrow" aria-hidden="true">→</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CERTS --}}
    <section class="section" id="certs">
        <div class="wrap">
            <p class="section-kicker reveal">Credentials</p>
            <h2 class="section-title reveal d1">Certifications & achievements</h2>
            <div class="cert-grid">
                <article class="cert-card glass reveal">
                    <div class="logo"><i class="fa-brands fa-google"></i></div>
                    <h3>Google Ads</h3>
                    <p>Certification · 2022</p>
                    <div class="check"><i class="fa-solid fa-circle-check"></i></div>
                </article>
                <article class="cert-card glass reveal d1">
                    <div class="logo"><i class="fa-brands fa-meta"></i></div>
                    <h3>Meta Blueprint</h3>
                    <p>Certification · 2022</p>
                    <div class="check"><i class="fa-solid fa-circle-check"></i></div>
                </article>
                <article class="cert-card glass reveal d2">
                    <div class="logo"><i class="fa-brands fa-react"></i></div>
                    <h3>React</h3>
                    <p>Complete Guide · Udemy</p>
                    <div class="check"><i class="fa-solid fa-circle-check"></i></div>
                </article>
                <article class="cert-card glass reveal d3">
                    <div class="logo"><i class="fa-brands fa-laravel"></i></div>
                    <h3>Laravel</h3>
                    <p>Full stack mastery</p>
                    <div class="check"><i class="fa-solid fa-circle-check"></i></div>
                </article>
                <article class="cert-card glass reveal d4">
                    <div class="logo"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h3>MBA</h3>
                    <p>CET · Trivandrum</p>
                    <div class="check"><i class="fa-solid fa-circle-check"></i></div>
                </article>
            </div>
        </div>
    </section>

    {{-- CONTACT --}}
    <section class="section" id="contact">
        <div class="wrap">
            <p class="section-kicker reveal">Contact</p>
            <h2 class="section-title reveal d1">Let's build something amazing</h2>
            <p class="section-lead reveal d2">Share a brief — I'll reply the same day on WhatsApp or call.</p>
            <div class="contact-grid">
                <div class="contact-info glass reveal">
                    <p class="section-kicker" style="margin-bottom:0.4rem;">Get in touch</p>
                    <h3>Prefer a direct line?</h3>
                    <p style="margin:0.75rem 0 0; color:var(--gray); font-size:0.92rem;">Thiruvananthapuram, Kerala, India</p>
                    <div class="sig">Arjun Kumar H</div>
                    <div class="contact-links">
                        <a href="https://wa.me/919995956770" target="_blank" rel="noopener noreferrer">
                            <span class="left"><i class="fa-brands fa-whatsapp"></i> WhatsApp</span>
                            <span class="right">+91 99959 56770</span>
                        </a>
                        <a href="tel:+919995956770">
                            <span class="left"><i class="fa-solid fa-phone"></i> Call</span>
                            <span class="right">Mon–Sat</span>
                        </a>
                        <a href="mailto:arjunh2194@gmail.com">
                            <span class="left"><i class="fa-solid fa-envelope"></i> Email</span>
                            <span class="right">arjunh2194@gmail.com</span>
                        </a>
                        <a href="https://www.linkedin.com/in/arjunkumar21/" target="_blank" rel="noopener noreferrer">
                            <span class="left"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</span>
                            <span class="right">Profile</span>
                        </a>
                    </div>
                </div>
                <div class="contact-form glass reveal d2">
                    @if (session('contact_success'))
                        <div class="alert alert-ok" role="status"><strong>Inquiry sent.</strong> I’ll get back on the number you shared.</div>
                    @endif
                    @if (session('contact_error'))
                        <div class="alert alert-err" role="alert">{{ session('contact_error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-err" role="alert">
                            <strong>Please fix:</strong>
                            <ul style="margin:0.4rem 0 0; padding-left:1.1rem;">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="absolute -left-[9999px] w-px h-px overflow-hidden opacity-0" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;opacity:0;">
                            <label for="contact_hp">Leave empty</label>
                            <input type="text" name="contact_hp" id="contact_hp" tabindex="-1" autocomplete="off" value="">
                        </div>
                        <div class="field">
                            <label for="project_type">What are you building?</label>
                            <select name="project_type" id="project_type" required>
                                <option value="" disabled {{ old('project_type') ? '' : 'selected' }}>Select category…</option>
                                @foreach (config('contact.project_types', []) as $value => $label)
                                    <option value="{{ $value }}" {{ old('project_type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field contact-two">
                            <div>
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" placeholder="Your name">
                            </div>
                            <div>
                                <label for="phone">Mobile</label>
                                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required autocomplete="tel" inputmode="tel" placeholder="+91 98765 43210">
                            </div>
                        </div>
                        <div class="field">
                            <label for="message">Project details <span style="font-weight:400; opacity:0.7;">(optional)</span></label>
                            <textarea id="message" name="message" rows="4" placeholder="Timeline, scope, references…">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%; border:0;">
                            <i class="fa-solid fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- JOURNEY --}}
    @php
        $journeyZigzag = [
            [
                'year' => 'Present',
                'title' => 'Web Developer',
                'text' => 'Building scalable web and mobile products end to end — clean architecture, sharp UI, and SEO-ready delivery.',
                'detail' => 'Focus: Laravel, React, APIs, and maintainable systems that ship with polish.',
            ],
            [
                'year' => '2023',
                'title' => 'MBA (CET)',
                'text' => 'Completed MBA with a business lens on product, people, and growth decisions.',
                'detail' => 'School of Management — pairing engineering craft with clearer strategy.',
            ],
            [
                'year' => '2023',
                'title' => 'Web Developer',
                'text' => 'Shipped client-facing websites and product features across modern front-end and back-end stacks.',
                'detail' => 'From layout systems to integrations — built for speed, clarity, and conversion.',
            ],
            [
                'year' => '2022',
                'title' => 'Python Developer',
                'text' => 'Worked on backend scripting, service APIs, and automation that reduced manual effort.',
                'detail' => 'Reliable scripts, cleaner data flow, and faster day-to-day engineering loops.',
            ],
            [
                'year' => '2019',
                'title' => 'Technician — I',
                'text' => 'Hands-on technical support with real customers — diagnosing issues and closing them cleanly.',
                'detail' => 'Strong foundation in process, ownership, and clear communication under pressure.',
            ],
            [
                'year' => '2016',
                'title' => 'B.Tech Mechanical',
                'text' => 'Engineering degree that sharpened problem-solving before the move into software.',
                'detail' => 'Younus Institute of Technology — systems thinking that still shapes how I build.',
            ],
            [
                'year' => '2012',
                'title' => 'HSE — Computer Science',
                'text' => 'Higher Secondary with Computer Science — first structured step into code and digital systems.',
                'detail' => 'Where curiosity for software became a clear academic path.',
            ],
            [
                'year' => '2010',
                'title' => 'SSLC',
                'text' => 'Secondary School Leaving Certificate — the starting line of a long learning curve.',
                'detail' => 'Discipline, fundamentals, and the habit of finishing what I start.',
            ],
        ];
        $journeyCount = count($journeyZigzag);
    @endphp
    <section class="section journey-pin-section" id="journey" data-journey-count="{{ $journeyCount }}">
        <div class="wrap journey-pin-inner">
            <p class="section-kicker reveal">Growth</p>
            <h2 class="section-title reveal d1">My journey</h2>
            <p class="section-lead reveal d2">One chapter per scroll — neat, clear, and easy to follow.</p>

            <div class="journey-stage">
                <div class="journey-progress-track" aria-hidden="true">
                    <div class="journey-progress-bar" id="journeyProgressBar"></div>
                </div>
                <div>
                    <div class="journey-viewport" id="journeyViewport">
                        @foreach ($journeyZigzag as $i => $step)
                            <article class="journey-item" data-journey-index="{{ $i }}">
                                <div class="year">{{ $step['year'] }}</div>
                                <h3>{{ $step['title'] }}</h3>
                                <p>{{ $step['text'] }}</p>
                                @if (!empty($step['detail']))
                                    <p class="journey-detail">{{ $step['detail'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                    <div class="journey-meta">
                        <div class="journey-counter"><span id="journeyCurrent">01</span> / {{ str_pad((string) $journeyCount, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="journey-dots" id="journeyDots" aria-hidden="true">
                            @foreach ($journeyZigzag as $i => $step)
                                <span class="journey-dot {{ $i === 0 ? 'is-on' : '' }}" data-journey-dot="{{ $i }}"></span>
                            @endforeach
                        </div>
                    </div>
                    <p class="journey-hint">Scroll to continue the timeline</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="wrap row">
            <div>
                <p><strong>Arjun Kumar H</strong></p>
                <p style="margin-top:0.25rem;">Full Stack Developer · Laravel · React · MBA</p>
            </div>
            <div class="links">
                <a href="https://www.linkedin.com/in/arjunkumar21/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="mailto:arjunh2194@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                <a href="https://wa.me/919995956770" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="wrap row" style="margin-top:1.25rem; padding-top:1rem; border-top:1px solid var(--glass-border);">
            <p>© {{ date('Y') }} Arjun Kumar H. All rights reserved.</p>
            <p style="color:var(--gold);">Crafted with Laravel · dark emerald UI</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script>
(function () {
    var canvas = document.getElementById('particle-canvas');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');
    var particles = [];
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    function spawn() {
        particles = [];
        var count = Math.min(70, Math.floor((canvas.width * canvas.height) / 28000));
        for (var i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 1.8 + 0.4,
                vx: (Math.random() - 0.5) * 0.25,
                vy: (Math.random() - 0.5) * 0.25,
                a: Math.random() * 0.45 + 0.15
            });
        }
    }
    function frame() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(function (p) {
            if (!reduced) {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
            }
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(22, 227, 138,' + p.a + ')';
            ctx.fill();
        });
        if (!reduced) requestAnimationFrame(frame);
    }
    resize();
    spawn();
    frame();
    window.addEventListener('resize', function () { resize(); spawn(); });
})();

(function () {
    var nodes = document.querySelectorAll('.reveal');
    if (!nodes.length) return;
    function show(el) { el.classList.add('is-visible'); }
    if (!window.IntersectionObserver) {
        nodes.forEach(show);
        return;
    }
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                show(entry.target);
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    nodes.forEach(function (el) { io.observe(el); });
})();

(function () {
    var links = document.querySelectorAll('[data-section]');
    var map = {};
    links.forEach(function (a) {
        var id = a.getAttribute('data-section');
        if (!map[id]) map[id] = [];
        map[id].push(a);
    });
    var ids = Object.keys(map);
    function setActive(id) {
        links.forEach(function (a) { a.classList.remove('is-active'); });
        (map[id] || []).forEach(function (a) { a.classList.add('is-active'); });
    }
    if (!window.IntersectionObserver) return;
    var sections = ids.map(function (id) {
        return id === 'top' ? document.getElementById('top') : document.getElementById(id);
    }).filter(Boolean);
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var id = entry.target.id || 'top';
            setActive(id);
        });
    }, { threshold: 0.25, rootMargin: '-20% 0px -45% 0px' });
    sections.forEach(function (s) { io.observe(s); });
})();

(function () {
    var section = document.getElementById('journey');
    if (!section) return;

    var items = Array.prototype.slice.call(section.querySelectorAll('.journey-item'));
    var progressBar = document.getElementById('journeyProgressBar');
    var counter = document.getElementById('journeyCurrent');
    var dots = Array.prototype.slice.call(section.querySelectorAll('[data-journey-dot]'));
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var canGsap = window.gsap && window.ScrollTrigger && items.length && !reduced;
    var currentIndex = -1;
    var total = items.length;

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function updateChrome(index) {
        var safe = Math.max(0, Math.min(total - 1, index));
        items.forEach(function (item, i) {
            item.classList.toggle('is-active', i === safe);
        });
        dots.forEach(function (dot, i) {
            dot.classList.toggle('is-on', i <= safe);
        });
        if (counter) counter.textContent = pad(safe + 1);
        if (progressBar) {
            var scale = (safe + 1) / total;
            if (window.gsap) {
                gsap.set(progressBar, { scaleY: scale });
            } else {
                progressBar.style.transform = 'scaleY(' + scale + ')';
            }
        }
    }

    function showOnly(index, animate) {
        var safe = Math.max(0, Math.min(total - 1, index));
        if (safe === currentIndex) {
            updateChrome(safe);
            return;
        }
        currentIndex = safe;

        items.forEach(function (item, i) {
            if (i === safe) {
                if (animate) {
                    gsap.fromTo(
                        item,
                        { autoAlpha: 0, y: 24 },
                        { autoAlpha: 1, y: 0, duration: 0.28, ease: 'power2.out', overwrite: true, zIndex: 3 }
                    );
                } else {
                    gsap.set(item, { autoAlpha: 1, y: 0, zIndex: 3 });
                }
            } else {
                // Hide instantly so cards never overlap mid-scroll.
                gsap.set(item, { autoAlpha: 0, y: 18, zIndex: 1 });
            }
        });
        updateChrome(safe);
    }

    if (!canGsap) {
        section.classList.add('journey-no-gsap');
        items.forEach(function (item) {
            item.style.opacity = '1';
            item.style.visibility = 'visible';
            item.style.transform = 'none';
            item.style.position = 'relative';
        });
        currentIndex = total - 1;
        updateChrome(currentIndex);
        return;
    }

    gsap.registerPlugin(ScrollTrigger);
    gsap.set(items, { autoAlpha: 0, y: 24, zIndex: 1 });
    showOnly(0, false);

    ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: function () {
            // One full viewport of scroll distance per chapter.
            return '+=' + Math.round(window.innerHeight * total);
        },
        pin: true,
        scrub: 0.35,
        snap: {
            snapTo: function (value) {
                if (total <= 1) return 0;
                return Math.round(value * (total - 1)) / (total - 1);
            },
            duration: { min: 0.08, max: 0.22 },
            ease: 'power1.inOut',
        },
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: function (self) {
            var idx = total <= 1 ? 0 : Math.round(self.progress * (total - 1));
            showOnly(idx, true);
        },
        onLeave: function () {
            showOnly(total - 1, false);
        },
        onLeaveBack: function () {
            showOnly(0, false);
        },
    });

    window.addEventListener('load', function () {
        ScrollTrigger.refresh();
    });
})();
</script>
</body>
</html>
