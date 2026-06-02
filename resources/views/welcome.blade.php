@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
    <style>
        /* ═══ HERO ═══ */
        .hero {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-top: var(--navbar-h);
        }

        .hero-slider {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            background: linear-gradient(to right, rgba(11, 22, 40, 0.85) 0%, rgba(11, 22, 40, 0.58) 50%, rgba(11, 22, 40, 0.28) 100%);
            transition: background var(--T);
        }

        body.light .hero-overlay {
            background: linear-gradient(to right, rgba(225, 235, 255, 0.90) 0%, rgba(225, 235, 255, 0.62) 50%, rgba(225, 235, 255, 0.18) 100%);
        }

        .slider-dots {
            position: absolute;
            bottom: 6rem;
            left: 2rem;
            display: flex;
            gap: .6rem;
            z-index: 10;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .35);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all .3s;
        }

        .slider-dot.active {
            background: var(--gold);
            width: 28px;
            border-radius: 4px;
        }

        .hero-inner {
            position: relative;
            z-index: 10;
            max-width: 1320px;
            margin: 0 auto;
            width: 100%;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .hero-text {
            animation: slideInL .9s cubic-bezier(.16, 1, .3, 1) both;
        }

        @keyframes slideInL {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(201, 168, 76, .12);
            border: 1px solid rgba(201, 168, 76, .35);
            border-radius: 6px;
            padding: .35rem .9rem;
            margin-bottom: 1.5rem;
            font-size: .75rem;
            font-weight: 600;
            color: var(--gold-l);
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        body.light .hero-eyebrow {
            background: rgba(13, 115, 119, .1);
            border-color: rgba(13, 115, 119, .35);
            color: var(--emerald);
        }

        .hero-eyebrow::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            display: inline-block;
            animation: pulse 2s ease-in-out infinite;
        }

        body.light .hero-eyebrow::before {
            background: var(--emerald);
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: .6;
            }
        }

        .hero-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 3.4rem;
            font-weight: 800;
            line-height: 1.12;
            margin-bottom: 1.5rem;
            color: var(--text-heading);
            transition: color var(--T);
        }

        .hero-title .em {
            background: linear-gradient(135deg, var(--emerald-ll), var(--gold-l));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-desc {
            font-size: 1.05rem;
            line-height: 1.9;
            color: var(--text-sub);
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .btn-primary {
            padding: .85rem 2rem;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .3s;
            box-shadow: 0 4px 20px rgba(13, 115, 119, .35);
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(13, 115, 119, .5);
        }

        .btn-outline {
            padding: .85rem 2rem;
            border-radius: 10px;
            border: 1.5px solid rgba(255, 255, 255, .35);
            background: rgba(255, 255, 255, .1);
            color: #fff;
            font-size: .95rem;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .3s;
            text-decoration: none;
            backdrop-filter: blur(8px);
        }

        body.light .btn-outline {
            border-color: rgba(10, 20, 40, .25);
            color: var(--text-heading);
            background: rgba(10, 20, 40, .07);
        }

        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold);
            transform: translateY(-3px);
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
        }

        .hero-stat-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--gold);
            display: block;
            line-height: 1;
        }

        .hero-stat-label {
            font-size: .75rem;
            color: var(--text-sub);
            margin-top: .2rem;
        }

        .hero-visual {
            position: relative;
            animation: slideInR .9s cubic-bezier(.16, 1, .3, 1) .2s both;
        }

        @keyframes slideInR {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-card-main {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 2.5rem;
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .35);
        }

        body.light .hero-card-main {
            box-shadow: 0 20px 60px rgba(0, 0, 0, .12);
        }

        .hero-card-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
        }

        .hc-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .topic-cards {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: .8rem;
            margin-bottom: 1.5rem;
        }

        .topic-card {
            border-radius: 12px;
            padding: 1.2rem .9rem;
            text-align: center;
            border: 1px solid var(--card-border);
            background: rgba(255, 255, 255, .05);
            transition: all .3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        body.light .topic-card {
            background: rgba(13, 115, 119, .05);
        }

        .topic-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--emerald), transparent);
            opacity: 0;
            transition: opacity .3s;
            border-radius: 12px;
        }

        .topic-card:hover::before {
            opacity: .15;
        }

        .topic-card:hover {
            border-color: var(--emerald-l);
            transform: translateY(-4px);
        }

        .tc-img {
            width: 48px;
            height: 48px;
            margin: 0 auto .6rem;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, .3));
            animation: tcFloat 3s ease-in-out infinite;
        }

        .topic-card:nth-child(2) .tc-img {
            animation-delay: -.8s;
        }

        .topic-card:nth-child(3) .tc-img {
            animation-delay: -1.6s;
        }

        @keyframes tcFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .topic-card:hover .tc-img {
            animation: tcBounce .5s cubic-bezier(.34, 1.56, .64, 1);
            filter: drop-shadow(0 4px 12px rgba(201, 168, 76, .5));
        }

        @keyframes tcBounce {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2) rotate(-5deg);
            }

            100% {
                transform: scale(1);
            }
        }

        .tc-label {
            font-size: .78rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .topic-card:hover .tc-label {
            color: var(--emerald-ll);
        }

        .prog-item {
            margin-bottom: 1rem;
        }

        .prog-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .4rem;
        }

        .prog-label {
            font-size: .82rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .prog-label-icon {
            width: 16px;
            height: 16px;
            object-fit: contain;
        }

        .prog-val {
            font-size: .82rem;
            font-weight: 700;
            color: var(--gold-l);
        }

        .prog-bar {
            height: 5px;
            background: rgba(255, 255, 255, .08);
            border-radius: 10px;
            overflow: hidden;
        }

        body.light .prog-bar {
            background: rgba(11, 22, 40, .1);
        }

        .prog-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
            position: relative;
        }

        .prog-fill::after {
            content: '';
            position: absolute;
            right: 0;
            top: -3px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: var(--gold);
            border: 2px solid var(--bg-section-alt);
        }

        .fc {
            position: absolute;
            background: rgba(11, 22, 40, 0.85);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: .8rem 1rem;
            backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            gap: .6rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .25);
            white-space: nowrap;
            animation: fcFloat 6s ease-in-out infinite;
        }

        body.light .fc {
            background: rgba(255, 255, 255, 0.95);
        }

        .fc-1 {
            top: -30px;
            right: 20px;
        }

        .fc-2 {
            bottom: 40px;
            left: -30px;
            animation-delay: -3s;
        }

        @keyframes fcFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .fc-icon {
            font-size: 1.3rem;
        }

        .fc-text {
            font-size: .75rem;
            font-weight: 600;
            color: #fff;
        }

        body.light .fc-text {
            color: #0B1628;
        }

        .fc-sub {
            font-size: .65rem;
            color: rgba(255, 255, 255, .6);
            display: block;
            margin-top: .1rem;
        }

        body.light .fc-sub {
            color: rgba(11, 22, 40, .55);
        }

        .hero-wave path {
            fill: #112240;
            transition: fill var(--T);
        }

        body.light .hero-wave path {
            fill: #E4EAF8;
        }

        /* ═══ SECTIONS ═══ */
        section {
            padding: 5rem 2rem;
        }

        .container {
            max-width: 1320px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .s-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            border: 1px solid rgba(201, 168, 76, .22);
            border-radius: 6px;
            padding: .3rem .9rem;
            margin-bottom: .9rem;
            font-size: .72rem;
            font-weight: 600;
            color: #E8C97A;
            letter-spacing: .6px;
            text-transform: uppercase;
            background: rgba(201, 168, 76, .08);
        }

        body.light .s-badge {
            background: rgba(13, 115, 119, .08);
            border-color: rgba(13, 115, 119, .25);
            color: #0D7377;
        }

        .s-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: .6rem;
            line-height: 1.2;
        }

        .s-title .em {
            background: linear-gradient(135deg, var(--emerald-ll), var(--gold-l));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .s-sub {
            font-size: .97rem;
            color: var(--text-muted);
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ═══ MATERI SECTION ═══ */
        .materi-section {
            background: var(--bg-section-alt, #112240);
            transition: background var(--T);
        }

        .materi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .materi-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2.2rem;
            backdrop-filter: blur(12px);
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .materi-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--emerald), transparent);
            opacity: 0;
            transition: opacity .4s;
            border-radius: 16px;
        }

        .materi-card:hover::after {
            opacity: .07;
        }

        .materi-card:hover {
            transform: translateY(-8px);
            border-color: var(--emerald-l);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .2);
        }

        .mc-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: rgba(201, 168, 76, .15);
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            line-height: 1;
        }

        body.light .mc-num {
            color: rgba(13, 115, 119, .12);
        }

        .mc-img {
            width: 60px;
            height: 60px;
            margin-bottom: 1.2rem;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, .3));
            position: relative;
            z-index: 1;
            animation: mcFloat 4s ease-in-out infinite;
        }

        .materi-card:nth-child(2) .mc-img {
            animation-delay: -1.3s;
        }

        @keyframes mcFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0);
            }

            50% {
                transform: translateY(-6px) rotate(3deg);
            }
        }

        .materi-card:hover .mc-img {
            animation: mcHover .6s cubic-bezier(.34, 1.56, .64, 1);
            filter: drop-shadow(0 6px 16px rgba(201, 168, 76, .4));
        }

        @keyframes mcHover {
            0% {
                transform: scale(1) rotate(0);
            }

            40% {
                transform: scale(1.2) rotate(-8deg);
            }

            70% {
                transform: scale(1.1) rotate(4deg);
            }

            100% {
                transform: scale(1) rotate(0);
            }
        }

        .mc-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: .6rem;
        }

        .mc-desc {
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.75;
            margin-bottom: 1.3rem;
        }

        .mc-topics {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }

        .mc-tag {
            padding: .2rem .65rem;
            border-radius: 5px;
            font-size: .7rem;
            font-weight: 600;
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .2);
        }

        body.light .mc-tag {
            background: rgba(13, 115, 119, .1);
            color: var(--emerald);
            border-color: rgba(13, 115, 119, .25);
        }

        /* ═══ FITUR SECTION ═══ */
        .fitur-section {
            background: var(--bg-page);
            transition: background var(--T);
        }

        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.2rem;
        }

        .fitur-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.8rem 1.5rem;
            text-align: center;
            transition: all .35s;
            backdrop-filter: blur(10px);
        }

        .fitur-card:hover {
            transform: translateY(-6px);
            border-color: var(--gold);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .18);
        }

        .fi-icon-wrap {
            width: 68px;
            height: 68px;
            border-radius: 16px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, rgba(13, 115, 119, .15), rgba(201, 168, 76, .08));
            border: 1px solid rgba(201, 168, 76, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .35s, box-shadow .35s;
            position: relative;
            overflow: hidden;
        }

        .fitur-card:hover .fi-icon-wrap {
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 8px 24px rgba(13, 115, 119, .3);
        }

        .fi-icon-img {
            width: 38px;
            height: 38px;
            object-fit: contain;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, .25));
            animation: fiFloat 3.5s ease-in-out infinite;
        }

        .fitur-card:nth-child(2) .fi-icon-img {
            animation-delay: -.8s;
        }

        .fitur-card:nth-child(3) .fi-icon-img {
            animation-delay: -1.7s;
        }

        .fitur-card:nth-child(4) .fi-icon-img {
            animation-delay: -2.6s;
        }

        @keyframes fiFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .fitur-card:hover .fi-icon-img {
            animation: fiHover .5s cubic-bezier(.34, 1.56, .64, 1) forwards;
        }

        @keyframes fiHover {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.25) rotate(10deg);
            }

            100% {
                transform: scale(1.05);
            }
        }

        .fi-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: .5rem;
        }

        .fi-desc {
            font-size: .8rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* ═══ CTA SECTION ═══ */
        .cta-section {
            background: linear-gradient(135deg, var(--emerald) 0%, #1A3A5C 60%, #112240 100%);
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='.03'%3E%3Cpath d='M30 0l8.66 15H21.34L30 0zm0 60l-8.66-15h17.32L30 60zM0 30l15-8.66v17.32L0 30zm60 0L45 38.66V21.34L60 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .cta-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-white {
            padding: .9rem 2rem;
            border-radius: 10px;
            background: #fff;
            color: var(--emerald);
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            border: none;
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
        }

        .btn-outline-white {
            padding: .9rem 2rem;
            border-radius: 10px;
            background: transparent;
            color: #fff;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid rgba(255, 255, 255, .45);
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .btn-outline-white:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, .12);
            transform: translateY(-3px);
        }

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:1100px) {
            .hero-inner {
                gap: 3rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .materi-grid {
                grid-template-columns: 1fr 1fr;
            }

            .fitur-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:768px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
                padding: 2rem 1.5rem;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-cta,
            .hero-stats {
                justify-content: center;
            }

            .fc-1,
            .fc-2 {
                display: none;
            }

            .slider-dots {
                left: 50%;
                transform: translateX(-50%);
                bottom: 5rem;
            }

            .materi-grid {
                grid-template-columns: 1fr;
            }

            .fitur-grid {
                grid-template-columns: 1fr 1fr;
            }

            .s-title {
                font-size: 2rem;
            }
        }

        @media(max-width:480px) {
            .hero-title {
                font-size: 1.9rem;
            }

            .fitur-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                gap: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══ HERO ═══ --}}
    <section class="hero" id="home">
        <div class="hero-slider" id="heroSlider">
            <div class="hero-slide active" style="background-image:url('{{ asset('assets/makkah.png') }}')"></div>
            <div class="hero-slide" style="background-image:url('{{ asset('assets/nabawi.png') }}')"></div>
            <div class="hero-slide" style="background-image:url('{{ asset('assets/alaqsa.jpg') }}')"></div>
        </div>

        <div class="hero-overlay" id="heroOverlay"></div>

        <div class="slider-dots" id="sliderDots">
            <button class="slider-dot active" data-index="0"></button>
            <button class="slider-dot" data-index="1"></button>
            <button class="slider-dot" data-index="2"></button>
        </div>

        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-eyebrow">✦ Media Pembelajaran Interaktif Berbasis Web</div>
                <h1 class="hero-title">
                    Belajar <span class="em">Zakat,<br>Mawaris,</span> dan<br>Haji
                </h1>
                <p class="hero-desc">
                    Platform pembelajaran islami modern yang dirancang untuk guru, dosen, mahasiswa, dan peserta didik.
                    Sajikan materi fiqih secara interaktif, terstruktur, dan menyenangkan.
                </p>
                <div class="hero-cta">
                    <a href="{{ route('materi.index') }}" class="btn-primary">📚 Jelajahi Materi</a>
                    <a href="{{ route('atp') }}" class="btn-outline">📋 Lihat ATP</a>
                </div>
                <div class="hero-stats">
                    <div>
                        <span class="hero-stat-num">12+</span>
                        <div class="hero-stat-label">Topik Materi</div>
                    </div>
                    <div>
                        <span class="hero-stat-num" id="statVideo">9</span>
                        <div class="hero-stat-label">Video Belajar</div>
                    </div>
                    <div>
                        <span class="hero-stat-num">30</span>
                        <div class="hero-stat-label">Soal Evaluasi</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="fc fc-1">
                    <div class="fc-icon">🎓</div>
                    <div class="fc-text">Akademik<span class="fc-sub">Level Disertasi S3</span></div>
                </div>
                <div class="fc fc-2">
                    <div class="fc-icon">✅</div>
                    <div class="fc-text">Kurikulum Merdeka<span class="fc-sub">Sesuai CP & TP</span></div>
                </div>

                <div class="hero-card-main">
                    <div class="hc-title">🕌 Topik Pembelajaran</div>
                    <div class="topic-cards">
                        <div class="topic-card">
                            <img src="{{ asset('assets/zakat.png') }}" alt="Zakat" class="tc-img"
                                onerror="this.replaceWith(Object.assign(document.createElement('div'),{textContent:'🤲',style:'font-size:2.5rem;margin-bottom:.6rem;'}))">
                            <div class="tc-label">Zakat</div>
                        </div>
                        <div class="topic-card">
                            <img src="{{ asset('assets/mawaris.png') }}" alt="Mawaris" class="tc-img"
                                onerror="this.replaceWith(Object.assign(document.createElement('div'),{textContent:'⚖️',style:'font-size:2.5rem;margin-bottom:.6rem;'}))">
                            <div class="tc-label">Mawaris</div>
                        </div>
                        <div class="topic-card">
                            <span
                                style="font-size:2.5rem;display:block;margin-bottom:.6rem;animation:tcFloat 3s ease-in-out infinite;animation-delay:-1.6s;">🕋</span>
                            <div class="tc-label">Haji</div>
                        </div>
                    </div>
                    <div>
                        <div class="prog-item">
                            <div class="prog-head">
                                <span class="prog-label">
                                    <img src="{{ asset('assets/zakat.png') }}" class="prog-label-icon" alt=""
                                        onerror="this.style.display='none'"> Materi Tersedia
                                </span>
                                <span class="prog-val">12 Topik</span>
                            </div>
                            <div class="prog-bar">
                                <div class="prog-fill" style="width:90%"></div>
                            </div>
                        </div>
                        <div class="prog-item">
                            <div class="prog-head">
                                <span class="prog-label">
                                    <img src="{{ asset('assets/videos.png') }}" class="prog-label-icon" alt=""
                                        onerror="this.style.display='none'"> Video Pembelajaran
                                </span>
                                <span class="prog-val">9 Video</span>
                            </div>
                            <div class="prog-bar">
                                <div class="prog-fill" style="width:75%"></div>
                            </div>
                        </div>
                        <div class="prog-item">
                            <div class="prog-head">
                                <span class="prog-label">
                                    <img src="{{ asset('assets/evaluasi.png') }}" class="prog-label-icon" alt=""
                                        onerror="this.style.display='none'"> Soal Evaluasi
                                </span>
                                <span class="prog-val">30 Soal</span>
                            </div>
                            <div class="prog-bar">
                                <div class="prog-fill" style="width:60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <svg class="hero-wave"
            style="position:absolute;bottom:-1px;left:0;display:block;width:100%;line-height:0;z-index:5;"
            viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C200,80 400,0 600,40 C800,80 1000,0 1200,40 C1300,60 1380,50 1440,40 L1440,80 L0,80 Z" />
            <path d="M0,55 C180,20 380,70 600,55 C820,40 1020,80 1200,55 C1320,42 1400,58 1440,55 L1440,80 L0,80 Z"
                opacity=".6" />
        </svg>
    </section>

    {{-- ═══ MATERI OVERVIEW ═══ --}}
    <section class="materi-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="s-badge">✦ Topik Pembelajaran</div>
                <h2 class="s-title">Tiga Pilar <span class="em">Fiqih Islam</span></h2>
                <p class="s-sub">Materi lengkap dan terstruktur mencakup zakat, waris, dan haji dengan pendekatan akademik
                    modern berbasis Kurikulum Merdeka.</p>
            </div>
            <div class="materi-grid">
                <a href="{{ route('materi.index', ['topik' => 'zakat']) }}" class="materi-card reveal reveal-d1"
                    style="text-decoration:none;">
                    <div class="mc-num">01</div>
                    <img src="{{ asset('assets/zakat.png') }}" alt="Zakat" class="mc-img"
                        onerror="this.replaceWith(Object.assign(document.createElement('div'),{textContent:'🤲',style:'font-size:2.8rem;margin-bottom:1.2rem;'}))">
                    <div class="mc-title">Zakat</div>
                    <p class="mc-desc">Kajian mendalam tentang zakat fitrah dan zakat maal, nisab, muzakki, mustahiq, dan
                        implementasi di era modern.</p>
                    <div class="mc-topics">
                        <span class="mc-tag">Zakat Fitrah</span>
                        <span class="mc-tag">Zakat Maal</span>
                        <span class="mc-tag">BAZNAS</span>
                        <span class="mc-tag">Kontemporer</span>
                    </div>
                </a>
                <a href="{{ route('materi.index', ['topik' => 'mawaris']) }}" class="materi-card reveal reveal-d2"
                    style="text-decoration:none;">
                    <div class="mc-num">02</div>
                    <img src="{{ asset('assets/mawaris.png') }}" alt="Mawaris" class="mc-img"
                        onerror="this.replaceWith(Object.assign(document.createElement('div'),{textContent:'⚖️',style:'font-size:2.8rem;margin-bottom:1.2rem;'}))">
                    <div class="mc-title">Mawaris</div>
                    <p class="mc-desc">Ilmu faraid, pembagian harta warisan, ahli waris, ashabul furudh, ashabah, dan
                        penyelesaian kasus warisan secara matematis.</p>
                    <div class="mc-topics">
                        <span class="mc-tag">Ilmu Faraid</span>
                        <span class="mc-tag">Ahli Waris</span>
                        <span class="mc-tag">Perhitungan</span>
                        <span class="mc-tag">Praktik</span>
                    </div>
                </a>
                <a href="{{ route('materi.index', ['topik' => 'haji']) }}" class="materi-card reveal reveal-d3"
                    style="text-decoration:none;">
                    <div class="mc-num">03</div>
                    <span
                        style="font-size:2.8rem;margin-bottom:1.2rem;display:block;animation:mcFloat 4s ease-in-out infinite;animation-delay:-2.6s;">🕋</span>
                    <div class="mc-title">Haji</div>
                    <p class="mc-desc">Manasik haji dan umrah, rukun, wajib, sunnah, hal yang membatalkan, serta hikmah
                        ibadah haji dalam kehidupan.</p>
                    <div class="mc-topics">
                        <span class="mc-tag">Manasik</span>
                        <span class="mc-tag">Rukun Haji</span>
                        <span class="mc-tag">Umrah</span>
                        <span class="mc-tag">Hikmah</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ FITUR PLATFORM ═══ --}}
    <section class="fitur-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="s-badge">✦ Fitur Platform</div>
                <h2 class="s-title">Dirancang untuk <span class="em">Pembelajaran Efektif</span></h2>
                <p class="s-sub">Setiap fitur didesain secara pedagogis untuk mendukung proses pembelajaran yang
                    interaktif dan bermakna.</p>
            </div>
            <div class="fitur-grid">
                <a href="{{ route('atp') }}" class="fitur-card reveal reveal-d1" style="text-decoration:none;">
                    <div class="fi-icon-wrap">
                        <img src="{{ asset('assets/ATP.png') }}" alt="ATP" class="fi-icon-img"
                            onerror="this.replaceWith(Object.assign(document.createElement('span'),{textContent:'📋',style:'font-size:2rem;'}))">
                    </div>
                    <div class="fi-title">Alur Tujuan Pembelajaran</div>
                    <p class="fi-desc">CP, TP, dan alur pembelajaran terstruktur sesuai Kurikulum Merdeka.</p>
                </a>
                <a href="{{ route('video.index') }}" class="fitur-card reveal reveal-d2" style="text-decoration:none;">
                    <div class="fi-icon-wrap">
                        <img src="{{ asset('assets/videos.png') }}" alt="Video" class="fi-icon-img"
                            onerror="this.replaceWith(Object.assign(document.createElement('span'),{textContent:'🎬',style:'font-size:2rem;'}))">
                    </div>
                    <div class="fi-title">Video Interaktif</div>
                    <p class="fi-desc">Video pembelajaran berkualitas dari sumber terpercaya, terfilter per topik.</p>
                </a>
                <a href="{{ route('materi.index') }}" class="fitur-card reveal reveal-d1" style="text-decoration:none;">
                    <div class="fi-icon-wrap">
                        <img src="{{ asset('assets/mawaris.png') }}" alt="Materi" class="fi-icon-img"
                            onerror="this.replaceWith(Object.assign(document.createElement('span'),{textContent:'📚',style:'font-size:2rem;'}))">
                    </div>
                    <div class="fi-title">Materi Digital</div>
                    <p class="fi-desc">Materi lengkap dengan accordion, tab interaktif, dan unduhan PDF.</p>
                </a>
                <a href="{{ route('evaluasi') }}" class="fitur-card reveal reveal-d2" style="text-decoration:none;">
                    <div class="fi-icon-wrap">
                        <img src="{{ asset('assets/evaluasi.png') }}" alt="Evaluasi" class="fi-icon-img"
                            onerror="this.replaceWith(Object.assign(document.createElement('span'),{textContent:'📝',style:'font-size:2rem;'}))">
                    </div>
                    <div class="fi-title">Evaluasi Gamifikasi</div>
                    <p class="fi-desc">Kuis interaktif dengan skor, progress bar, dan animasi hasil belajar.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-section">
        <div class="container" style="position:relative;z-index:2;">
            <div class="section-header reveal">
                <h2 class="s-title" style="color:#fff;">Siap Memulai Pembelajaran?</h2>
                <p class="s-sub" style="color:rgba(255,255,255,.8);margin-bottom:2.5rem;">
                    Akses seluruh materi, video, dan evaluasi secara gratis untuk mendukung proses pembelajaran Anda.
                </p>
            </div>
            <div class="cta-btns reveal">
                <a href="{{ route('materi.index') }}" class="btn-white">📚 Mulai Belajar Sekarang</a>
                <a href="{{ route('atp') }}" class="btn-outline-white">📋 Lihat ATP</a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // ── Slider ──
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0,
            sliderTimer = null;

        function goToSlide(i) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = i;
            slides[i].classList.add('active');
            dots[i].classList.add('active');
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function startAutoSlide() {
            sliderTimer = setInterval(nextSlide, 5000);
        }

        function resetAutoSlide() {
            clearInterval(sliderTimer);
            startAutoSlide();
        }

        dots.forEach(d => d.addEventListener('click', () => {
            goToSlide(parseInt(d.dataset.index));
            resetAutoSlide();
        }));
        startAutoSlide();

        // ── Progress bar animation ──
        const progObs = new IntersectionObserver(entries => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    en.target.querySelectorAll('.prog-fill').forEach(bar => {
                        const w = bar.style.width;
                        bar.style.width = '0';
                        setTimeout(() => {
                            bar.style.transition = 'width 1.2s cubic-bezier(.16,1,.3,1)';
                            bar.style.width = w;
                        }, 200);
                    });
                }
            });
        }, {
            threshold: .3
        });
        document.querySelectorAll('.hero-card-main').forEach(el => progObs.observe(el));
    </script>
@endpush
