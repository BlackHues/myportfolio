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
        {{-- Hero --}}
        <section id="about" class="border-b border-slate-200 bg-gradient-to-b from-white via-slate-50 to-white">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid gap-12 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] items-center">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700 mb-4">
                        Full Stack Developer · Laravel · Django · React
                    </p>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight">
                        <span class="block text-slate-700">Hello, I'm</span>
                        <span class="mt-2 block bg-gradient-to-r from-amber-500 via-orange-400 to-amber-500 bg-clip-text text-transparent">
                            Arjun Kumar H
                        </span>
                    </h1>
                    <p class="mt-6 text-sm sm:text-base text-slate-700 leading-relaxed max-w-xl">
                        I’m a Mechanical Engineering graduate from Younus Institute of Technology, Kannannalloor,
                        currently pursuing my MBA at CET School of Management. I work as a Full Stack Developer,
                        building robust web and mobile applications using PHP (Laravel), Python (Django),
                        React.js, React Native, and Yii2.
                    </p>
                    <p class="mt-3 text-sm text-slate-500 max-w-xl">
                        I enjoy turning complex problems into clean, scalable solutions and crafting experiences that feel fast,
                        intuitive, and reliable.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="#projects" class="inline-flex items-center justify-center rounded-full bg-amber-500 px-6 py-2 text-sm font-semibold text-black shadow hover:bg-amber-400 transition">
                            <i class="fa-solid fa-arrow-right mr-2"></i>View Projects
                        </a>
                        <a href="#contact" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-6 py-2 text-sm font-medium text-slate-700 hover:border-amber-400 hover:text-amber-600 transition">
                            <i class="fa-solid fa-paper-plane mr-2"></i>Contact Me
                        </a>
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3 text-xs text-slate-600">
                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 border border-slate-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Open to internships & full-time roles
                        </span>
                    </div>
                </div>

                {{-- Photo + quick info --}}
                <div class="relative">
                    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-tr from-amber-400 via-orange-400 to-yellow-300 blur-2xl opacity-50"></div>
                    <div class="relative rounded-3xl border border-slate-200 bg-white elevate p-6 shadow-xl shadow-amber-200/60">
                        <div class="aspect-[4/5] w-full overflow-hidden rounded-2xl bg-slate-100 flex items-center justify-center">
                            <img
                                src="{{ asset('images/arjun-profile.png') }}"
                                alt="Arjun Kumar H"
                                class="h-full w-full object-cover"
                            />
                        </div>
                        <dl class="mt-6 grid grid-cols-1 gap-3 text-xs text-slate-600">
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 border border-slate-200">
                                <dt class="text-slate-400">Current Program</dt>
                                <dd class="font-medium text-slate-100 text-right">MBA, CET School of Management</dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 border border-slate-200">
                                <dt class="text-slate-400">Background</dt>
                                <dd class="font-medium text-slate-100 text-right">B.Tech Mechanical Engg.</dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 border border-slate-200">
                                <dt class="text-slate-400">Location</dt>
                                <dd class="font-medium text-slate-100 text-right">India (open to relocate/remote)</dd>
                            </div>
                        </dl>
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
                        <h3 class="text-sm font-semibold text-slate-900">Master of Business Administration (MBA)</h3>
                        <p class="mt-1 text-xs text-amber-700">CET, School of Management</p>
                        <p class="mt-1 text-xs text-slate-500">Pursuing</p>
                        <p class="mt-3 text-sm text-slate-700 leading-relaxed">
                            Building strong foundations in management, strategy, and leadership to complement my technical
                            skills as a developer. This combination helps me understand both the business and engineering
                            sides of a product.
                        </p>
                    </article>
                    <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white elevate p-6">
                        <h3 class="text-sm font-semibold text-slate-900">B.Tech in Mechanical Engineering</h3>
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
                                <span class="font-medium text-slate-900">Add your email here</span>
                            </li>
                            <li>
                                <span class="text-slate-500">Phone</span><br>
                                <span class="font-medium text-slate-900">Add your phone number here</span>
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

