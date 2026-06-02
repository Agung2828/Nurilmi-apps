@extends('layouts.app')
@section('title', 'Profil Pengembang')

@push('styles')
    <style>
        :root {
            --navbar-h: 64px;
        }

        .page-hero {
            padding: calc(var(--navbar-h) + 3.5rem) 2rem 4rem;
            background:
                radial-gradient(ellipse 70% 50% at 30% 50%, rgba(13, 115, 119, .15) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(201, 168, 76, .07) 0%, transparent 50%),
                var(--navy);
            position: relative;
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            opacity: .03;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23C9A84C' fill-opacity='1'%3E%3Cpath d='M30 0l8.66 15H21.34L30 0zm0 60l-8.66-15h17.32L30 60zM0 30l15-8.66v17.32L0 30zm60 0L45 38.66V21.34L60 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        body.light .page-hero {
            background:
                radial-gradient(ellipse 70% 50% at 30% 50%, rgba(13, 115, 119, .1) 0%, transparent 60%),
                var(--navy);
        }

        .page-hero-inner {
            max-width: 1320px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .page-breadcrumb {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.2rem;
        }

        .page-breadcrumb a {
            font-size: .8rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color .3s;
        }

        .page-breadcrumb a:hover {
            color: var(--gold-l);
        }

        .page-breadcrumb span {
            color: var(--text-muted);
            font-size: .8rem;
        }

        .page-breadcrumb .current {
            color: var(--gold-l);
            font-size: .8rem;
            font-weight: 600;
        }

        .page-title-wrap {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .page-icon-big {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--emerald), var(--navy-light));
            border: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            flex-shrink: 0;
            box-shadow: 0 8px 28px rgba(13, 115, 119, .3);
        }

        .page-eyebrow {
            font-size: .75rem;
            font-weight: 600;
            color: var(--gold-l);
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: .4rem;
        }

        .page-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: .6rem;
        }

        body.light .page-title {
            color: var(--text-dark);
        }

        .page-title .em {
            background: linear-gradient(135deg, var(--emerald-ll), var(--gold-l));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .page-desc {
            font-size: .97rem;
            color: var(--text-muted);
            line-height: 1.8;
            max-width: 680px;
        }

        section {
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1320px;
            margin: 0 auto;
        }

        /* PROFILE LAYOUT */
        .profile-section {
            background: var(--navy);
        }

        body.light .profile-section {
            background: var(--off-white);
        }

        .profile-main-grid {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 2.5rem;
            align-items: start;
        }

        /* LEFT CARD */
        .profile-left-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            backdrop-filter: blur(12px);
            text-align: center;
            position: sticky;
            top: calc(var(--navbar-h) + 1.5rem);
            transition: all .35s;
        }

        .profile-left-card:hover {
            border-color: var(--emerald-l);
        }

        .photo-wrap {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .photo-ring {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--emerald), var(--gold));
            padding: 3px;
            box-shadow: 0 0 0 4px rgba(13, 115, 119, .2), 0 8px 32px rgba(0, 0, 0, .3);
            animation: ringPulse 3s ease-in-out infinite;
        }

        @keyframes ringPulse {

            0%,
            100% {
                box-shadow: 0 0 0 4px rgba(13, 115, 119, .2), 0 8px 32px rgba(0, 0, 0, .3);
            }

            50% {
                box-shadow: 0 0 0 8px rgba(13, 115, 119, .15), 0 12px 40px rgba(13, 115, 119, .2);
            }
        }

        .photo-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--navy-light), var(--navy-mid));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .photo-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            object-position: center top;
        }

        .photo-placeholder {
            font-size: 3.5rem;
        }

        .online-dot {
            position: absolute;
            bottom: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--emerald-ll);
            border: 3px solid var(--navy-mid);
            animation: dotBlink 2s ease-in-out infinite;
        }

        @keyframes dotBlink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .profile-name {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: .25rem;
            line-height: 1.3;
        }

        body.light .profile-name {
            color: var(--text-dark);
        }

        .profile-role {
            font-size: .83rem;
            color: var(--emerald-ll);
            font-weight: 600;
            margin-bottom: .2rem;
        }

        .profile-degree {
            font-size: .78rem;
            color: var(--gold-l);
            margin-bottom: .8rem;
        }

        /* BIODATA MINI */
        .biodata-mini {
            background: var(--glass);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: .9rem 1rem;
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .bd-row {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            padding: .3rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, .04);
        }

        .bd-row:last-child {
            border-bottom: none;
        }

        .bd-icon {
            font-size: .85rem;
            flex-shrink: 0;
            margin-top: .08rem;
        }

        .bd-label {
            font-size: .65rem;
            color: var(--text-muted);
            font-weight: 600;
            display: block;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .bd-val {
            font-size: .78rem;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.4;
        }

        body.light .bd-val {
            color: var(--text-dark);
        }

        .profile-quick-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .7rem;
            margin-bottom: 1.2rem;
        }

        .pqs-item {
            background: var(--glass);
            border: 1px solid var(--card-border);
            border-radius: 10px;
            padding: .8rem .6rem;
            text-align: center;
        }

        .pqs-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--gold-l);
            display: block;
        }

        .pqs-label {
            font-size: .65rem;
            color: var(--text-muted);
        }

        .social-row {
            display: flex;
            gap: .6rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1.2rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--glass);
            border: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all .3s;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: var(--gold-l);
            background: rgba(201, 168, 76, .1);
            transform: translateY(-3px);
        }

        .btn-contact {
            width: 100%;
            padding: .7rem;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
        }

        .btn-contact:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 115, 119, .4);
        }

        /* RIGHT PANELS */
        .profile-right {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profile-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 2rem;
            backdrop-filter: blur(12px);
            transition: all .35s;
        }

        .profile-card:hover {
            border-color: var(--emerald-l);
        }

        .pc-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: .5rem;
            padding-bottom: .8rem;
            border-bottom: 1px solid var(--card-border);
        }

        body.light .pc-title {
            color: var(--text-dark);
        }

        /* BIODATA FULL GRID */
        .biodata-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .biodata-item {
            background: var(--glass);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            transition: all .3s;
        }

        .biodata-item:hover {
            border-color: var(--emerald-l);
        }

        .bi-label {
            font-size: .68rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-bottom: .3rem;
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        .bi-val {
            font-size: .9rem;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.5;
        }

        body.light .bi-val {
            color: var(--text-dark);
        }

        /* ABOUT */
        .about-text {
            font-size: .9rem;
            color: var(--text-muted);
            line-height: 1.9;
            margin-bottom: 1rem;
        }

        .highlight-quote {
            padding: 1.2rem 1.4rem;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(13, 115, 119, .1), rgba(201, 168, 76, .05));
            border: 1px solid rgba(13, 115, 119, .2);
            border-left: 3px solid var(--emerald-l);
        }

        .highlight-quote p {
            font-size: .88rem;
            color: var(--text-muted);
            line-height: 1.8;
            font-style: italic;
        }

        .highlight-quote cite {
            font-size: .75rem;
            color: var(--gold-l);
            font-style: normal;
            font-weight: 600;
            margin-top: .5rem;
            display: block;
        }

        /* EDU TIMELINE */
        .edu-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .edu-item {
            display: flex;
            gap: 1.2rem;
            position: relative;
            padding-bottom: 1.5rem;
        }

        .edu-item:last-child {
            padding-bottom: 0;
        }

        .edu-dot-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
        }

        .edu-dot {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            border: 1px solid var(--card-border);
        }

        .edu-dot-s3 {
            background: linear-gradient(135deg, var(--gold), var(--gold-l));
        }

        .edu-dot-s2 {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
        }

        .edu-dot-s1 {
            background: linear-gradient(135deg, var(--navy-light), var(--navy-light));
        }

        .edu-line {
            width: 2px;
            flex: 1;
            background: linear-gradient(to bottom, var(--card-border), transparent);
            margin-top: .3rem;
        }

        .edu-content {
            padding-top: .35rem;
            flex: 1;
        }

        .edu-year {
            font-size: .68rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-bottom: .25rem;
        }

        .edu-degree {
            font-size: .95rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .15rem;
        }

        body.light .edu-degree {
            color: var(--text-dark);
        }

        .edu-univ {
            font-size: .8rem;
            color: var(--text-muted);
        }

        .edu-badge {
            display: inline-block;
            margin-top: .4rem;
            padding: .18rem .65rem;
            border-radius: 4px;
            font-size: .68rem;
            font-weight: 600;
            background: rgba(201, 168, 76, .1);
            color: var(--gold-l);
            border: 1px solid rgba(201, 168, 76, .18);
        }

        /* SKILLS */
        .skills-section-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .skill-group-title {
            font-size: .78rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .skill-bar-list {
            display: flex;
            flex-direction: column;
            gap: .9rem;
        }

        .skill-bar-head {
            display: flex;
            justify-content: space-between;
            margin-bottom: .35rem;
        }

        .skill-name {
            font-size: .83rem;
            color: var(--text-main);
            font-weight: 500;
        }

        .skill-pct {
            font-size: .8rem;
            color: var(--gold-l);
            font-weight: 700;
        }

        .skill-bar {
            height: 5px;
            background: rgba(255, 255, 255, .07);
            border-radius: 10px;
            overflow: hidden;
        }

        .skill-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
            transition: width 1.4s cubic-bezier(.16, 1, .3, 1);
            width: 0;
        }

        .tech-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .tech-chip {
            padding: .3rem .8rem;
            border-radius: 6px;
            font-size: .72rem;
            font-weight: 600;
            background: rgba(13, 115, 119, .1);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .18);
            transition: all .25s;
            cursor: default;
        }

        .tech-chip:hover {
            background: rgba(13, 115, 119, .2);
            border-color: var(--emerald-l);
        }

        .tech-chip.gold-chip {
            background: rgba(201, 168, 76, .1);
            color: var(--gold-l);
            border-color: rgba(201, 168, 76, .2);
        }

        .tech-chip.gold-chip:hover {
            background: rgba(201, 168, 76, .18);
        }

        /* RESEARCH */
        .research-list {
            display: flex;
            flex-direction: column;
            gap: .9rem;
        }

        .research-item {
            padding: 1.2rem 1.4rem;
            border-radius: 12px;
            background: var(--glass);
            border: 1px solid var(--card-border);
            transition: all .3s;
        }

        .research-item:hover {
            border-color: var(--emerald-l);
            transform: translateX(4px);
        }

        .ri-top {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .4rem;
        }

        .ri-year {
            font-size: .68rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .4px;
            background: rgba(201, 168, 76, .1);
            padding: .15rem .55rem;
            border-radius: 4px;
        }

        .ri-type {
            font-size: .68rem;
            color: var(--text-muted);
        }

        .ri-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .3rem;
            line-height: 1.45;
        }

        body.light .ri-title {
            color: var(--text-dark);
        }

        .ri-desc {
            font-size: .78rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        .ri-tags {
            display: flex;
            flex-wrap: wrap;
            gap: .35rem;
            margin-top: .6rem;
        }

        .ri-tag {
            padding: .15rem .55rem;
            border-radius: 4px;
            font-size: .66rem;
            font-weight: 600;
            background: rgba(13, 115, 119, .1);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .15);
        }

        /* PLATFORM GRID */
        .platform-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .plat-card {
            background: var(--glass);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 1.2rem;
            text-align: center;
            transition: all .3s;
        }

        .plat-card:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
        }

        .plat-icon {
            font-size: 1.8rem;
            margin-bottom: .5rem;
            display: block;
        }

        .plat-label {
            font-size: .72rem;
            color: var(--text-muted);
            margin-bottom: .25rem;
        }

        .plat-val {
            font-size: .88rem;
            font-weight: 700;
            color: var(--text-main);
        }

        body.light .plat-val {
            color: var(--text-dark);
        }

        /* CTA */
        .cta-card {
            background: linear-gradient(135deg, rgba(13, 115, 119, .2), rgba(201, 168, 76, .08));
            border: 1px solid rgba(13, 115, 119, .25);
            border-radius: 18px;
            padding: 2rem;
            text-align: center;
        }

        .cta-card h3 {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: .5rem;
        }

        body.light .cta-card h3 {
            color: var(--text-dark);
        }

        .cta-card p {
            font-size: .88rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .cta-row {
            display: flex;
            gap: .8rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: .7rem 1.6rem;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .88rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 115, 119, .4);
        }

        .btn-outline-gold {
            padding: .7rem 1.6rem;
            border-radius: 9px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-main);
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-outline-gold:hover {
            border-color: var(--gold-l);
            color: var(--gold-l);
        }

        @media(max-width:1100px) {
            .profile-main-grid {
                grid-template-columns: 280px 1fr;
                gap: 1.5rem;
            }

            .skills-section-wrap {
                grid-template-columns: 1fr;
            }

            .biodata-grid {
                grid-template-columns: 1fr;
            }

            .platform-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:900px) {
            .profile-main-grid {
                grid-template-columns: 1fr;
            }

            .profile-left-card {
                position: static;
                max-width: 400px;
                margin: 0 auto;
            }
        }

        @media(max-width:768px) {
            .page-title {
                font-size: 2rem;
            }

            .platform-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:480px) {
            .page-title {
                font-size: 1.7rem;
            }
        }
    </style>
