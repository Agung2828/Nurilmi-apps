@extends('layouts.app')
@section('title', 'Evaluasi Pembelajaran')

@push('styles')
    <style>
        :root {
            --navbar-h: 64px;
        }

        .page-hero {
            padding: calc(var(--navbar-h) + 3.5rem) 2rem 4rem;
            background: radial-gradient(ellipse 70% 50% at 30% 50%, rgba(13, 115, 119, .15) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(201, 168, 76, .07) 0%, transparent 50%),
                var(--navy);
            position: relative;
            overflow: hidden;
        }

        body.light .page-hero {
            background: radial-gradient(ellipse 70% 50% at 30% 50%, rgba(13, 115, 119, .1) 0%, transparent 60%), var(--navy);
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
            color: #1A2A3A;
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

        .info-strip {
            background: var(--navy-mid);
            padding: 2.5rem 2rem;
        }

        body.light .info-strip {
            background: var(--navy-light);
        }

        .info-strip-inner {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.2rem;
        }

        .info-strip-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.4rem 1.6rem;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all .3s;
        }

        .info-strip-card:hover {
            border-color: var(--emerald-l);
            transform: translateY(-3px);
        }

        .isc-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(13, 115, 119, .2), rgba(201, 168, 76, .1));
            border: 1px solid rgba(201, 168, 76, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .isc-label {
            font-size: .72rem;
            color: var(--text-muted);
            font-weight: 500;
            display: block;
            margin-bottom: .2rem;
        }

        .isc-val {
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
        }

        body.light .isc-val {
            color: #1A2A3A;
        }

        section {
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1320px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .s-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            border: 1px solid var(--card-border);
            border-radius: 6px;
            padding: .3rem .9rem;
            margin-bottom: .9rem;
            font-size: .72rem;
            font-weight: 600;
            color: var(--gold-l);
            letter-spacing: .6px;
            text-transform: uppercase;
            background: rgba(201, 168, 76, .08);
        }

        .s-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: .6rem;
            line-height: 1.2;
        }

        body.light .s-title {
            color: #1A2A3A;
        }

        .s-title .em {
            background: linear-gradient(135deg, var(--emerald-ll), var(--gold-l));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .s-sub {
            font-size: .95rem;
            color: var(--text-muted);
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        .filter-wrap {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }

        .f-tab {
            padding: .5rem 1.3rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s;
            font-family: 'Nunito', sans-serif;
        }

        .f-tab:hover,
        .f-tab.active {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            border-color: transparent;
            color: #fff;
        }

        .quiz-section {
            background: var(--navy);
        }

        body.light .quiz-section {
            background: #F0F4FF;
        }

        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .quiz-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 2rem;
            backdrop-filter: blur(12px);
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .quiz-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .4s;
        }

        .quiz-card:hover::before {
            transform: scaleX(1);
        }

        .quiz-card:hover {
            transform: translateY(-8px);
            border-color: var(--emerald-l);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
        }

        .qc-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.4rem;
            gap: .8rem;
        }

        .qc-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .qc-icon-z {
            background: linear-gradient(135deg, rgba(13, 115, 119, .25), rgba(13, 115, 119, .1));
            border: 1px solid rgba(13, 115, 119, .25);
        }

        .qc-icon-m {
            background: linear-gradient(135deg, rgba(26, 58, 92, .5), rgba(26, 58, 92, .2));
            border: 1px solid rgba(26, 58, 92, .4);
        }

        .qc-icon-h {
            background: linear-gradient(135deg, rgba(201, 168, 76, .25), rgba(201, 168, 76, .1));
            border: 1px solid rgba(201, 168, 76, .25);
        }

        .diff-badge {
            padding: .25rem .7rem;
            border-radius: 20px;
            font-size: .68rem;
            font-weight: 700;
        }

        .diff-mudah {
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .2);
        }

        .diff-sedang {
            background: rgba(201, 168, 76, .15);
            color: var(--gold-l);
            border: 1px solid rgba(201, 168, 76, .2);
        }

        .diff-sulit {
            background: rgba(180, 60, 60, .15);
            color: #E87070;
            border: 1px solid rgba(180, 60, 60, .2);
        }

        .qc-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .5rem;
        }

        body.light .qc-title {
            color: #1A2A3A;
        }

        .qc-desc {
            font-size: .82rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1.4rem;
        }

        .qc-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .qc-info span {
            display: block;
            font-size: .75rem;
            color: var(--text-muted);
            margin-bottom: .15rem;
        }

        .qc-info strong {
            font-size: .88rem;
            color: var(--text-main);
            font-weight: 700;
        }

        .ring-wrap {
            position: relative;
            width: 56px;
            height: 56px;
        }

        .ring-wrap svg {
            transform: rotate(-90deg);
        }

        .ring-bg {
            fill: none;
            stroke: rgba(255, 255, 255, .07);
            stroke-width: 4;
        }

        .ring-fill {
            fill: none;
            stroke-width: 4;
            stroke-linecap: round;
        }

        .ring-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .7rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .qc-prog-wrap {
            margin-bottom: 1.4rem;
        }

        .qc-prog-label {
            display: flex;
            justify-content: space-between;
            font-size: .72rem;
            color: var(--text-muted);
            margin-bottom: .4rem;
        }

        .qc-prog-bar {
            height: 4px;
            background: rgba(255, 255, 255, .07);
            border-radius: 10px;
            overflow: hidden;
        }

        .qc-prog-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
        }

        .qc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .8rem;
        }

        .qc-tags {
            display: flex;
            gap: .35rem;
            flex-wrap: wrap;
        }

        .qc-tag {
            padding: .18rem .6rem;
            border-radius: 4px;
            font-size: .66rem;
            font-weight: 600;
            background: rgba(13, 115, 119, .12);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .15);
        }

        .btn-mulai {
            padding: .55rem 1.3rem;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .82rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .3s;
            white-space: nowrap;
        }

        .btn-mulai:hover {
            transform: scale(1.05);
        }

        .btn-mulai:disabled {
            opacity: .45;
            cursor: not-allowed;
            transform: none;
        }

        .empty-kuis {
            grid-column: 1/-1;
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-kuis .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .empty-kuis p {
            font-size: .95rem;
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 10, 20, .85);
            backdrop-filter: blur(12px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity .35s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: var(--navy-mid);
            border: 1px solid var(--card-border);
            border-radius: 22px;
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(.96) translateY(20px);
            transition: transform .35s cubic-bezier(.16, 1, .3, 1);
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            padding: 1.8rem 2rem 1.2rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            position: sticky;
            top: 0;
            background: var(--navy-mid);
            z-index: 2;
            border-radius: 22px 22px 0 0;
        }

        .modal-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--white);
        }

        body.light .modal-title {
            color: #1A2A3A;
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s;
        }

        .modal-close:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .modal-body {
            padding: 2rem;
        }

        .quiz-prog-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: .8rem;
        }

        .quiz-prog-txt {
            font-size: .8rem;
            color: var(--text-muted);
        }

        .quiz-prog-bar2 {
            height: 5px;
            background: rgba(255, 255, 255, .07);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .quiz-prog-bar-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--emerald), var(--gold));
            transition: width .5s cubic-bezier(.16, 1, .3, 1);
        }

        .q-num {
            font-size: .72rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .6px;
            text-transform: uppercase;
            margin-bottom: .6rem;
        }

        .q-text {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--white);
            line-height: 1.6;
            margin-bottom: 1.6rem;
        }

        body.light .q-text {
            color: #1A2A3A;
        }

        .q-options {
            display: flex;
            flex-direction: column;
            gap: .7rem;
            margin-bottom: 2rem;
        }

        .q-opt {
            padding: 1rem 1.3rem;
            border-radius: 12px;
            border: 1.5px solid var(--card-border);
            background: var(--glass);
            color: var(--text-main);
            font-size: .9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .25s;
            text-align: left;
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .q-opt:hover:not(.disabled) {
            border-color: var(--emerald-l);
            background: rgba(13, 115, 119, .08);
            color: var(--emerald-ll);
        }

        .q-opt.correct {
            border-color: var(--emerald-l);
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
        }

        .q-opt.wrong {
            border-color: #E87070;
            background: rgba(180, 60, 60, .1);
            color: #E87070;
        }

        .q-opt.disabled {
            cursor: default;
        }

        .q-opt-letter {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .q-feedback {
            padding: 1rem 1.2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: .85rem;
            line-height: 1.7;
            display: none;
        }

        .q-feedback.show {
            display: block;
        }

        .q-feedback.correct-fb {
            background: rgba(13, 115, 119, .12);
            border: 1px solid rgba(13, 115, 119, .25);
            color: var(--emerald-ll);
        }

        .q-feedback.wrong-fb {
            background: rgba(180, 60, 60, .1);
            border: 1px solid rgba(180, 60, 60, .2);
            color: #E87070;
        }

        .quiz-nav {
            display: flex;
            gap: .8rem;
            justify-content: space-between;
        }

        .btn-prev,
        .btn-next {
            padding: .65rem 1.4rem;
            border-radius: 9px;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .3s;
        }

        .btn-prev {
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
        }

        .btn-prev:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .btn-next {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            border: none;
        }

        .btn-next:hover {
            transform: translateY(-2px);
        }

        .result-screen {
            display: none;
            text-align: center;
            padding: 1rem 0;
        }

        .result-screen.show {
            display: block;
        }

        .result-ring-wrap {
            width: 140px;
            height: 140px;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .result-ring-wrap svg {
            transform: rotate(-90deg);
        }

        .result-score-text {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .result-score-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--gold-l);
        }

        .result-score-label {
            font-size: .65rem;
            color: var(--text-muted);
        }

        .result-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: .5rem;
        }

        body.light .result-title {
            color: #1A2A3A;
        }

        .result-sub {
            font-size: .9rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .result-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .result-stat {
            background: var(--glass);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 1rem;
        }

        .result-stat-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--gold-l);
            display: block;
        }

        .result-stat-label {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .result-btns {
            display: flex;
            gap: .8rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-retry {
            padding: .7rem 1.6rem;
            border-radius: 9px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-main);
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .3s;
        }

        .btn-retry:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .tips-section {
            background: var(--navy);
        }

        body.light .tips-section {
            background: #F0F4FF;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.2rem;
        }

        .tip-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.6rem 1.4rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all .35s;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
        }

        .tip-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin: 0 auto .9rem;
            background: linear-gradient(135deg, rgba(13, 115, 119, .2), rgba(201, 168, 76, .1));
            border: 1px solid rgba(201, 168, 76, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .tip-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .4rem;
        }

        body.light .tip-title {
            color: #1A2A3A;
        }

        .tip-text {
            font-size: .78rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        @media(max-width:1100px) {
            .info-strip-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .quiz-grid {
                grid-template-columns: 1fr 1fr;
            }

            .tips-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:768px) {
            .page-title {
                font-size: 2rem;
            }

            .quiz-grid {
                grid-template-columns: 1fr;
            }

            .info-strip-inner {
                grid-template-columns: 1fr 1fr;
            }

            .tips-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:480px) {
            .page-title {
                font-size: 1.7rem;
            }

            .info-strip-inner {
                grid-template-columns: 1fr;
            }

            .tips-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <!-- PAGE HERO -->
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="page-breadcrumb">
                <a href="{{ route('home') }}">🏠 Beranda</a>
                <span>›</span>
                <span class="current">📝 Evaluasi</span>
            </div>
            <div class="page-title-wrap">
                <div class="page-icon-big">📝</div>
                <div>
                    <div class="page-eyebrow">✦ Uji Kompetensi Interaktif</div>
                    <h1 class="page-title">Evaluasi <span class="em">Pembelajaran</span></h1>
                    <p class="page-desc">Uji pemahaman Anda melalui kuis interaktif bergamifikasi dengan soal-soal
                        berkualitas, umpan balik instan, dan rekap nilai per topik Zakat, Mawaris, dan Haji.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO STRIP — data dari controller -->
    <div class="info-strip">
        <div class="info-strip-inner">
            <div class="info-strip-card">
                <div class="isc-icon">📝</div>
                <div>
                    <span class="isc-label">Total Soal</span>
                    <div class="isc-val">{{ $totalSoal }} Soal</div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">📚</div>
                <div>
                    <span class="isc-label">Paket Kuis</span>
                    <div class="isc-val">{{ $totalPaket }} Paket</div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">⏱️</div>
                <div>
                    <span class="isc-label">Durasi Rata-rata</span>
                    <div class="isc-val">
                        @if ($kuis->isNotEmpty())
                            {{ $kuis->min('durasi_menit') }}–{{ $kuis->max('durasi_menit') }} Menit
                        @else
                            — Menit
                        @endif
                    </div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">🏆</div>
                <div>
                    <span class="isc-label">Skor Kelulusan</span>
                    <div class="isc-val">
                        ≥ {{ $kuis->isNotEmpty() ? $kuis->min('skor_lulus') : 75 }} / 100
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QUIZ CARDS — loop dari DB -->
    <section class="quiz-section">
        <div class="container">
            <div class="section-header">
                <div class="s-badge">✦ Pilih Paket Evaluasi</div>
                <h2 class="s-title">Paket <span class="em">Kuis Interaktif</span></h2>
                <p class="s-sub">Pilih paket sesuai topik dan tingkat kesulitan. Setiap kuis dilengkapi umpan balik dan
                    pembahasan.</p>
            </div>

            <div class="filter-wrap">
                <button class="f-tab active" data-filter="all">✦ Semua</button>
                <button class="f-tab" data-filter="zakat">🤲 Zakat</button>
                <button class="f-tab" data-filter="mawaris">⚖️ Mawaris</button>
                <button class="f-tab" data-filter="haji">🕋 Haji</button>
            </div>

            <div class="quiz-grid" id="quizGrid">
                @forelse($kuis as $k)
                    @php
                        $iconClass = match ($k->topik) {
                            'zakat' => 'qc-icon-z',
                            'mawaris' => 'qc-icon-m',
                            'haji' => 'qc-icon-h',
                            default => 'qc-icon-z',
                        };
                        $jumlahSoal = $k->soal->count();
                        $punya_soal = $jumlahSoal > 0;
                    @endphp
                    <div class="quiz-card" data-cat="{{ $k->topik }}">
                        <div class="qc-top">
                            <div class="qc-icon {{ $iconClass }}">{{ $k->icon }}</div>
                            <span class="diff-badge {{ $k->badgeKesulitan() }}">{{ ucfirst($k->kesulitan) }}</span>
                        </div>
                        <div class="qc-title">{{ $k->judul }}</div>
                        <div class="qc-desc">{{ $k->deskripsi ?? 'Uji pemahaman Anda pada topik ini.' }}</div>
                        <div class="qc-meta">
                            <div class="qc-info">
                                <span>{{ $jumlahSoal }} soal pilihan ganda</span>
                                <strong>⏱ {{ $k->durasi_menit }} menit</strong>
                            </div>
                            <div class="ring-wrap">
                                <svg width="56" height="56" viewBox="0 0 56 56">
                                    <circle class="ring-bg" cx="28" cy="28" r="24" />
                                    <circle class="ring-fill" cx="28" cy="28" r="24" stroke="var(--emerald-l)"
                                        stroke-dasharray="150.8" stroke-dashoffset="150.8" />
                                </svg>
                                <div class="ring-text">0%</div>
                            </div>
                        </div>
                        <div class="qc-prog-wrap">
                            <div class="qc-prog-label">
                                <span>Progress</span>
                                <span>Belum dikerjakan</span>
                            </div>
                            <div class="qc-prog-bar">
                                <div class="qc-prog-fill" style="width:0%"></div>
                            </div>
                        </div>
                        <div class="qc-footer">
                            <div class="qc-tags">
                                <span class="qc-tag">{{ ucfirst($k->topik) }}</span>
                                <span class="qc-tag">{{ ucfirst($k->kesulitan) }}</span>
                            </div>
                            @if ($punya_soal)
                                <button class="btn-mulai" onclick="openQuiz({{ $k->id }})">▶ Mulai Kuis</button>
                            @else
                                <button class="btn-mulai" disabled>⏳ Segera Hadir</button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-kuis">
                        <div class="empty-icon">📭</div>
                        <p>Belum ada paket kuis tersedia.<br>
                            Admin belum menambahkan kuis. Silakan cek kembali nanti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- TIPS -->
    <section class="tips-section">
        <div class="container">
            <div class="section-header">
                <div class="s-badge">✦ Strategi Belajar</div>
                <h2 class="s-title">Tips <span class="em">Mengerjakan Evaluasi</span></h2>
            </div>
            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">📖</div>
                    <div class="tip-title">Baca Materi Dulu</div>
                    <p class="tip-text">Pastikan Anda telah membaca materi di halaman Materi sebelum mengerjakan evaluasi
                        untuk hasil yang optimal.</p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">⏰</div>
                    <div class="tip-title">Perhatikan Waktu</div>
                    <p class="tip-text">Setiap paket memiliki batas waktu. Kerjakan soal mudah terlebih dahulu, lalu kembali
                        ke soal sulit.</p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">📝</div>
                    <div class="tip-title">Baca Pembahasan</div>
                    <p class="tip-text">Setelah selesai, baca pembahasan setiap soal untuk memahami konsep yang belum
                        dikuasai.</p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">🔄</div>
                    <div class="tip-title">Ulangi Jika Perlu</div>
                    <p class="tip-text">Kuis dapat diulang berkali-kali. Targetkan skor ≥ 75 untuk dinyatakan lulus setiap
                        paket evaluasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL QUIZ -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-title" id="modalTitle">📝 Kuis Interaktif</div>
                <button class="modal-close" onclick="closeQuiz()">✕</button>
            </div>
            <div class="modal-body">
                <div id="quizScreen">
                    <div class="quiz-prog-top">
                        <span class="quiz-prog-txt" id="progTxt">Soal 1 dari 5</span>
                        <span class="quiz-prog-txt" id="timerTxt">⏱ 00:00</span>
                    </div>
                    <div class="quiz-prog-bar2">
                        <div class="quiz-prog-bar-fill" id="quizProgFill" style="width:20%"></div>
                    </div>
                    <div class="q-num" id="qNum">SOAL 01</div>
                    <div class="q-text" id="qText"></div>
                    <div class="q-options" id="qOpts"></div>
                    <div class="q-feedback" id="qFeedback"></div>
                    <div class="quiz-nav">
                        <button class="btn-prev" id="btnPrev" onclick="prevQ()">← Sebelumnya</button>
                        <button class="btn-next" id="btnNext" onclick="nextQ()">Selanjutnya →</button>
                    </div>
                </div>
                <div class="result-screen" id="resultScreen">
                    <div class="result-ring-wrap">
                        <svg width="140" height="140" viewBox="0 0 140 140">
                            <circle cx="70" cy="70" r="60" fill="none" stroke="rgba(255,255,255,.06)"
                                stroke-width="10" />
                            <circle id="resultRingFill" cx="70" cy="70" r="60" fill="none"
                                stroke="var(--gold-l)" stroke-width="10" stroke-dasharray="376.9"
                                stroke-dashoffset="376.9" stroke-linecap="round" transform="rotate(-90 70 70)" />
                        </svg>
                        <div class="result-score-text">
                            <div class="result-score-num" id="resultNum">0</div>
                            <div class="result-score-label">/ 100</div>
                        </div>
                    </div>
                    <div class="result-title" id="resultTitle">Selesai!</div>
                    <div class="result-sub" id="resultSub"></div>
                    <div class="result-stats">
                        <div class="result-stat">
                            <span class="result-stat-num" id="resBenar">0</span>
                            <div class="result-stat-label">✅ Benar</div>
                        </div>
                        <div class="result-stat">
                            <span class="result-stat-num" id="resSalah">0</span>
                            <div class="result-stat-label">❌ Salah</div>
                        </div>
                        <div class="result-stat">
                            <span class="result-stat-num" id="resWaktu">0'</span>
                            <div class="result-stat-label">⏱ Waktu</div>
                        </div>
                    </div>
                    <div class="result-btns">
                        <button class="btn-retry" onclick="retryQuiz()">🔄 Ulangi Kuis</button>
                        <button class="btn-mulai" onclick="closeQuiz()">✓ Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ═══════════════════════════════════════════════════════════
        // DATA KUIS — dari database via PHP, bukan hardcoded
        // ═══════════════════════════════════════════════════════════
        const quizData = {
            @foreach ($kuis as $k)
                @if ($k->soal->count() > 0)
                    {{ $k->id }}: {
                        title: '{{ addslashes($k->icon . ' ' . $k->judul) }}',
                        skorLulus: {{ $k->skor_lulus }},
                        questions: [
                            @foreach ($k->soal as $s)
                                {
                                    q: '{!! addslashes($s->pertanyaan) !!}',
                                    opts: [
                                        '{!! addslashes($s->opsi_a) !!}',
                                        '{!! addslashes($s->opsi_b) !!}',
                                        '{!! addslashes($s->opsi_c) !!}',
                                        '{!! addslashes($s->opsi_d) !!}'
                                    ],
                                    ans: {{ ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3][$s->jawaban_benar] }},
                                    fb: '{!! addslashes($s->pembahasan ?? '') !!}'
                                },
                            @endforeach
                        ]
                    },
                @endif
            @endforeach
        };

        // ═══════════════════════════════════════════════════════════
        // FILTER TABS
        // ═══════════════════════════════════════════════════════════
        document.querySelectorAll('.f-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.f-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const f = btn.dataset.filter;
                document.querySelectorAll('.quiz-card').forEach(c => {
                    c.style.display = (f === 'all' || c.dataset.cat === f) ? '' : 'none';
                });
            });
        });

        // ═══════════════════════════════════════════════════════════
        // QUIZ ENGINE
        // ═══════════════════════════════════════════════════════════
        let curQuiz = null,
            curQ = 0,
            answers = [],
            startTime = 0,
            timerInterval = null,
            currentId = '';

        function openQuiz(id) {
            const data = quizData[id];
            if (!data || !data.questions || data.questions.length === 0) {
                alert('Soal untuk kuis ini belum tersedia.');
                return;
            }
            curQuiz = data;
            curQ = 0;
            answers = new Array(data.questions.length).fill(null);
            currentId = id;
            startTime = Date.now();

            document.getElementById('modalTitle').textContent = data.title;
            document.getElementById('quizScreen').style.display = 'block';
            document.getElementById('resultScreen').classList.remove('show');
            document.getElementById('modalOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
            renderQ();
            startTimer();
        }

        function closeQuiz() {
            document.getElementById('modalOverlay').classList.remove('open');
            document.body.style.overflow = '';
            clearInterval(timerInterval);
        }

        function renderQ() {
            const q = curQuiz.questions[curQ];
            const total = curQuiz.questions.length;

            document.getElementById('progTxt').textContent = `Soal ${curQ+1} dari ${total}`;
            document.getElementById('quizProgFill').style.width = ((curQ + 1) / total * 100) + '%';
            document.getElementById('qNum').textContent = `SOAL ${String(curQ+1).padStart(2,'0')}`;
            document.getElementById('qText').textContent = q.q;

            const fb = document.getElementById('qFeedback');
            fb.className = 'q-feedback';
            fb.textContent = '';

            const optsEl = document.getElementById('qOpts');
            optsEl.innerHTML = '';
            ['A', 'B', 'C', 'D'].forEach((letter, i) => {
                const btn = document.createElement('button');
                btn.className = 'q-opt';
                btn.innerHTML = `<span class="q-opt-letter">${letter}</span>${q.opts[i]}`;
                if (answers[curQ] !== null) {
                    btn.classList.add('disabled');
                    if (i === q.ans) btn.classList.add('correct');
                    else if (i === answers[curQ]) btn.classList.add('wrong');
                }
                btn.addEventListener('click', () => selectAnswer(i));
                optsEl.appendChild(btn);
            });

            if (answers[curQ] !== null) showFeedback(q, answers[curQ]);

            const btnPrev = document.getElementById('btnPrev');
            btnPrev.style.opacity = curQ === 0 ? '0.3' : '1';
            btnPrev.disabled = curQ === 0;
            document.getElementById('btnNext').textContent =
                curQ === curQuiz.questions.length - 1 ? 'Lihat Hasil 🏆' : 'Selanjutnya →';
        }

        function selectAnswer(i) {
            if (answers[curQ] !== null) return;
            answers[curQ] = i;
            renderQ();
        }

        function showFeedback(q, ans) {
            const fb = document.getElementById('qFeedback');
            if (ans === q.ans) {
                fb.className = 'q-feedback correct-fb show';
                fb.textContent = '✅ Benar! ' + q.fb;
            } else {
                fb.className = 'q-feedback wrong-fb show';
                fb.textContent = '❌ Kurang tepat. ' + q.fb;
            }
        }

        function nextQ() {
            if (curQ < curQuiz.questions.length - 1) {
                curQ++;
                renderQ();
            } else showResult();
        }

        function prevQ() {
            if (curQ > 0) {
                curQ--;
                renderQ();
            }
        }

        function showResult() {
            clearInterval(timerInterval);
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const benar = answers.filter((a, i) => a === curQuiz.questions[i].ans).length;
            const salah = answers.filter((a, i) => a !== null && a !== curQuiz.questions[i].ans).length;
            const score = Math.round(benar / curQuiz.questions.length * 100);
            const skorLulus = curQuiz.skorLulus ?? 75; // ambil dari DB

            document.getElementById('quizScreen').style.display = 'none';
            document.getElementById('resultScreen').classList.add('show');
            document.getElementById('resultNum').textContent = score;
            document.getElementById('resBenar').textContent = benar;
            document.getElementById('resSalah').textContent = salah;
            document.getElementById('resWaktu').textContent =
                Math.floor(elapsed / 60) + "'" + String(elapsed % 60).padStart(2, '0') + '"';

            document.getElementById('resultTitle').textContent = score >= skorLulus ?
                '🎉 Lulus! Selamat!' : '📚 Perlu Belajar Lagi';
            document.getElementById('resultSub').textContent = score >= skorLulus ?
                `Nilai Anda ${score}/100. Anda telah menguasai materi ini dengan baik!` :
                `Nilai Anda ${score}/100. Pelajari kembali materi dan coba lagi untuk mencapai nilai ≥${skorLulus}.`;

            const r = document.getElementById('resultRingFill');
            const offset = 376.9 - (score / 100 * 376.9);
            setTimeout(() => {
                r.style.transition = 'stroke-dashoffset 1.5s cubic-bezier(.16,1,.3,1)';
                r.style.strokeDashoffset = offset;
            }, 100);

            let n = 0;
            const t = setInterval(() => {
                n += 2;
                document.getElementById('resultNum').textContent = Math.min(n, score);
                if (n >= score) clearInterval(t);
            }, 20);
        }

        function retryQuiz() {
            openQuiz(currentId);
        }

        function startTimer() {
            clearInterval(timerInterval);
            let sec = 0;
            timerInterval = setInterval(() => {
                sec++;
                const m = Math.floor(sec / 60),
                    s = sec % 60;
                document.getElementById('timerTxt').textContent =
                    `⏱ ${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            }, 1000);
        }

        // Tutup modal klik luar / ESC
        document.getElementById('modalOverlay').addEventListener('click', e => {
            if (e.target === document.getElementById('modalOverlay')) closeQuiz();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeQuiz();
        });
    </script>
@endpush
