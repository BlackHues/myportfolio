<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arjun Kumar H | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased">
<div class="relative min-h-screen flex flex-col bg-slate-50">
    <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 flex items-center justify-between py-4">
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
                <a href="#about" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-user text-amber-500"></i><span>About</span></a>
                <a href="#education" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-graduation-cap text-amber-500"></i><span>Education</span></a>
                <a href="#experience" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-briefcase text-amber-500"></i><span>Experience</span></a>
                <a href="#skills" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-code text-amber-500"></i><span>Skills</span></a>
                <a href="#projects" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-diagram-project text-amber-500"></i><span>Projects</span></a>
                <a href="#contact" class="text-slate-600 hover:text-amber-600 transition-colors flex items-center gap-1"><i class="fa-solid fa-envelope text-amber-500"></i><span>Contact</span></a>
            </nav>
            <a href="#contact" class="hidden sm:inline-flex items-center gap-2 rounded-full border border-amber-400 bg-amber-500 px-4 py-1.5 text-xs font-semibold text-black hover:bg-amber-400 transition shadow">
                Available for opportunities
            </a>
        </div>
    </header>

    <main id="top" class="flex-1">
        {{-- Hero (dark teal style) --}}
        <section id="about" class="border-b border-slate-900 bg-slate-950">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-16 lg:py-20 grid gap-10 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] items-center">
                <div class="space-y-5">
                    <p class="text-xs font-medium uppercase tracking-[0.25em] text-emerald-400">
                        Hello, I'm
                    </p>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-white">
                        <span class="block">Arjun Kumar H</span>
                        <span class="mt-2 block text-lg sm:text-xl text-emerald-300">
                            Full Stack Web Developer
                        </span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-300 max-w-xl leading-relaxed">
                        I build modern, responsive web applications with Laravel, Django and React – from clean landing pages
                        to full-featured business platforms. I focus on performance, usability, and maintainable code.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#contact" class="inline-flex items-center justify-center rounded-full bg-emerald-500 px-6 py-2 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/40 hover:bg-emerald-400 transition">
                            <i class="fa-solid fa-comments mr-2"></i>Let’s Talk
                        </a>
                        <a href="#projects" class="inline-flex items-center justify-center rounded-full border border-slate-600 px-6 py-2 text-sm font-medium text-slate-100 hover:border-emerald-400 hover:text-emerald-300 transition">
                            <i class="fa-solid fa-briefcase mr-2"></i>View My Work
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3 pt-4 text-xs text-slate-300">
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-3 py-1 border border-slate-700">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i>
                            Open to freelance projects
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-3 py-1 border border-slate-700">
                            <i class="fa-solid fa-indian-rupee-sign text-emerald-400"></i>
                            Normal websites from ₹5,000 – ₹15,000
                        </span>
                    </div>
                </div>

                {{-- Photo card --}}
                <div class="relative">
                    <div class="absolute inset-0 blur-3xl bg-emerald-500/20"></div>
                    <div class="relative mx-auto max-w-xs rounded-[2rem] bg-gradient-to-b from-slate-800 to-slate-900 p-4 shadow-2xl shadow-emerald-500/20">
                        <div class="relative aspect-[4/5] w-full overflow-hidden rounded-[2rem] bg-slate-900 flex items-center justify-center">
                            <img
                                src="{{ asset('images/arjun-profile.png') }}"
                                alt="Arjun Kumar H"
                                class="h-full w-full object-cover"
                            />
                            <div class="pointer-events-none absolute inset-0 rounded-[2rem] ring-1 ring-emerald-400/40"></div>
                        </div>
                        <div class="mt-4 space-y-1 text-xs text-slate-300">
                            <p class="font-semibold text-slate-50">Full Stack Developer</p>
                            <p class="text-slate-400">Laravel · Django · React · REST APIs</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Education --}}
        <section id="education" class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
                <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-amber-500"></i>
                    Education
                </h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
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
                    <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
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
        <section id="experience" class="border-b border-slate-200 bg-slate-50">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-amber-500"></i>
                        Work Experience
                    </h2>
                    <p class="text-xs text-slate-400 max-w-md">
                        Full Stack development across backend (Laravel, Django, Yii2) and frontend/mobile (React.js, React Native),
                        with a focus on clean architecture and user-centric design.
                    </p>
                </div>
                <div class="mt-8 space-y-5">
                    <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
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
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Skills --}}
        <section id="skills" class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
                <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-code text-amber-500"></i>
                    My Skills
                </h2>
                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white elevate p-5">
                        <h3 class="text-sm font-semibold text-slate-900">Backend</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">PHP</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Laravel</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Python</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Django</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Yii2</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white elevate p-5">
                        <h3 class="text-sm font-semibold text-slate-900">Frontend & Mobile</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">React.js</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">React Native</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">HTML5</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">CSS3</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Tailwind CSS</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white elevate p-5">
                        <h3 class="text-sm font-semibold text-slate-900">Tools & Other</h3>
                        <ul class="mt-4 flex flex-wrap gap-2 text-xs">
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">MySQL / PostgreSQL</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">REST APIs</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Git & GitHub</li>
                            <li class="rounded-full bg-slate-800 px-3 py-1 text-slate-200">Linux basics</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Projects --}}
        <section id="projects" class="border-b border-slate-200 bg-slate-50">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-diagram-project text-amber-500"></i>
                        Featured Projects
                    </h2>
                    <p class="text-xs text-slate-400 max-w-md">
                        Below are example slots for your Laravel and full stack projects. Replace the descriptions with your real work.
                    </p>
                </div>
                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    <article class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="text-sm font-semibold text-slate-900 group-hover:text-amber-600 transition-colors">
                                Laravel Web Application
                            </h3>
                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-[10px] font-medium text-emerald-300 border border-emerald-500/40">
                                Laravel · MySQL
                            </span>
                        </div>
                        <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                            A full-stack Laravel application with authentication, role-based access control, REST APIs,
                            and responsive UI. Replace this text with one of your Laravel projects (for example:
                            inventory system, portfolio CMS, or any real project you’ve built).
                        </p>
                        <ul class="mt-4 flex flex-wrap gap-2 text-[11px] text-slate-600">
                            <li class="rounded-full bg-slate-100 px-3 py-1">Authentication & authorization</li>
                            <li class="rounded-full bg-slate-100 px-3 py-1">Reusable components</li>
                            <li class="rounded-full bg-slate-100 px-3 py-1">RESTful APIs</li>
                        </ul>
                    </article>
                    <article class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="text-sm font-semibold text-slate-900 group-hover:text-amber-600 transition-colors">
                                Django & React Stack
                            </h3>
                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-[10px] font-medium text-emerald-300 border border-emerald-500/40">
                                Django · React.js
                            </span>
                        </div>
                        <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                            A modular Django backend with a React frontend, integrating APIs, authentication,
                            and dashboard-style UI. Replace this with a real project using Django and React.
                        </p>
                        <ul class="mt-4 flex flex-wrap gap-2 text-[11px] text-slate-600">
                            <li class="rounded-full bg-slate-100 px-3 py-1">API-driven architecture</li>
                            <li class="rounded-full bg-slate-100 px-3 py-1">Reusable UI components</li>
                            <li class="rounded-full bg-slate-100 px-3 py-1">Charts / analytics ready</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Contact --}}
        <section id="contact" class="bg-white">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] items-start">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane text-amber-500"></i>
                            Let’s connect
                        </h2>
                        <p class="mt-3 text-sm text-slate-700 max-w-md">
                            Looking for roles or internships in software development, especially in full stack web and mobile
                            development. Feel free to reach out for collaborations, opportunities, or just to say hi.
                        </p>
                        <ul class="mt-6 space-y-3 text-sm text-slate-700">
                            <li>
                                <span class="text-slate-500">Email</span><br>
                                <a href="mailto:arjunh2194@gmail.com" class="font-medium text-slate-900 hover:text-emerald-600">
                                    arjunh2194@gmail.com
                                </a>
                            </li>
                            <li>
                                <span class="text-slate-500">Phone / WhatsApp</span><br>
                                <a href="https://wa.me/919995956770" target="_blank" rel="noreferrer" class="font-medium text-slate-900 hover:text-emerald-600">
                                    +91 99959 56770
                                </a>
                            </li>
                            <li>
                                <span class="text-slate-500">GitHub / LinkedIn</span><br>
                                <span class="font-medium text-slate-900">Add your profile links here</span>
                            </li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white elevate p-6">
                        <p class="text-xs text-slate-600 mb-4">
                            This is a static contact section for now. If you’d like, we can later hook this into a real
                            Laravel contact form that emails you or stores messages in the database.
                        </p>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1" for="name">Name</label>
                                <input id="name" type="text" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1" for="email">Email</label>
                                <input id="email" type="email" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1" for="message">Message</label>
                                <textarea id="message" rows="4" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-500"></textarea>
                            </div>
                            <button type="button" class="w-full inline-flex items-center justify-center rounded-full bg-amber-500 px-4 py-2 text-sm font-semibold text-black shadow hover:bg-amber-400 transition">
                                <i class="fa-solid fa-paper-plane mr-2"></i>Send (static demo)
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Timeline --}}
                <div class="mt-12 border-t border-slate-200 pt-8">
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-timeline text-emerald-500"></i>
                        My Journey
                    </h3>
                    <div class="relative">
                        <div class="absolute left-2 top-1 bottom-1 w-px bg-slate-200 hidden sm:block"></div>
                        <ol class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-4 sm:gap-4 text-xs sm:text-[13px] text-slate-700">
                            <li class="relative flex items-start gap-3">
                                <span class="hidden sm:inline-flex h-2 w-2 rounded-full bg-emerald-500 mt-1.5"></span>
                                <div>
                                    <p class="font-semibold text-slate-900">2010</p>
                                    <p class="text-slate-600">SSLC Passout</p>
                                </div>
                            </li>
                            <li class="relative flex items-start gap-3">
                                <span class="hidden sm:inline-flex h-2 w-2 rounded-full bg-emerald-500 mt-1.5"></span>
                                <div>
                                    <p class="font-semibold text-slate-900">2012</p>
                                    <p class="text-slate-600">12th Passout</p>
                                </div>
                            </li>
                            <li class="relative flex items-start gap-3">
                                <span class="hidden sm:inline-flex h-2 w-2 rounded-full bg-emerald-500 mt-1.5"></span>
                                <div>
                                    <p class="font-semibold text-slate-900">2016</p>
                                    <p class="text-slate-600">UG / Bachelor’s Degree Passout</p>
                                </div>
                            </li>
                            <li class="relative flex items-start gap-3">
                                <span class="hidden sm:inline-flex h-2 w-2 rounded-full bg-emerald-500 mt-1.5"></span>
                                <div>
                                    <p class="font-semibold text-slate-900">Now</p>
                                    <p class="text-slate-600">Currently a Developer (Freelance & Professional)</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-500">
            <p>© {{ date('Y') }} Arjun Kumar H. All rights reserved.</p>
            <p>Built with Laravel & Tailwind CSS.</p>
        </div>
    </footer>
</div>
</body>
</html>

