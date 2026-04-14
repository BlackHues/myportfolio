<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hire Arjun Kumar H, a freelance full stack website developer for small businesses and startups. Affordable website development packages from Rs.5,000 with SEO setup, Search Console, and indexing support.">
    <meta name="keywords" content="hire web developer, freelance website developer, small business website developer, affordable website development, Laravel developer India, Django developer, React developer, SEO for small business website">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <title>Hire Website Developer for Small Business | Arjun Kumar H</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Hire Website Developer for Small Business | Arjun Kumar H">
    <meta property="og:description" content="Affordable freelance website developer for small-scale companies. Full stack builds, SEO setup, and indexing support starting from Rs.5,000.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ url('/images/arjun-hero-cutout.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hire Website Developer for Small Business | Arjun Kumar H">
    <meta name="twitter:description" content="Affordable full stack website development with SEO setup for startups and small businesses.">
    <meta name="twitter:image" content="{{ url('/images/arjun-hero-cutout.png') }}">
    <link rel="icon" type="image/svg+xml" href="/ak-favicon.svg?v=1">
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "ProfessionalService",
            "name": "Arjun Kumar H",
            "url": "{{ url('/') }}",
            "image": "{{ url('/images/arjun-hero-cutout.png') }}",
            "description": "Freelance full stack website developer helping startups and small businesses build affordable SEO-ready websites.",
            "areaServed": "India",
            "priceRange": "Rs.5,000 - Rs.15,000",
            "serviceType": [
                "Small business website development",
                "Laravel and Django web application development",
                "SEO setup and Google Search Console configuration"
            ]
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <style>
        :root {
            --hero-a: #0f4f4a;
            --hero-b: #0d3f3b;
            --hero-c: #0b3330;
            --sun: #f8b400;
            --text-main: #122029;
            --text-soft: #60707d;
            --line: #e3e8ec;
            --card: #ffffff;
            --mint: #0d5b54;
            --mint-soft: #eaf8f4;
            --shadow-sm: 0 8px 22px rgba(20, 35, 48, 0.08);
            --shadow-md: 0 18px 36px rgba(9, 24, 36, 0.16);
        }

        body {
            font-family: "Outfit", system-ui, sans-serif;
            background: #f7fafb;
            color: var(--text-main);
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition-duration: 0.01ms !important;
            }
        }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float-soft {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 rgba(248, 180, 0, 0.25); }
            50% { box-shadow: 0 0 0 14px rgba(248, 180, 0, 0.06); }
        }
        @keyframes glow-sweep {
            0%, 100% { text-shadow: 0 0 0 rgba(255, 226, 154, 0); }
            50% { text-shadow: 0 0 18px rgba(255, 226, 154, 0.35); }
        }
        @keyframes gentle-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        @keyframes spin-soft {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes shimmer {
            0%, 100% { opacity: 0.45; transform: translateX(-8px); }
            50% { opacity: 0.95; transform: translateX(8px); }
        }

        .hero-mesh {
            position: relative;
            background:
                radial-gradient(circle at 20% 30%, rgba(248, 180, 0, 0.14), transparent 28%),
                radial-gradient(circle at 78% 26%, rgba(255, 255, 255, 0.07), transparent 35%),
                linear-gradient(135deg, var(--hero-a) 0%, var(--hero-b) 55%, var(--hero-c) 100%);
            border-bottom-left-radius: 2.25rem;
            border-bottom-right-radius: 2.25rem;
            overflow: hidden;
            min-height: 100svh;
            display: flex;
            align-items: center;
        }
        .hero-mesh::after {
            content: "";
            position: absolute;
            left: -5%;
            right: -5%;
            bottom: -36px;
            height: 88px;
            border-radius: 0 0 999px 999px;
            background: #f7fafb;
            box-shadow: 0 -14px 30px rgba(5, 18, 25, 0.2);
        }
        .float-orb {
            background: rgba(248, 180, 0, 0.18) !important;
            animation: float-soft 7s ease-in-out infinite;
        }
        .orb-drift {
            background: rgba(255, 255, 255, 0.12) !important;
            animation: float-soft 10s ease-in-out infinite reverse;
        }

        .hero-reveal > * { opacity: 0; animation: fade-up 0.74s cubic-bezier(0.22, 1, 0.36, 1) forwards; }
        .hero-reveal > *:nth-child(1) { animation-delay: 0.06s; }
        .hero-reveal > *:nth-child(2) { animation-delay: 0.13s; }
        .hero-reveal > *:nth-child(3) { animation-delay: 0.2s; }
        .hero-reveal > *:nth-child(4) { animation-delay: 0.27s; }
        .hero-reveal > *:nth-child(5) { animation-delay: 0.34s; }
        .hero-reveal > *:nth-child(6) { animation-delay: 0.41s; }

        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1), transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.09s; }
        .reveal-delay-2 { transition-delay: 0.18s; }
        .reveal-delay-3 { transition-delay: 0.27s; }
        .reveal-delay-4 { transition-delay: 0.34s; }

        .card-lift {
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
        }
        .card-lift:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md) !important;
            border-color: rgba(13, 91, 84, 0.35) !important;
        }
        .photo-pop { opacity: 0; animation: fade-up 0.86s cubic-bezier(0.22, 1, 0.36, 1) 0.32s forwards; }
        .hero-title-glow { animation: glow-sweep 4.8s ease-in-out infinite; }
        .hero-cta-pop {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            animation: gentle-bounce 3.6s ease-in-out infinite;
        }
        .hero-cta-pop:hover {
            animation-play-state: paused;
            transform: translateY(-2px) scale(1.03);
        }
        .hero-copy {
            font-size: clamp(0.84rem, 2.5vw, 1rem);
            line-height: 1.55;
        }
        .hero-model-wrap {
            width: min(100%, 410px);
            position: relative;
            display: grid;
            place-items: center;
            isolation: isolate;
        }
        .hero-model-glow {
            position: absolute;
            inset: 14% 12% 10% 12%;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255, 215, 120, 0.25) 0%, rgba(16, 110, 103, 0.28) 35%, rgba(9, 40, 37, 0) 78%);
            filter: blur(12px);
            z-index: 0;
        }
        .hero-model-ring {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            z-index: 1;
        }
        .hero-model-ring.ring-a {
            width: 90%;
            height: 90%;
            animation: spin-soft 24s linear infinite;
        }
        .hero-model-ring.ring-b {
            width: 75%;
            height: 75%;
            border-style: dashed;
            border-color: rgba(248, 180, 0, 0.35);
            animation: spin-soft 18s linear infinite reverse;
        }
        .hero-model-pattern {
            position: absolute;
            inset: 20% 8% 8% 8%;
            border-radius: 1.75rem;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.2) 1.2px, transparent 1.2px);
            background-size: 14px 14px;
            opacity: 0.24;
            z-index: 1;
            animation: shimmer 4.2s ease-in-out infinite;
        }
        .hero-model-card {
            position: relative;
            z-index: 2;
            width: min(84%, 340px);
        }
        .hero-model-mobile-row {
            position: relative;
            z-index: 2;
        }
        .hero-model-meta {
            margin-top: 1rem;
            text-align: center;
        }
        .hero-model-cutout {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center top;
            max-height: min(72vh, 520px);
            mix-blend-mode: screen;
            filter: drop-shadow(0 18px 24px rgba(1, 8, 8, 0.36));
        }

        @media (max-width: 1023px) {
            .hero-mesh {
                min-height: auto;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
        }
        @media (max-width: 640px) {
            .hero-mesh::after {
                height: 62px;
                bottom: -28px;
            }
            .hero-model-wrap {
                width: min(100%, 360px);
            }
            .hero-model-mobile-row {
                display: flex;
                align-items: flex-end;
                justify-content: center;
                gap: 0.75rem;
            }
            .hero-model-card {
                width: min(58vw, 210px);
            }
            .hero-model-meta {
                margin-top: 0;
                max-width: 140px;
                text-align: left;
            }
        }

        .min-h-screen.flex.flex-col.bg-gradient-to-b {
            background: linear-gradient(180deg, #edf4f4 0%, #f7fafb 100%) !important;
        }
        header.sticky {
            background: rgba(12, 61, 56, 0.92) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 8px 20px rgba(6, 23, 21, 0.35) !important;
        }
        .site-header {
            height: 76px;
        }
        .site-header-bar {
            height: 100%;
            padding-top: 0;
            padding-bottom: 0;
        }
        header.sticky p,
        header.sticky a,
        header.sticky span,
        header.sticky i { color: #eaf4f3 !important; }
        header.sticky .bg-amber-500 {
            background: var(--sun) !important;
            color: #10232a !important;
            box-shadow: 0 8px 18px rgba(248, 180, 0, 0.3) !important;
        }

        nav a {
            position: relative;
            opacity: 0.9;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }
        nav a:hover {
            opacity: 1;
            transform: translateY(-1px);
        }
        nav a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -7px;
            width: 100%;
            height: 2px;
            border-radius: 999px;
            background: var(--sun);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.24s ease;
        }
        nav a:hover::after { transform: scaleX(1); }
        .mobile-menu-btn {
            width: 2.6rem;
            height: 2.6rem;
            border-radius: 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease, transform 0.2s ease;
        }
        .mobile-menu-btn:hover { background: rgba(255, 255, 255, 0.2); }
        .mobile-menu-btn:active { transform: scale(0.97); }
        .mobile-menu-lines {
            position: relative;
            width: 1.1rem;
            height: 0.78rem;
        }
        .mobile-menu-lines span {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            border-radius: 999px;
            background: #f3fbfa;
            transition: transform 0.24s ease, opacity 0.2s ease, top 0.24s ease;
        }
        .mobile-menu-lines span:nth-child(1) { top: 0; }
        .mobile-menu-lines span:nth-child(2) { top: 0.39rem; }
        .mobile-menu-lines span:nth-child(3) { top: 0.78rem; }
        .mobile-menu-btn.is-open .mobile-menu-lines span:nth-child(1) {
            top: 0.39rem;
            transform: rotate(45deg);
        }
        .mobile-menu-btn.is-open .mobile-menu-lines span:nth-child(2) {
            opacity: 0;
        }
        .mobile-menu-btn.is-open .mobile-menu-lines span:nth-child(3) {
            top: 0.39rem;
            transform: rotate(-45deg);
        }
        .mobile-nav-panel {
            opacity: 0;
            transform: translateY(-8px) scale(0.98);
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
        }
        .mobile-nav-panel.is-open {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        @media (min-width: 768px) {
            .mobile-menu-btn,
            .mobile-nav-panel {
                display: none !important;
            }
        }

        .soft-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(13, 91, 84, 0.5), transparent);
        }
        main > section + section {
            margin-top: clamp(1rem, 2.2vw, 1.9rem);
        }

        .package-card.is-selected {
            border-color: rgba(13, 91, 84, 0.52) !important;
            box-shadow: 0 20px 40px -18px rgba(13, 91, 84, 0.44) !important;
            background: linear-gradient(180deg, #ffffff 0%, #f2fcf9 100%) !important;
        }

        #about .text-white, #about .text-slate-100, #about .text-slate-50 { color: #ffffff !important; }
        #about .text-slate-300, #about .text-slate-400 { color: #c9d7d7 !important; }
        #about .text-emerald-300 { color: #ffe29a !important; }
        #about .bg-white\/10 {
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
        }
        #about .from-slate-800.to-slate-900,
        #about .bg-slate-900 {
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.14) 0%, rgba(255, 255, 255, 0.06) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.24);
        }
        #about .text-slate-950 { color: #15343b !important; }

        #about .bg-emerald-500,
        #about .bg-amber-500 {
            background: var(--sun) !important;
            color: #11272e !important;
            box-shadow: 0 12px 24px rgba(248, 180, 0, 0.28) !important;
        }
        #about .bg-white\/10.px-6.py-2,
        #about a.bg-white\/10 {
            background: rgba(255, 255, 255, 0.16) !important;
            color: #f7fffe !important;
            border: 1px solid rgba(255, 255, 255, 0.28);
        }
        #about a.bg-white\/10:hover { background: rgba(255, 255, 255, 0.22) !important; }

        #education, #experience, #skills, #projects, #packages, #contact {
            background-image: none !important;
            background-color: transparent !important;
        }

        #education article,
        #experience article,
        #projects article,
        #packages article,
        #contact .rounded-3xl.bg-white\/95,
        #skills .rounded-3xl {
            position: relative;
            background: var(--card) !important;
            border: 1px solid var(--line);
            box-shadow: var(--shadow-sm) !important;
        }

        /* Card frame corners similar to reference */
        #education article::before,
        #experience article::before,
        #projects article::before,
        #packages article::before {
            content: "";
            position: absolute;
            inset: 10px;
            border-radius: 1rem;
            border: 1px dashed rgba(13, 91, 84, 0.17);
            pointer-events: none;
        }

        #skills .from-slate-800,
        #skills .to-slate-900,
        #skills .via-slate-900,
        #skills .to-emerald-950\/80 {
            background-image: linear-gradient(155deg, #124741 0%, #0d3431 100%) !important;
            border: none !important;
        }
        #skills .text-white,
        #skills .text-amber-100,
        #skills .text-emerald-50 { color: #ecf7f6 !important; }
        #skills li.rounded-full {
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #f7fffe !important;
        }

        #projects .from-emerald-600.to-teal-600,
        #projects .from-violet-600.to-fuchsia-600,
        #packages .from-indigo-600.to-violet-600,
        #contact .from-indigo-600.to-violet-600 {
            background-image: linear-gradient(90deg, #0e5f58 0%, #0f7770 100%) !important;
            box-shadow: 0 12px 24px rgba(13, 91, 84, 0.25) !important;
        }

        #projects .rounded-full.bg-gradient-to-r,
        #projects .bg-gradient-to-r.from-emerald-500\/15.to-teal-500\/20,
        #projects .bg-gradient-to-r.from-violet-500\/15.to-fuchsia-500\/20 {
            background: #f0f7f6 !important;
            color: #1a4944 !important;
            border: 1px solid #d8ebe7;
        }

        #journey {
            background: linear-gradient(180deg, #ffffff 0%, #f2f6f7 100%) !important;
            border-top: 1px solid #dde7eb;
            border-bottom: 1px solid #dde7eb;
            border-radius: 1.25rem;
        }
        #journey .text-slate-100 { color: #17333a !important; }
        #journey .text-slate-300\/85, #journey .text-slate-300, #journey .text-cyan-300\/90 { color: #69828e !important; }
        #journey .journey-kicker {
            font-size: 0.75rem;
            letter-spacing: 0.18em;
        }
        #journey .journey-heading {
            font-size: clamp(1.8rem, 3.8vw, 2.5rem);
            line-height: 1.15;
            margin-top: 0.45rem;
        }
        #journey .journey-lead {
            font-size: clamp(0.95rem, 1.8vw, 1.05rem);
            max-width: 52ch;
        }
        #journey .journey-grid article {
            background: #ffffff !important;
            border: 1px solid #d9e7eb;
            box-shadow: var(--shadow-sm);
            border-radius: 1.25rem;
            padding: 1.2rem 1.25rem;
            height: 100%;
        }
        #journey .journey-year-badge {
            background: linear-gradient(120deg, #0d5b54 0%, #117a71 100%);
            color: #fff;
            border: 1px solid rgba(13, 91, 84, 0.35);
        }
        #journey .journey-dot {
            background: var(--sun);
            box-shadow: 0 0 0 4px rgba(248, 180, 0, 0.18);
            animation: pulse-ring 2.4s ease-in-out infinite;
        }

        .fixed[aria-label="Direct contact shortcuts"] a {
            border: 1px solid rgba(255, 255, 255, 0.36);
            box-shadow: 0 12px 24px rgba(10, 34, 33, 0.3) !important;
        }
        .fixed[aria-label="Direct contact shortcuts"] a:hover {
            transform: translateY(-4px) scale(1.05);
        }

        footer {
            background: linear-gradient(90deg, #0f4f4a 0%, #0c3e3a 60%, #0b3330 100%) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.14);
        }
        footer .text-slate-400, footer .text-slate-300 { color: #c7dedd !important; }
        footer .text-emerald-400\/80 { color: #ffe29a !important; }
    </style>
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased overflow-x-hidden">
<div class="relative min-h-screen flex flex-col bg-gradient-to-b from-slate-50 via-white to-violet-50/30">
    <header class="site-header sticky top-0 z-20 bg-white/75 backdrop-blur-md shadow-sm shadow-slate-200/50">
        <div class="site-header-bar mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <a href="#top" class="flex items-center gap-2">
                <div class="h-9 w-9 rounded-xl bg-amber-500 flex items-center justify-center text-slate-950 font-semibold shadow-md shadow-amber-500/30">
                    AK
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-semibold">Arjun Kumar H</p>
                    <p class="text-xs text-slate-400">Full Stack Developer</p>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="#about" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-user text-amber-500"></i><span>About</span></a>
                <a href="#education" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-graduation-cap text-amber-500"></i><span>Education</span></a>
                <a href="#experience" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-briefcase text-amber-500"></i><span>Experience</span></a>
                <a href="#skills" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-code text-amber-500"></i><span>Skills</span></a>
                <a href="#projects" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-diagram-project text-amber-500"></i><span>Projects</span></a>
                <a href="#packages" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-layer-group text-amber-500"></i><span>Packages</span></a>
                <a href="#contact" class="text-slate-600 hover:text-amber-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1"><i class="fa-solid fa-envelope text-amber-500"></i><span>Contact</span></a>
            </nav>
            <a href="#contact" class="hidden sm:inline-flex items-center gap-2 rounded-full bg-amber-500 px-4 py-1.5 text-xs font-semibold text-black shadow-lg shadow-amber-600/35 hover:bg-amber-400 hover:shadow-amber-500/40 transition">
                Available for opportunities
            </a>
            <button
                type="button"
                class="mobile-menu-btn md:hidden"
                id="mobile-menu-button"
                aria-label="Toggle navigation menu"
                aria-controls="mobile-nav-panel"
                aria-expanded="false"
            >
                <span class="mobile-menu-lines" aria-hidden="true">
                    <span></span><span></span><span></span>
                </span>
            </button>
        </div>
        <div
            id="mobile-nav-panel"
            class="mobile-nav-panel md:hidden border-t border-white/15 bg-[#0f4f4a]/95 px-4 pb-4 pt-3 shadow-xl shadow-black/25"
        >
            <nav class="flex flex-col gap-1.5 text-sm">
                <a href="#about" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-user text-amber-300 mr-2"></i>About</a>
                <a href="#education" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-graduation-cap text-amber-300 mr-2"></i>Education</a>
                <a href="#experience" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-briefcase text-amber-300 mr-2"></i>Experience</a>
                <a href="#skills" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-code text-amber-300 mr-2"></i>Skills</a>
                <a href="#projects" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-diagram-project text-amber-300 mr-2"></i>Projects</a>
                <a href="#packages" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-layer-group text-amber-300 mr-2"></i>Packages</a>
                <a href="#contact" class="rounded-xl px-3 py-2 text-slate-100 hover:bg-white/10"><i class="fa-solid fa-envelope text-amber-300 mr-2"></i>Contact</a>
            </nav>
            <a href="#contact" class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-full bg-amber-500 px-4 py-2 text-xs font-semibold text-black shadow-md shadow-amber-700/30">
                Available for opportunities
            </a>
        </div>
    </header>

    <main id="top" class="flex-1">
        {{-- Hero --}}
        <section id="about" class="relative hero-mesh overflow-hidden">
            <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-emerald-500/20 blur-3xl float-orb"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-20 h-64 w-64 rounded-full bg-cyan-500/15 blur-3xl orb-drift"></div>
            <div class="mx-auto w-full max-w-[1320px] px-4 sm:px-6 lg:px-10 py-10 sm:py-12 lg:py-10 flex flex-col lg:flex-row items-center justify-center gap-6 sm:gap-8 lg:gap-12 relative">
                {{-- Photo --}}
                <div class="relative flex w-full lg:w-[38%] min-w-[220px] justify-center lg:justify-start">
                    <div class="hero-model-wrap photo-pop lg:mr-auto">
                        <span class="hero-model-glow" aria-hidden="true"></span>
                        <span class="hero-model-ring ring-a" aria-hidden="true"></span>
                        <span class="hero-model-ring ring-b" aria-hidden="true"></span>
                        <span class="hero-model-pattern" aria-hidden="true"></span>
                        <div class="hero-model-mobile-row">
                            <div class="hero-model-card card-lift">
                                <img
                                    src="/images/arjun-hero-cutout.png?v={{ @filemtime(public_path('images/arjun-hero-cutout.png')) }}"
                                    alt="Arjun Kumar H portrait"
                                    class="hero-model-cutout"
                                    loading="eager"
                                    decoding="async"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-[62%] max-w-2xl space-y-5 hero-reveal text-center lg:text-left">
                    <p class="text-xs font-medium uppercase tracking-[0.25em] text-emerald-400 lg:pl-1">
                        Hello, I'm
                    </p>
                    <h1 class="text-[1.65rem] leading-tight sm:text-4xl lg:text-5xl font-semibold tracking-tight text-white hero-title-glow">
                        <span class="block">Arjun Kumar H</span>
                        <span class="mt-2 block text-base sm:text-xl text-emerald-300">
                            Full Stack Web Developer
                        </span>
                    </h1>
                    <p class="hero-copy text-slate-300 max-w-xl leading-relaxed">
                        Need to <strong class="font-semibold text-white">hire a website developer</strong> for your startup or small business?
                        I build affordable, responsive websites and web apps with Laravel, Django, and React. I also set up
                        <strong class="font-semibold text-white">SEO fundamentals</strong>, <strong class="font-semibold text-white">Google Search Console</strong>,
                        and proper <strong class="font-semibold text-white">indexing</strong> (sitemaps, coverage, discoverability).
                    </p>
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-1 sm:pt-2">
                        <a href="#contact" class="hero-cta-pop inline-flex items-center justify-center rounded-full bg-emerald-500 px-5 sm:px-6 py-2 text-xs sm:text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/40 hover:bg-emerald-400 active:scale-[0.98] transition-all duration-300">
                            <i class="fa-solid fa-comments mr-2"></i>Let’s Talk
                        </a>
                        <a href="#projects" class="inline-flex items-center justify-center rounded-full bg-white/10 px-5 sm:px-6 py-2 text-xs sm:text-sm font-medium text-slate-100 shadow-lg shadow-black/20 hover:bg-white/15 hover:text-emerald-200 hover:scale-[1.03] active:scale-[0.98] transition-all duration-300">
                            <i class="fa-solid fa-briefcase mr-2"></i>View My Work
                        </a>
                    </div>
                    <div class="flex flex-wrap items-stretch justify-center lg:justify-start gap-2.5 pt-2 sm:pt-4 pb-4 sm:pb-0 text-[11px] sm:text-xs text-slate-300">
                        <span class="inline-flex min-h-[34px] items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 backdrop-blur-sm shadow-lg shadow-emerald-900/20">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i>
                            Open to freelance projects
                        </span>
                        <span class="inline-flex min-h-[34px] items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 backdrop-blur-sm shadow-lg shadow-amber-900/15">
                            <i class="fa-solid fa-indian-rupee-sign text-amber-300"></i>
                            Small business websites from ₹5,000 – ₹15,000
                        </span>
                        <span class="inline-flex min-h-[34px] items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 backdrop-blur-sm shadow-lg shadow-cyan-900/15">
                            <i class="fa-brands fa-google text-cyan-300"></i>
                            SEO · Search Console · indexing
                        </span>
                    </div>
                </div>

            </div>
        </section>

        {{-- Education --}}
        <section id="education" class="bg-gradient-to-br from-violet-100/80 via-fuchsia-50/50 to-white py-14 lg:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <h2 class="reveal text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-fuchsia-500 text-white shadow-lg shadow-violet-400/40">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </span>
                    Education
                </h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    <article class="reveal reveal-delay-1 relative overflow-hidden rounded-3xl bg-white/90 backdrop-blur-sm p-6 shadow-xl shadow-violet-200/50 card-lift">
                        <p class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700">
                            2023 – Present
                        </p>
                        <h3 class="mt-2 text-sm font-semibold text-slate-900">Master of Business Administration (MBA)</h3>
                        <p class="mt-1 text-xs text-amber-700">CET, School of Management</p>
                        <p class="mt-1 text-xs text-slate-500">Pursuing</p>
                        <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                            Building strong foundations in management, strategy, and leadership to complement my technical
                            skills as a developer. This combination helps me understand both the business and engineering
                            sides of a product.
                        </p>
                    </article>
                    <article class="reveal reveal-delay-2 relative overflow-hidden rounded-3xl bg-white/90 backdrop-blur-sm p-6 shadow-xl shadow-fuchsia-200/40 card-lift">
                        <p class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700">
                            2012 – 2016
                        </p>
                        <h3 class="mt-2 text-sm font-semibold text-slate-900">B.Tech in Mechanical Engineering</h3>
                        <p class="mt-1 text-xs text-amber-700">Younus Institute of Technology, Kannannalloor</p>
                        <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                            Developed strong analytical and problem-solving skills, with exposure to core engineering concepts,
                            systems thinking, and hands-on project work.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Experience --}}
        <section id="experience" class="bg-gradient-to-br from-cyan-50/90 via-sky-50/40 to-blue-100/30 py-14 lg:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="reveal flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-400/40">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        Work Experience
                    </h2>
                    <p class="text-xs text-slate-500 max-w-lg leading-relaxed">
                        Full stack delivery — backend (Laravel, Django, Yii2), frontend &amp; mobile (React.js, React Native),
                        plus <span class="text-slate-700 font-medium">SEO hygiene</span>, <span class="text-slate-700 font-medium">Google Search Console</span>,
                        and <span class="text-slate-700 font-medium">indexing</span> (sitemaps, URL inspection, coverage) so sites don’t just ship — they can be found.
                    </p>
                </div>
                <div class="mt-8 space-y-5">
                    <article class="reveal reveal-delay-1 relative overflow-hidden rounded-3xl bg-white/90 backdrop-blur-sm p-6 shadow-xl shadow-cyan-200/45 card-lift">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900">Web Developer</h3>
                                <p class="mt-1 text-xs text-amber-700">PHP · Laravel · Python · Django · React.js · React Native · Yii2</p>
                            </div>
                            <p class="text-xs text-slate-500">
                                Alverstone Healthcare Pvt Ltd · July - Present
                            </p>
                        </div>
                        <ul class="mt-4 space-y-2 text-sm text-slate-700">
                            <li class="flex gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span>Built and maintained end-to-end web applications using Laravel and Django with RESTful APIs and modular architectures.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span>Developed interactive user interfaces with React.js and cross-platform mobile apps with React Native.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span>Worked with relational databases, authentication, role-based access, and deployment best practices.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span>Applied on-page SEO, structured metadata, Search Console monitoring, and indexing best practices so releases stay discoverable in Google.</span>
                            </li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Skills --}}
        <section id="skills" class="bg-gradient-to-br from-amber-50 via-orange-50/40 to-rose-50/30 py-14 lg:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="reveal flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 text-white shadow-lg shadow-amber-400/45">
                            <i class="fa-solid fa-code"></i>
                        </span>
                        My Skills
                    </h2>
                    <p class="text-xs text-slate-500 max-w-md">Code, delivery, and <span class="text-slate-700 font-medium">search visibility</span> — including how Google crawls and indexes what we ship.</p>
                </div>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="reveal reveal-delay-1 rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 p-5 shadow-xl shadow-amber-200/30 card-lift">
                        <h3 class="text-sm font-semibold text-white">Backend</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">PHP</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Laravel</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Python</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Django</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Yii2</li>
                        </ul>
                    </div>
                    <div class="reveal reveal-delay-2 rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 p-5 shadow-xl shadow-orange-200/25 card-lift">
                        <h3 class="text-sm font-semibold text-white">Frontend & Mobile</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">React.js</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">React Native</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">HTML5</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">CSS3</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Tailwind CSS</li>
                        </ul>
                    </div>
                    <div class="reveal reveal-delay-3 rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 p-5 shadow-xl shadow-rose-200/25 card-lift">
                        <h3 class="text-sm font-semibold text-white">Tools & Other</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">MySQL / PostgreSQL</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">REST APIs</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Git & GitHub</li>
                            <li class="rounded-full bg-white/12 px-3 py-1 text-amber-100 shadow-sm shadow-black/30">Linux basics</li>
                        </ul>
                    </div>
                    <div class="reveal reveal-delay-4 rounded-3xl bg-gradient-to-br from-slate-800 via-slate-900 to-emerald-950/80 p-5 shadow-xl shadow-emerald-400/25 card-lift sm:col-span-2 xl:col-span-1">
                        <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                            <i class="fa-brands fa-google text-emerald-400 text-base"></i>
                            SEO &amp; indexing
                        </h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">Technical SEO basics</li>
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">On-page meta &amp; structure</li>
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">Google Search Console</li>
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">Sitemaps &amp; indexing</li>
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">URL inspection &amp; coverage</li>
                            <li class="rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-50 shadow-sm shadow-emerald-950/40">Core Web Vitals awareness</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Projects --}}
        <section id="projects" class="relative bg-gradient-to-br from-emerald-100/70 via-teal-50/60 to-cyan-100/40 py-14 lg:py-20 overflow-hidden">
            <div class="pointer-events-none absolute top-0 right-0 h-64 w-64 rounded-full bg-teal-400/20 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-0 h-48 w-48 rounded-full bg-emerald-400/15 blur-3xl"></div>
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 relative">
                <div class="reveal flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-400/45">
                            <i class="fa-solid fa-diagram-project"></i>
                        </span>
                        Featured Projects
                    </h2>
                    <p class="text-xs text-slate-600 max-w-md leading-relaxed">
                        Live builds with responsive layouts, clear IA, and <span class="text-slate-800 font-medium">SEO-friendly structure</span> so pages stay crawlable and indexable.
                    </p>
                </div>
                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    @foreach (config('projects.featured', []) as $project)
                        @php
                            $accent = $project['accent'] ?? 'emerald';
                            $palette = ($sitePalettes ?? [])[$loop->index] ?? [];
                            $ui = array_merge($project['ui'] ?? [], $palette);
                            $isEmerald = $accent === 'emerald';
                            $delayClass = $loop->iteration === 1 ? 'reveal-delay-1' : 'reveal-delay-2';
                            $cardShadow = $isEmerald ? 'shadow-teal-200/50' : 'shadow-cyan-200/45';
                            $titleHover = $isEmerald ? 'group-hover:text-emerald-700' : 'group-hover:text-violet-800';
                            $iconHover = $isEmerald ? 'group-hover:text-emerald-500' : 'group-hover:text-violet-500';
                            $badgeRing = $isEmerald
                                ? 'from-emerald-500/15 to-teal-500/20 text-emerald-800 shadow-sm shadow-emerald-900/10'
                                : 'from-violet-500/15 to-fuchsia-500/20 text-violet-900 shadow-sm shadow-violet-900/10';
                            $dotGrad = $isEmerald
                                ? 'from-emerald-400 to-teal-500 shadow-emerald-400/50'
                                : 'from-violet-400 to-fuchsia-500 shadow-violet-400/50';
                            $btnGrad = $isEmerald
                                ? 'from-emerald-600 to-teal-600 shadow-emerald-500/35 hover:from-emerald-500 hover:to-teal-500 hover:shadow-emerald-500/50'
                                : 'from-violet-600 to-fuchsia-600 shadow-violet-500/35 hover:from-violet-500 hover:to-fuchsia-500 hover:shadow-violet-500/45';
                        @endphp
                        <article class="reveal {{ $delayClass }} group relative overflow-hidden rounded-3xl bg-white/90 backdrop-blur-sm p-6 shadow-xl {{ $cardShadow }} card-lift">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h3 class="text-sm font-semibold text-slate-900 {{ $titleHover }} transition-colors">
                                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2">
                                        {{ $project['title'] }}
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400 {{ $iconHover }}"></i>
                                    </a>
                                </h3>
                                <span class="rounded-full bg-gradient-to-r {{ $badgeRing }} px-3 py-1 text-[10px] font-medium">
                                    {{ $project['region_badge'] }}
                                </span>
                            </div>
                            <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                                {{ $project['description'] }}
                            </p>

                            @if (!empty($ui['primary_hex']) || !empty($ui['font_heading']))
                                <div class="mt-4 rounded-2xl bg-gradient-to-br from-slate-100/80 to-white p-4 shadow-inner shadow-slate-200/60">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">Design &amp; UI</p>
                                    <p class="mt-1 text-[10px] text-slate-400 leading-snug">Primary and secondary colors are read from the project URL (same host CSS), cached for a day.</p>
                                    <div class="mt-3 flex flex-wrap items-end gap-5 gap-y-3">
                                        @if (!empty($ui['primary_hex']))
                                            <div class="flex flex-col gap-1.5">
                                                <span class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">Primary</span>
                                                <span
                                                    class="inline-block h-9 w-16 shrink-0 rounded-xl shadow-md shadow-slate-400/50"
                                                    style="background-color: {{ $ui['primary_hex'] }}"
                                                    role="img"
                                                    aria-label="Primary brand color"
                                                ></span>
                                            </div>
                                        @endif
                                        @if (!empty($ui['secondary_hex']))
                                            <div class="flex flex-col gap-1.5">
                                                <span class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">Secondary</span>
                                                <span
                                                    class="inline-block h-9 w-16 shrink-0 rounded-xl shadow-md shadow-slate-400/50"
                                                    style="background-color: {{ $ui['secondary_hex'] }}"
                                                    role="img"
                                                    aria-label="Secondary brand color"
                                                ></span>
                                            </div>
                                        @endif
                                    </div>
                                    @if (!empty($ui['font_heading']) || !empty($ui['font_body']))
                                        <p class="mt-3 text-xs leading-relaxed text-slate-600">
                                            <span class="font-semibold text-slate-800">Typography</span>
                                            @if (!empty($ui['font_heading']))
                                                <span class="block sm:inline"><span class="text-slate-500">Headings</span> {{ $ui['font_heading'] }}</span>
                                            @endif
                                            @if (!empty($ui['font_heading']) && !empty($ui['font_body']))
                                                <span class="hidden sm:inline text-slate-400"> · </span>
                                            @endif
                                            @if (!empty($ui['font_body']))
                                                <span class="block sm:inline"><span class="text-slate-500">Body</span> {{ $ui['font_body'] }}</span>
                                            @endif
                                        </p>
                                    @endif
                                    @if (!empty($ui['features']) && is_array($ui['features']))
                                        <div class="mt-3 flex flex-wrap gap-1.5">
                                            @foreach ($ui['features'] as $feat)
                                                <span class="rounded-full bg-white px-2.5 py-1 text-[10px] font-medium text-slate-600 shadow-sm shadow-slate-300/50">{{ $feat }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <ul class="mt-4 space-y-2.5 text-sm text-slate-700">
                                @foreach ($project['highlights'] ?? [] as $line)
                                    <li class="flex gap-3">
                                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-gradient-to-br {{ $dotGrad }} shadow-sm"></span>
                                        <span>{{ $line }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r {{ $btnGrad }} px-4 py-2 text-xs font-semibold text-white shadow-lg transition">
                                {{ $project['cta_label'] }} <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Packages (choose a plan) --}}
        <section id="packages" class="relative bg-gradient-to-b from-white via-indigo-50/40 to-violet-50/30 py-14 lg:py-20">
            <div class="soft-divider absolute bottom-0 left-0 right-0" aria-hidden="true"></div>
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto reveal">
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 flex flex-wrap items-center justify-center gap-2">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-400/40">
                            <i class="fa-solid fa-layer-group"></i>
                        </span>
                        <span>Packages &amp; pricing</span>
                    </h2>
                    <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Starting points for freelance builds — pick what fits, then send details in the contact form below. Final quote after a quick scope chat.
                    </p>
                </div>

                <div class="mt-10 lg:mt-12 grid gap-6 md:grid-cols-3 items-stretch">
                    @foreach (config('contact.packages', []) as $key => $pkg)
                        <article
                            data-package-card="{{ $key }}"
                            class="package-card reveal flex flex-col rounded-3xl bg-white/95 p-6 sm:p-7 shadow-lg shadow-indigo-100/50 transition-all duration-300 card-lift"
                        >
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-xs font-bold uppercase tracking-wide text-indigo-600">{{ $pkg['label'] }}</p>
                                @if ($key === 'growth')
                                    <span class="shrink-0 rounded-full bg-indigo-100 px-2.5 py-0.5 text-[10px] font-semibold text-indigo-800">Popular</span>
                                @endif
                            </div>
                            <p class="mt-2 text-2xl font-bold text-slate-900 tabular-nums">{{ $pkg['price'] }}</p>
                            <ul class="mt-5 flex-1 space-y-2.5 text-sm text-slate-600 leading-snug">
                                @foreach ($pkg['bullets'] as $b)
                                    <li class="flex gap-2"><span class="text-emerald-500 shrink-0 mt-0.5"><i class="fa-solid fa-check text-[11px]"></i></span><span>{{ $b }}</span></li>
                                @endforeach
                            </ul>
                            <button
                                type="button"
                                data-package-select="{{ $key }}"
                                class="mt-8 w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-400/30 hover:from-indigo-500 hover:to-violet-500 transition"
                            >
                                Choose {{ $pkg['label'] }}
                                <i class="fa-solid fa-arrow-down text-xs opacity-90"></i>
                            </button>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section id="contact" class="bg-gradient-to-br from-indigo-50/80 via-violet-50/50 to-fuchsia-50/40 py-14 pb-16 lg:py-24 lg:pb-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto reveal">
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 flex flex-wrap items-center justify-center gap-2">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-400/40">
                            <i class="fa-solid fa-paper-plane"></i>
                        </span>
                        <span>Request a Quote</span>
                    </h2>
                    <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Tell me what you’re building and your budget range. I’ll reply by call or WhatsApp with the best plan for your requirement.
                    </p>
                </div>

                <p class="mx-auto mt-6 max-w-2xl text-center text-xs text-slate-500 leading-relaxed reveal">
                    Prefer direct contact? Same details as the form — reach out anytime. I’m on WhatsApp for quick questions. Open to full stack roles and freelance builds — Laravel, Django, React, and APIs.
                </p>
                <div class="mt-5 text-center reveal">
                    <a
                        href="https://wa.me/919995956770"
                        target="_blank"
                        rel="noreferrer"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-[#25D366] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-400/40 hover:bg-[#20bd5a] transition"
                    >
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        Direct Connect on WhatsApp (+91 99959 56770)
                    </a>
                </div>

                <div class="mt-10 max-w-2xl mx-auto reveal reveal-delay-1">
                        <div class="rounded-3xl bg-white/95 backdrop-blur-sm p-6 sm:p-8 shadow-xl shadow-violet-200/50">
                            @if (session('contact_success'))
                                <div class="mb-6 rounded-2xl bg-emerald-50/95 px-4 py-4 text-sm text-emerald-900 shadow-sm shadow-emerald-900/10" role="status">
                                    <p class="font-semibold flex items-center gap-2"><i class="fa-solid fa-circle-check"></i> Inquiry sent</p>
                                    <p class="mt-1 text-emerald-800/90">Thanks — I’ll get back to you on the mobile number you shared.</p>
                                </div>
                            @endif
                            @if (session('contact_error'))
                                <div class="mb-6 rounded-2xl bg-rose-50/95 px-4 py-4 text-sm text-rose-900 shadow-sm shadow-rose-900/10" role="alert">
                                    <p>{{ session('contact_error') }}</p>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="mb-6 rounded-2xl bg-amber-50/95 px-4 py-4 text-sm text-amber-950 shadow-sm shadow-amber-900/10" role="alert">
                                    <p class="font-semibold">Please fix the following:</p>
                                    <ul class="mt-2 list-disc list-inside space-y-0.5">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="post" class="relative space-y-6">
                                @csrf
                                <div class="absolute -left-[9999px] w-px h-px overflow-hidden opacity-0" aria-hidden="true">
                                    <label for="contact_hp">Leave empty</label>
                                    <input type="text" name="contact_hp" id="contact_hp" tabindex="-1" autocomplete="off" value="">
                                </div>

                                <div>
                                    <label for="project_type" class="block text-sm font-semibold text-slate-800 mb-2">What are you building?</label>
                                    <div class="relative">
                                        <select name="project_type" id="project_type" required class="w-full appearance-none rounded-xl border-0 bg-slate-50/90 px-4 py-3 pr-10 text-sm text-slate-900 shadow-sm shadow-slate-200/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/35">
                                            <option value="" disabled {{ old('project_type') ? '' : 'selected' }}>Select category…</option>
                                            @foreach (config('contact.project_types', []) as $value => $label)
                                                <option value="{{ $value }}" {{ old('project_type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"><i class="fa-solid fa-chevron-down text-xs"></i></span>
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-slate-800 mb-2">Name</label>
                                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" placeholder="Your name" class="w-full rounded-xl border-0 bg-slate-50/90 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm shadow-slate-200/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/35">
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-semibold text-slate-800 mb-2">Mobile number</label>
                                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required autocomplete="tel" inputmode="tel" placeholder="+91 98765 43210" class="w-full rounded-xl border-0 bg-slate-50/90 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm shadow-slate-200/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/35">
                                    </div>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-semibold text-slate-800 mb-2">Project details <span class="font-normal text-slate-500">(optional)</span></label>
                                    <textarea id="message" name="message" rows="4" placeholder="Timeline, pages, references, tech preferences…" class="w-full rounded-xl border-0 bg-slate-50/90 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm shadow-slate-200/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/35">{{ old('message') }}</textarea>
                                </div>

                                <button type="submit" class="w-full sm:w-auto sm:min-w-[220px] inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/35 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/45 transition-all duration-300">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Send inquiry
                                </button>
                            </form>
                        </div>
                </div>
            </div>
        </section>

        {{-- Journey: own section so it doesn’t sit flush / overlap contact --}}
        @php
            $journeyZigzag = [
                ['year' => 'Present', 'title' => 'Web Developer', 'text' => 'Alverstone Healthcare Pvt Ltd · July — Present. Full stack delivery with SEO, APIs, and maintainable code.'],
                ['year' => '2023', 'title' => 'MBA (pursuing)', 'text' => 'CET, School of Management — building business sense alongside engineering.'],
                ['year' => '2023', 'title' => 'Web Developer', 'text' => 'Sairaworld Pvt Ltd — web products and client-facing builds.'],
                ['year' => '2022', 'title' => 'Python Developer', 'text' => 'Futuro IT Solutions — backend scripting, APIs, and automation.'],
                ['year' => '2019', 'title' => 'Technician — I', 'text' => 'IFB Home Appliances & Services — field service, diagnostics, and customer-facing work.'],
                ['year' => '2018', 'title' => 'NDT Engineer', 'text' => 'L.G. Inspection & Services — inspection workflows and technical reporting.'],
                ['year' => '2017', 'title' => 'Branch Relationship Executive', 'text' => 'SBI credit card sales — targets, documentation, and client relationships.'],
                ['year' => '2016', 'title' => 'B.Tech — Mechanical Engineering', 'text' => 'Younus Institute of Technology, Kannannalloor — analytical foundation before moving into tech.'],
                ['year' => '2012', 'title' => 'Higher secondary', 'text' => '12th pass — science stream.'],
                ['year' => '2010', 'title' => 'SSLC', 'text' => 'Schooling milestone — start of the longer climb.'],
            ];
        @endphp
        <section id="journey" class="scroll-mt-20 bg-[#030f2b] pt-14 pb-16 sm:pt-16 sm:pb-20 lg:pt-20 lg:pb-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 relative">
                <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-24 border-l border-white/10 bg-[radial-gradient(circle,rgba(148,163,184,0.35)_1px,transparent_1px)] bg-[length:10px_10px] sm:block" aria-hidden="true"></div>
                <div class="reveal reveal-delay-2">
                    <div class="max-w-3xl mx-auto text-center sm:text-left">
                        <p class="journey-kicker font-semibold uppercase text-cyan-300/90">Growth Timeline</p>
                        <h3 class="journey-heading font-semibold tracking-tight text-slate-100">My Journey</h3>
                        <p class="journey-lead mt-3 text-slate-300/85 leading-relaxed">
                            A quick timeline of key milestones from schooling to current development work.
                        </p>
                    </div>

                    <div class="journey-grid mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($journeyZigzag as $step)
                            <article class="reveal reveal-delay-1 card-lift">
                                <div class="flex items-start justify-between gap-3">
                                    <p class="journey-year-badge inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.12em] tabular-nums">
                                        {{ $step['year'] }}
                                    </p>
                                    <span class="journey-dot mt-1 inline-flex h-2.5 w-2.5 shrink-0 rounded-full" aria-hidden="true"></span>
                                </div>
                                <p class="mt-3 text-base font-semibold leading-tight text-slate-900 sm:text-lg">{{ $step['title'] }}</p>
                                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $step['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Floating direct contact (email, WhatsApp, LinkedIn) --}}
    <div
        class="fixed bottom-5 right-4 z-50 flex flex-col gap-2.5 sm:bottom-8 sm:right-6"
        role="navigation"
        aria-label="Direct contact shortcuts"
    >
        <a
            href="https://mail.google.com/mail/?view=cm&fs=1&to=arjunh2194@gmail.com"
            target="_blank"
            rel="noopener noreferrer"
            class="group flex h-12 w-12 items-center justify-center rounded-full bg-white text-indigo-600 shadow-lg shadow-slate-400/40 transition hover:scale-105 hover:text-indigo-700 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
            title="Email — arjunh2194@gmail.com"
            aria-label="Email arjunh2194@gmail.com"
        >
            <i class="fa-solid fa-envelope text-lg" aria-hidden="true"></i>
        </a>
        <a
            href="https://wa.me/919995956770"
            target="_blank"
            rel="noreferrer"
            class="group flex h-12 w-12 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg shadow-emerald-600/40 transition hover:scale-105 hover:bg-[#20bd5a] hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 focus-visible:ring-offset-2"
            title="WhatsApp — +91 99959 56770"
            aria-label="WhatsApp +91 99959 56770"
        >
            <i class="fa-brands fa-whatsapp text-xl" aria-hidden="true"></i>
        </a>
        <a
            href="https://www.linkedin.com/in/arjunkumar21/"
            target="_blank"
            rel="noopener noreferrer"
            class="group flex h-12 w-12 items-center justify-center rounded-full bg-white text-[#0A66C2] shadow-lg shadow-slate-400/40 transition hover:scale-105 hover:text-[#004182] hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2"
            title="LinkedIn profile"
            aria-label="LinkedIn profile"
        >
            <i class="fa-brands fa-linkedin-in text-lg" aria-hidden="true"></i>
        </a>
    </div>

    <footer class="mt-8 sm:mt-10 lg:mt-12 bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 text-slate-400">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px]">
            <p class="text-slate-400">© {{ date('Y') }} Arjun Kumar H. All rights reserved.</p>
            <div class="flex items-center gap-1">
                <a href="https://www.linkedin.com/in/arjunkumar21/" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 w-11 items-center justify-center rounded-full text-slate-300 hover:bg-white/10 hover:text-[#0A66C2] hover:scale-110 transition-all duration-300 pointer-events-auto" aria-label="Open LinkedIn profile" title="Open LinkedIn profile">
                    <i class="fa-brands fa-linkedin text-lg"></i>
                </a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=arjunh2194@gmail.com&su=Portfolio%20Inquiry" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 w-11 items-center justify-center rounded-full text-slate-300 hover:bg-white/10 hover:text-emerald-400 hover:scale-110 transition-all duration-300 pointer-events-auto" aria-label="Send email to arjunh2194@gmail.com" title="Send email">
                    <i class="fa-solid fa-envelope text-lg"></i>
                </a>
                <a href="https://wa.me/919995956770" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 w-11 items-center justify-center rounded-full text-slate-300 hover:bg-white/10 hover:text-[#25D366] hover:scale-110 transition-all duration-300 pointer-events-auto" aria-label="Open WhatsApp chat" title="Open WhatsApp chat">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
            </div>
            <p class="text-emerald-400/80">Built with Laravel & Tailwind CSS</p>
        </div>
    </footer>
</div>
<script>
(function () {
    var menuBtn = document.getElementById('mobile-menu-button');
    var menuPanel = document.getElementById('mobile-nav-panel');
    if (!menuBtn || !menuPanel) return;

    function setMenu(open) {
        menuBtn.classList.toggle('is-open', open);
        menuPanel.classList.toggle('is-open', open);
        menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    menuBtn.addEventListener('click', function () {
        var shouldOpen = !menuPanel.classList.contains('is-open');
        setMenu(shouldOpen);
    });

    menuPanel.querySelectorAll('a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function () {
            setMenu(false);
        });
    });

    document.addEventListener('click', function (event) {
        if (!menuPanel.classList.contains('is-open')) return;
        var insideMenu = menuPanel.contains(event.target) || menuBtn.contains(event.target);
        if (!insideMenu) setMenu(false);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') setMenu(false);
    });
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
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    nodes.forEach(function (el) { io.observe(el); });
})();
(function () {
    function syncPackageCards(key) {
        document.querySelectorAll('[data-package-card]').forEach(function (el) {
            var active = el.getAttribute('data-package-card') === key;
            el.classList.toggle('is-selected', active);
            el.classList.toggle('bg-indigo-50/50', active);
        });
    }
    document.querySelectorAll('[data-package-select]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            syncPackageCards(btn.getAttribute('data-package-select'));
            var c = document.getElementById('contact');
            if (c) c.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
    syncPackageCards('starter');
})();
</script>
</body>
</html>