@endpush

@section('content')

    {{-- PAGE HERO --}}
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="page-breadcrumb">
                <a href="{{ route('home') }}">🏠 Beranda</a>
                <span>›</span>
                <span class="current">👤 Profil Pengembang</span>
            </div>
            <div class="page-title-wrap">
                <div class="page-icon-big">👤</div>
                <div>
                    <div class="page-eyebrow">✦ Peneliti &amp; Pengembang Media Pembelajaran</div>
                    <h1 class="page-title">Profil <span class="em">Pengembang</span></h1>
                    <p class="page-desc">Mengenal lebih dekat pengembang media pembelajaran interaktif NurulIlmi — pendidik
                        dan peneliti PAI yang berdedikasi dalam menghadirkan media pembelajaran Islam berbasis teknologi web
                        modern.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- PROFILE SECTION --}}
    <section class="profile-section">
        <div class="container">
            <div class="profile-main-grid">

                {{-- LEFT STICKY CARD --}}
                <div class="profile-left-card reveal">
                    <div class="photo-wrap">
                        <div class="photo-ring">
                            <div class="photo-inner">
                                {{-- Ganti dengan path foto asli jika ada, misal: asset('images/profile.jpg') --}}
                                <img src="{{ asset('assets/foto_profile.jpeg') }}" alt="Foto Hengki Ras Bumi">
                            </div>
                        </div>
                        <div class="online-dot"></div>
                    </div>
                    <div class="profile-name">Hengki Ras Bumi, M.Pd</div>
                    <div class="profile-role">Pendidik &amp; Peneliti PAI</div>
                    <div class="profile-degree">✦ Magister Pendidikan (M.Pd)</div>

                    {{-- BIODATA MINI --}}
                    <div class="biodata-mini">
                        <div class="bd-row">
                            <span class="bd-icon">📅</span>
                            <div>
                                <span class="bd-label">Tempat, Tgl. Lahir</span>
                                <span class="bd-val">Simandolak, 04 April 1991</span>
                            </div>
                        </div>
                        <div class="bd-row">
                            <span class="bd-icon">🕌</span>
                            <div>
                                <span class="bd-label">Agama</span>
                                <span class="bd-val">Islam</span>
                            </div>
                        </div>
                        <div class="bd-row">
                            <span class="bd-icon">📍</span>
                            <div>
                                <span class="bd-label">Alamat</span>
                                <span class="bd-val">Pangkalan Indarung, Kec. Singingi, Kab. Kuantan Singingi</span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-quick-stats">
                        <div class="pqs-item">
                            <span class="pqs-num">3</span>
                            <div class="pqs-label">Topik Materi</div>
                        </div>
                        <div class="pqs-item">
                            <span class="pqs-num">18</span>
                            <div class="pqs-label">Video</div>
                        </div>
                        <div class="pqs-item">
                            <span class="pqs-num">18</span>
                            <div class="pqs-label">Sub-Topik</div>
                        </div>
                        <div class="pqs-item">
                            <span class="pqs-num">M.Pd</span>
                            <div class="pqs-label">Akademik</div>
                        </div>
                    </div>

                    <div class="social-row">
                        <a href="mailto:hengkirasbumi@email.com" class="social-btn" title="Email">📧</a>
                        <a href="#" class="social-btn" title="ResearchGate">🔬</a>
                        <a href="#" class="social-btn" title="Academia.edu">🎓</a>
                        <a href="#" class="social-btn" title="LinkedIn">💼</a>
                        <a href="https://wa.me/6282285839036" class="social-btn" title="WhatsApp" target="_blank">💬</a>
                    </div>
                    <a href="https://wa.me/6282285839036" class="btn-contact" target="_blank"
                        style="display:block;text-decoration:none;">
                        💬 Hubungi via WhatsApp
                    </a>
                </div>

                {{-- RIGHT PANELS --}}
                <div class="profile-right">

                    {{-- BIODATA LENGKAP --}}
                    <div class="profile-card reveal">
                        <div class="pc-title">📋 Biodata Lengkap</div>
                        <div class="biodata-grid">
                            <div class="biodata-item">
                                <div class="bi-label">👤 Nama Lengkap</div>
                                <div class="bi-val">Hengki Ras Bumi, M.Pd</div>
                            </div>
                            <div class="biodata-item">
                                <div class="bi-label">📅 Tempat, Tgl. Lahir</div>
                                <div class="bi-val">Simandolak, 04 April 1991</div>
                            </div>
                            <div class="biodata-item">
                                <div class="bi-label">⚧ Jenis Kelamin</div>
                                <div class="bi-val">Laki-laki</div>
                            </div>
                            <div class="biodata-item">
                                <div class="bi-label">🕌 Agama</div>
                                <div class="bi-val">Islam</div>
                            </div>
                            <div class="biodata-item">
                                <div class="bi-label">💍 Status Pernikahan</div>
                                <div class="bi-val">Menikah</div>
                            </div>
                            <div class="biodata-item">
                                <div class="bi-label">🏘️ RT / RW</div>
                                <div class="bi-val">002 / 001</div>
                            </div>
                            <div class="biodata-item" style="grid-column: 1 / -1;">
                                <div class="bi-label">📍 Alamat Lengkap</div>
                                <div class="bi-val">Pangkalan Indarung, Kecamatan Singingi, Kabupaten Kuantan Singingi,
                                    Riau</div>
                            </div>
                        </div>
                    </div>

                    {{-- ABOUT --}}
                    <div class="profile-card reveal">
                        <div class="pc-title">📖 Tentang Saya</div>
                        <p class="about-text">Saya adalah pendidik dan peneliti di bidang Pendidikan Agama Islam yang
                            berkomitmen dalam menghadirkan inovasi pembelajaran berbasis teknologi. Platform NurulIlmi ini
                            merupakan wujud nyata upaya saya dalam menjembatani ilmu fiqih Islam — khususnya Zakat, Mawaris,
                            dan Haji — dengan kebutuhan pembelajaran digital yang modern dan interaktif.</p>
                        <p class="about-text">Berlatar belakang dari Kuantan Singingi, saya memiliki semangat besar untuk
                            memajukan kualitas pendidikan agama Islam, terutama bagi peserta didik SMA/MA dan para guru PAI
                            di Indonesia. Media pembelajaran ini dirancang agar setiap konsep fiqih dapat dipahami dengan
                            mudah, mendalam, dan menyenangkan.</p>
                        <div class="highlight-quote">
                            <p>"Pengembangan media pembelajaran interaktif ini merupakan langkah konkret untuk menjawab
                                tantangan pembelajaran PAI di era digital — mendekatkan ilmu fiqih kepada generasi yang
                                akrab dengan teknologi tanpa mengorbankan kedalaman akademik."</p>
                            <cite>— Hengki Ras Bumi, M.Pd</cite>
                        </div>
                    </div>

                    {{-- EDUCATION --}}
                    <div class="profile-card reveal">
                        <div class="pc-title">🎓 Riwayat Pendidikan</div>
                        <div class="edu-timeline">
                            <div class="edu-item">
                                <div class="edu-dot-col">
                                    <div class="edu-dot edu-dot-s3">🏛️</div>
                                    <div class="edu-line"></div>
                                </div>
                                <div class="edu-content">
                                    <div class="edu-year">Program Doktoral (S3)</div>
                                    <div class="edu-degree">Doktor Pendidikan Agama Islam</div>
                                    <div class="edu-univ">Universitas Islam — Program Studi PAI</div>
                                    <span class="edu-badge">Sedang Berjalan</span>
                                </div>
                            </div>
                            <div class="edu-item">
                                <div class="edu-dot-col">
                                    <div class="edu-dot edu-dot-s2">📘</div>
                                    <div class="edu-line"></div>
                                </div>
                                <div class="edu-content">
                                    <div class="edu-year">Magister (S2)</div>
                                    <div class="edu-degree">Magister Pendidikan (M.Pd)</div>
                                    <div class="edu-univ">Program Studi Pendidikan Agama Islam</div>
                                    <span class="edu-badge">Lulus</span>
                                </div>
                            </div>
                            <div class="edu-item">
                                <div class="edu-dot-col">
                                    <div class="edu-dot edu-dot-s1">🎒</div>
                                </div>
                                <div class="edu-content">
                                    <div class="edu-year">Sarjana (S1)</div>
                                    <div class="edu-degree">Sarjana Pendidikan Agama Islam</div>
                                    <div class="edu-univ">Program Studi Pendidikan Agama Islam</div>
                                    <span class="edu-badge">Lulus</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- RESEARCH --}}
                    <div class="profile-card reveal">
                        <div class="pc-title">🔬 Penelitian &amp; Karya Ilmiah</div>
                        <div class="research-list">
                            <div class="research-item">
                                <div class="ri-top">
                                    <span class="ri-year">2025</span>
                                    <span class="ri-type">Pengembangan Media — Sedang Berjalan</span>
                                </div>
                                <div class="ri-title">Pengembangan Media Pembelajaran Interaktif Berbasis Web pada Materi
                                    Zakat, Mawaris, dan Haji untuk Meningkatkan Hasil Belajar Peserta Didik SMA/MA</div>
                                <div class="ri-desc">Penelitian pengembangan (R&amp;D) yang menghasilkan platform NurulIlmi
                                    sebagai media pembelajaran PAI yang valid, praktis, dan efektif berbasis Kurikulum
                                    Merdeka.</div>
                                <div class="ri-tags">
                                    <span class="ri-tag">R&amp;D</span>
                                    <span class="ri-tag">Media Pembelajaran</span>
                                    <span class="ri-tag">Fiqih</span>
                                    <span class="ri-tag">Web-Based</span>
                                    <span class="ri-tag">Kurikulum Merdeka</span>
                                </div>
                            </div>
                            <div class="research-item">
                                <div class="ri-top">
                                    <span class="ri-year">2023</span>
                                    <span class="ri-type">Jurnal Nasional Terakreditasi</span>
                                </div>
                                <div class="ri-title">Efektivitas Pembelajaran Berbasis Teknologi dalam Meningkatkan
                                    Pemahaman Fiqih Kontemporer Peserta Didik SMA/MA</div>
                                <div class="ri-desc">Studi quasi-eksperimen yang membuktikan signifikansi peningkatan hasil
                                    belajar fiqih menggunakan media digital interaktif dibandingkan pembelajaran
                                    konvensional di sekolah menengah atas.</div>
                                <div class="ri-tags">
                                    <span class="ri-tag">Quasi-Eksperimen</span>
                                    <span class="ri-tag">E-Learning</span>
                                    <span class="ri-tag">SMA/MA</span>
                                    <span class="ri-tag">Fiqih</span>
                                </div>
                            </div>
                            <div class="research-item">
                                <div class="ri-top">
                                    <span class="ri-year">Tesis S2</span>
                                    <span class="ri-type">Karya Ilmiah</span>
                                </div>
                                <div class="ri-title">Implementasi Kurikulum dalam Pembelajaran Fiqih Berbasis Pendekatan
                                    Saintifik di Madrasah Aliyah</div>
                                <div class="ri-desc">Penelitian yang mengkaji implementasi pendekatan saintifik dalam
                                    pembelajaran fiqih dan dampaknya terhadap kemampuan berpikir kritis peserta didik
                                    Madrasah Aliyah.</div>
                                <div class="ri-tags">
                                    <span class="ri-tag">Kualitatif</span>
                                    <span class="ri-tag">Saintifik</span>
                                    <span class="ri-tag">Madrasah</span>
                                    <span class="ri-tag">Fiqih</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PLATFORM INFO --}}
                    <div class="profile-card reveal">
                        <div class="pc-title">🕌 Tentang Platform NurulIlmi</div>
                        <div class="platform-grid">
                            <div class="plat-card">
                                <span class="plat-icon">📋</span>
                                <div class="plat-label">ATP &amp; Kurikulum</div>
                                <div class="plat-val">Merdeka Belajar</div>
                            </div>
                            <div class="plat-card">
                                <span class="plat-icon">🎬</span>
                                <div class="plat-label">Video Pembelajaran</div>
                                <div class="plat-val">18 Video</div>
                            </div>
                            <div class="plat-card">
                                <span class="plat-icon">📚</span>
                                <div class="plat-label">Materi Digital</div>
                                <div class="plat-val">18 Sub-topik</div>
                            </div>
                            <div class="plat-card">
                                <span class="plat-icon">📝</span>
                                <div class="plat-label">Soal Evaluasi</div>
                                <div class="plat-val">Interaktif</div>
                            </div>
                            <div class="plat-card">
                                <span class="plat-icon">📱</span>
                                <div class="plat-label">Responsivitas</div>
                                <div class="plat-val">Semua Device</div>
                            </div>
                            <div class="plat-card">
                                <span class="plat-icon">🏆</span>
                                <div class="plat-label">Target Pengguna</div>
                                <div class="plat-val">Guru &amp; Siswa</div>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="cta-card reveal">
                        <h3>💬 Ada Pertanyaan atau Kolaborasi?</h3>
                        <p>Jika Anda seorang guru, dosen, atau peneliti yang ingin berkolaborasi, memberikan masukan, atau
                            berkonsultasi tentang media pembelajaran ini, silakan hubungi melalui email atau media sosial
                            yang tersedia.</p>
                        <div class="cta-row">
                            <a href="mailto:hengkirasbumi@email.com" class="btn-primary">📧 Kirim Email</a>
                            <a href="#" class="btn-outline-gold">🔬 ResearchGate</a>
                        </div>
                    </div>

                </div>{{-- end profile-right --}}
            </div>{{-- end profile-main-grid --}}
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Skill bar animation on scroll
        const skillObs = new IntersectionObserver(entries => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    en.target.querySelectorAll('.skill-fill').forEach(bar => {
                        const w = bar.dataset.w;
                        bar.style.width = '0';
                        setTimeout(() => {
                            bar.style.width = w + '%';
                        }, 300);
                    });
                    skillObs.unobserve(en.target);
                }
            });
        }, {
            threshold: .3
        });

        document.querySelectorAll('.skill-bar-list').forEach(el => skillObs.observe(el));

        // Reveal on scroll
        const revObs = new IntersectionObserver((entries) => {
            entries.forEach((en, i) => {
                if (en.isIntersecting) setTimeout(() => en.target.classList.add('visible'), i * 80);
            });
        }, {
            threshold: .1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.reveal').forEach(el => revObs.observe(el));
    </script>
@endpush
