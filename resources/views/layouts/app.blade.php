<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NurulIlmi') — Media Pembelajaran Islami</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* ═══ ROOT VARIABLES ═══ */
        :root {
            --navy: #0B1628;
            --navy-mid: #112240;
            --navy-light: #1A3A5C;
            --emerald: #0D7377;
            --emerald-l: #14A098;
            --emerald-ll: #1FC8C0;
            --gold: #C9A84C;
            --gold-l: #E8C97A;
            --gold-ll: #F5E0A0;
            --white: #FFFFFF;
            --bg-page: #0B1628;
            --bg-section-alt: #112240;
            --text-main: #E8EDF5;
            --text-muted: #8899BB;
            --text-heading: #FFFFFF;
            --text-sub: rgba(232, 237, 245, 0.75);
            --card-bg: rgba(17, 34, 64, 0.82);
            --card-border: rgba(201, 168, 76, 0.18);
            --input-bg: rgba(17, 34, 64, 0.6);
            --glass: rgba(255, 255, 255, 0.04);
            --nav-bg: rgba(11, 22, 40, 0.88);
            --footer-bg: #112240;
            --badge-bg: rgba(201, 168, 76, 0.08);
            --badge-border: rgba(201, 168, 76, 0.22);
            --badge-color: #E8C97A;
            --fab-shadow: rgba(13, 115, 119, 0.4);
            --T: 0.4s;
            --navbar-h: 80px;
        }

        body.light {
            --navy: #F0F4FF;
            --navy-mid: #E4EAF8;
            --navy-light: #D0DAF0;
            --bg-page: #F0F4FF;
            --bg-section-alt: #E4EAF8;
            --text-main: #1A2A4A;
            --text-muted: #4A5A7A;
            --text-heading: #0B1628;
            --text-sub: rgba(26, 42, 74, 0.72);
            --card-bg: rgba(255, 255, 255, 0.92);
            --card-border: rgba(13, 115, 119, 0.18);
            --glass: rgba(13, 115, 119, 0.04);
            --nav-bg: rgba(240, 244, 255, 0.92);
            --footer-bg: #E4EAF8;
            --badge-bg: rgba(13, 115, 119, 0.08);
            --badge-border: rgba(13, 115, 119, 0.25);
            --badge-color: #0D7377;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            overflow-x: hidden;
            cursor: none;
            transition: background var(--T), color var(--T);
        }

        /* ── Custom Cursor ── */
        #cur {
            position: fixed;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--gold);
            pointer-events: none;
            z-index: 99999;
            transform: translate(-50%, -50%);
            mix-blend-mode: difference;
        }

        #cur-ring {
            position: fixed;
            width: 34px;
            height: 34px;
            border: 1.5px solid var(--emerald-l);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99998;
            transform: translate(-50%, -50%);
            transition: width .3s, height .3s, border-color .3s;
        }

        #cur-ring.hover {
            width: 52px;
            height: 52px;
            border-color: var(--gold);
        }

        @media(max-width:768px) {
            body {
                cursor: auto;
            }

            #cur,
            #cur-ring {
                display: none;
            }
        }

        /* ═══ NAVBAR ═══ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-h);
            background: var(--nav-bg);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--card-border);
            z-index: 1000;
            transition: background var(--T), border-color var(--T);
        }

        .nav-inner {
            max-width: 1320px;
            margin: 0 auto;
            height: 100%;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        /* Logo */
        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }

        .nav-logo-img {
            width: 52px;
            height: 52px;
            border-radius: 13px;
            object-fit: contain;
            box-shadow: 0 4px 18px rgba(13, 115, 119, .45);
            transition: transform .4s cubic-bezier(.34, 1.56, .64, 1);
        }

        .nav-logo:hover .nav-logo-img {
            transform: rotate(-8deg) scale(1.1);
        }

        .nav-logo-text {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.15;
            transition: color var(--T);
        }

        .nav-logo-text span {
            display: block;
            font-size: .68rem;
            font-weight: 400;
            color: var(--text-muted);
            letter-spacing: .6px;
        }

        /* Nav Menu */
        .nav-menu {
            display: flex;
            list-style: none;
            gap: .15rem;
            align-items: center;
        }

        .nav-menu a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: .84rem;
            font-weight: 500;
            padding: .42rem .82rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: .42rem;
            transition: color var(--T), background var(--T);
            white-space: nowrap;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--gold);
            background: rgba(201, 168, 76, .1);
        }

        /* Nav icon animations */
        .nav-icon-wrap {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nav-icon-wrap img {
            width: 18px;
            height: 18px;
            object-fit: contain;
            transition: transform .35s;
            filter: drop-shadow(0 1px 3px rgba(0, 0, 0, .3));
        }

        .nav-menu a:hover .nav-icon-wrap img,
        .nav-menu a.active .nav-icon-wrap img {
            filter: drop-shadow(0 2px 8px rgba(201, 168, 76, .5));
        }

        .nav-anim-bounce:hover .nav-icon-wrap img {
            animation: iconBounce .5s cubic-bezier(.34, 1.56, .64, 1);
        }

        .nav-anim-spin:hover .nav-icon-wrap img {
            animation: iconSpin .6s ease-in-out;
        }

        .nav-anim-pulse:hover .nav-icon-wrap img {
            animation: iconPulse .5s ease-in-out;
        }

        .nav-anim-shake:hover .nav-icon-wrap img {
            animation: iconShake .5s ease-in-out;
        }

        .nav-anim-wobble:hover .nav-icon-wrap img {
            animation: iconWobble .6s ease-in-out;
        }

        .nav-anim-swing:hover .nav-icon-wrap img {
            animation: iconSwing .5s ease-in-out;
        }

        @keyframes iconBounce {
            0% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-6px);
            }

            70% {
                transform: translateY(-2px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes iconSpin {
            0% {
                transform: rotate(0);
            }

            50% {
                transform: rotate(180deg) scale(1.15);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        @keyframes iconShake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-4px);
            }

            40% {
                transform: translateX(4px);
            }

            60% {
                transform: translateX(-3px);
            }

            80% {
                transform: translateX(3px);
            }
        }

        @keyframes iconWobble {

            0%,
            100% {
                transform: rotate(0);
            }

            20% {
                transform: rotate(-8deg);
            }

            50% {
                transform: rotate(8deg);
            }

            80% {
                transform: rotate(-4deg);
            }
        }

        @keyframes iconSwing {

            0%,
            100% {
                transform: rotate(0) scale(1);
            }

            30% {
                transform: rotate(-10deg) scale(1.1);
            }

            70% {
                transform: rotate(10deg) scale(1.1);
            }
        }

        /* Right side */
        .nav-right {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .theme-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all .3s;
            flex-shrink: 0;
        }

        .theme-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .btn-nav {
            padding: .5rem 1.2rem;
            border-radius: 8px;
            border: 1px solid var(--emerald);
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 115, 119, .4);
        }

        .btn-admin-nav {
            padding: .45rem 1rem;
            border-radius: 8px;
            background: rgba(201, 168, 76, .12);
            border: 1px solid rgba(201, 168, 76, .25);
            color: var(--gold-l);
            font-size: .78rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            transition: all .3s;
        }

        .btn-admin-nav:hover {
            background: rgba(201, 168, 76, .2);
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }

        .hamburger span {
            width: 24px;
            height: 2px;
            background: var(--text-muted);
            border-radius: 2px;
            transition: .3s;
        }

        .hamburger.open span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.open span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        /* ─── PAGE WRAP ─── */
        .page-wrap {
            padding-top: var(--navbar-h);
        }

        /* ─── ALERT ─── */
        .alert-wrap {
            max-width: 1320px;
            margin: .8rem auto;
            padding: 0 2rem;
        }

        .alert {
            padding: .85rem 1.2rem;
            border-radius: 10px;
            font-size: .85rem;
            font-weight: 600;
        }

        .alert-success {
            background: rgba(13, 115, 119, .15);
            border: 1px solid rgba(13, 115, 119, .3);
            color: var(--emerald-ll);
        }

        .alert-error {
            background: rgba(239, 68, 68, .1);
            border: 1px solid rgba(239, 68, 68, .25);
            color: #f87171;
        }

        /* ═══ FOOTER ═══ */
        footer {
            background: var(--footer-bg);
            border-top: 1px solid var(--card-border);
            padding: 3rem 2rem 2rem;
            transition: background var(--T), border-color var(--T);
        }

        .footer-inner {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }

        .footer-desc {
            font-size: .85rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-top: .8rem;
        }

        .footer-col h4 {
            font-size: .9rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 1rem;
            transition: color var(--T);
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .footer-col ul li a {
            font-size: .83rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color .3s;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .footer-col ul li a img {
            width: 14px;
            height: 14px;
            object-fit: contain;
        }

        .footer-col ul li a:hover {
            color: var(--gold-l);
        }

        body.light .footer-col ul li a:hover {
            color: var(--emerald);
        }

        .footer-bottom {
            max-width: 1320px;
            margin: 2rem auto 0;
            padding-top: 1.5rem;
            border-top: 1px solid var(--card-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: .8rem;
        }

        .footer-copy {
            font-size: .8rem;
            color: var(--text-muted);
        }

        .footer-tag {
            font-size: .78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .footer-tag .em {
            color: var(--emerald-ll);
        }

        body.light .footer-tag .em {
            color: var(--emerald);
        }

        /* ═══ SCROLL REVEAL ═══ */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .6s cubic-bezier(.16, 1, .3, 1), transform .6s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-d1 {
            transition-delay: .1s;
        }

        .reveal-d2 {
            transition-delay: .2s;
        }

        .reveal-d3 {
            transition-delay: .3s;
        }

        @media(max-width:1100px) {
            .footer-inner {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
        }

        @media(max-width:768px) {
            .hamburger {
                display: flex;
            }

            .nav-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--nav-bg);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 1rem;
                transform: translateY(-120%);
                opacity: 0;
                pointer-events: none;
                transition: all .4s cubic-bezier(.16, 1, .3, 1);
                border-bottom: 1px solid var(--card-border);
            }

            .nav-menu.open {
                transform: translateY(0);
                opacity: 1;
                pointer-events: all;
            }

            .nav-menu a {
                border-radius: 10px;
                padding: .7rem 1.2rem;
            }

            .btn-nav {
                display: none;
            }

            .footer-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div id="cur"></div>
    <div id="cur-ring"></div>

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar" id="navbar">
        <div class="nav-inner">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('assets/logo nurulilmi.png') }}" alt="NurulIlmi" class="nav-logo-img"
                    onerror="this.style.display='none'">
                <div class="nav-logo-text">
                    NurulIlmi
                    <span>Media Pembelajaran Islami</span>
                </div>
            </a>

            {{-- Nav Menu --}}
            <ul class="nav-menu" id="navMenu">
                <li>
                    <a href="{{ route('home') }}"
                        class="nav-anim-bounce {{ request()->routeIs('home') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/beranda.png') }}" alt="Beranda"
                                onerror="this.replaceWith(document.createTextNode('🏠'))">
                        </div>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('atp') }}" class="nav-anim-spin {{ request()->routeIs('atp') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/ATP.png') }}" alt="ATP"
                                onerror="this.replaceWith(document.createTextNode('📋'))">
                        </div>
                        ATP
                    </a>
                </li>
                <li>
                    <a href="{{ route('video.index') }}"
                        class="nav-anim-pulse {{ request()->routeIs('video.*') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/videos.png') }}" alt="Video"
                                onerror="this.replaceWith(document.createTextNode('🎬'))">
                        </div>
                        Video
                    </a>
                </li>
                <li>
                    <a href="{{ route('materi.index') }}"
                        class="nav-anim-shake {{ request()->routeIs('materi.*') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/zakat.png') }}" alt="Materi"
                                onerror="this.replaceWith(document.createTextNode('📚'))">
                        </div>
                        Materi
                    </a>
                </li>
                <li>
                    <a href="{{ route('evaluasi') }}"
                        class="nav-anim-wobble {{ request()->routeIs('evaluasi') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/evaluasi.png') }}" alt="Evaluasi"
                                onerror="this.replaceWith(document.createTextNode('📝'))">
                        </div>
                        Evaluasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('profil') }}"
                        class="nav-anim-swing {{ request()->routeIs('profil') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <img src="{{ asset('assets/profil.png') }}" alt="Profil"
                                onerror="this.replaceWith(document.createTextNode('👤'))">
                        </div>
                        Profil
                    </a>
                </li>
            </ul>

            {{-- Right Side --}}
            <div class="nav-right">
                <button class="theme-btn" id="themeBtn" title="Toggle tema">🌙</button>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-admin-nav">⚙ Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="theme-btn" style="font-size:.75rem;width:auto;padding:.3rem .8rem;"
                            title="Keluar">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('materi.index') }}" class="btn-nav">✦ Mulai Belajar</a>
                @endauth

                <div class="hamburger" id="hamburger">
                    <span></span><span></span><span></span>
                </div>
            </div>

        </div>
    </nav>

    <!-- ═══ CONTENT ═══ -->
    <div class="page-wrap">
        @if (session('success'))
            <div class="alert-wrap">
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert-wrap">
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="{{ route('home') }}" class="nav-logo">
                    <img src="{{ asset('assets/logo nurulilmi.png') }}" alt="NurulIlmi" class="nav-logo-img"
                        style="width:44px;height:44px;" onerror="this.style.display='none'">
                    <div class="nav-logo-text">NurulIlmi<span>Media Pembelajaran Islami</span></div>
                </a>
                <p class="footer-desc">Platform pembelajaran interaktif Zakat, Mawaris, dan Haji berbasis web.
                    Dikembangkan sebagai media pembelajaran modern untuk proses belajar mengajar yang efektif.</p>
            </div>
            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><img src="{{ asset('assets/beranda.png') }}"
                                alt="">Beranda</a></li>
                    <li><a href="{{ route('atp') }}"><img src="{{ asset('assets/ATP.png') }}" alt="">ATP</a>
                    </li>
                    <li><a href="{{ route('video.index') }}"><img src="{{ asset('assets/videos.png') }}"
                                alt="">Video</a></li>
                    <li><a href="{{ route('materi.index') }}">📚 Materi</a></li>
                    <li><a href="{{ route('evaluasi') }}"><img src="{{ asset('assets/evaluasi.png') }}"
                                alt="">Evaluasi</a></li>
                    <li><a href="{{ route('profil') }}"><img src="{{ asset('assets/profil.png') }}"
                                alt="">Profil</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Topik</h4>
                <ul>
                    <li><a href="{{ route('materi.index', ['topik' => 'zakat']) }}"><img
                                src="{{ asset('assets/zakat.png') }}" alt="">Zakat</a></li>
                    <li><a href="{{ route('materi.index', ['topik' => 'mawaris']) }}"><img
                                src="{{ asset('assets/mawaris.png') }}" alt="">Mawaris</a></li>
                    <li><a href="{{ route('materi.index', ['topik' => 'haji']) }}">🕋 Haji</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Referensi</h4>
                <ul>
                    <li><a href="#">Kurikulum Merdeka</a></li>
                    <li><a href="#">Al-Qur'an & Hadits</a></li>
                    <li><a href="#">Kemenag RI</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">© {{ date('Y') }} NurulIlmi — Media Pembelajaran Interaktif Zakat, Mawaris &
                Haji</p>
            <div class="footer-tag">Dikembangkan dengan <span class="em">❤</span> untuk pendidikan Islam yang
                lebih baik</div>
        </div>
    </footer>

    <!-- ═══ SCRIPTS ═══ -->
    <script>
        // Custom Cursor
        const cur = document.getElementById('cur'),
            ring = document.getElementById('cur-ring');
        let mx = 0,
            my = 0,
            cx = 0,
            cy = 0;
        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
        });
        (function anim() {
            cx += (mx - cx) * .25;
            cy += (my - cy) * .25;
            cur.style.left = mx + 'px';
            cur.style.top = my + 'px';
            ring.style.left = cx + 'px';
            ring.style.top = cy + 'px';
            requestAnimationFrame(anim);
        })();
        document.querySelectorAll('a,button,.materi-card,.fitur-card,.topic-card').forEach(el => {
            el.addEventListener('mouseenter', () => ring.classList.add('hover'));
            el.addEventListener('mouseleave', () => ring.classList.remove('hover'));
        });

        // Theme Toggle
        const themeBtn = document.getElementById('themeBtn');
        let isLight = localStorage.getItem('zmh-theme') === 'light';

        function applyTheme(light) {
            document.body.classList.toggle('light', light);
            themeBtn.textContent = light ? '☀️' : '🌙';
            updateNavBg();
        }
        applyTheme(isLight);
        themeBtn.addEventListener('click', () => {
            isLight = !isLight;
            localStorage.setItem('zmh-theme', isLight ? 'light' : 'dark');
            applyTheme(isLight);
        });

        // Navbar scroll
        function updateNavBg() {
            const nb = document.getElementById('navbar');
            const s = window.scrollY > 50;
            nb.style.background = isLight ?
                (s ? 'rgba(240,244,255,0.98)' : 'rgba(240,244,255,0.92)') :
                (s ? 'rgba(11,22,40,0.97)' : 'rgba(11,22,40,0.88)');
        }
        window.addEventListener('scroll', updateNavBg);

        // Hamburger
        const ham = document.getElementById('hamburger'),
            menu = document.getElementById('navMenu');
        ham.addEventListener('click', () => {
            ham.classList.toggle('open');
            menu.classList.toggle('open');
        });
        document.addEventListener('click', e => {
            if (!ham.contains(e.target) && !menu.contains(e.target)) {
                ham.classList.remove('open');
                menu.classList.remove('open');
            }
        });

        // Scroll Reveal
        const revObs = new IntersectionObserver(entries => {
            entries.forEach((en, i) => {
                if (en.isIntersecting) setTimeout(() => en.target.classList.add('visible'), i * 80);
            });
        }, {
            threshold: .1,
            rootMargin: '0px 0px -50px 0px'
        });
        document.querySelectorAll('.reveal').forEach(el => revObs.observe(el));
    </script>
    @stack('scripts')
</body>

</html>
