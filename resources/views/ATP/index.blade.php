@extends('layouts.app')
@section('title', 'ATP — Alur Tujuan Pembelajaran')

@push('styles')
    <style>
        :root {
            --navbar-h: 64px;
        }

        .page-hero {
            padding: calc(var(--navbar-h) + 3.5rem) 2rem 4rem;
            background: radial-gradient(ellipse 70% 50% at 30% 50%, rgba(13, 115, 119, .15) 0%, transparent 60%), radial-gradient(ellipse 40% 40% at 80% 20%, rgba(201, 168, 76, .07) 0%, transparent 50%), var(--navy);
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

        .cp-section {
            background: var(--navy);
        }

        body.light .cp-section {
            background: #F0F4FF;
        }

        .cp-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 2.5rem;
            backdrop-filter: blur(12px);
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all .35s;
        }

        .cp-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--emerald), var(--gold));
        }

        .cp-card.topik-mawaris::before {
            background: linear-gradient(180deg, #1A3A5C, #5B8DC0);
        }

        .cp-card.topik-haji::before {
            background: linear-gradient(180deg, var(--gold), var(--gold-l));
        }

        .cp-card:hover {
            border-color: var(--emerald-l);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .2);
        }

        .cp-head {
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .cp-badge {
            padding: .35rem .9rem;
            border-radius: 6px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #fff;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .cp-badge-zakat {
            background: linear-gradient(135deg, #0D7377, #14A098);
        }

        .cp-badge-mawaris {
            background: linear-gradient(135deg, #1A3A5C, #2A5A8C);
        }

        .cp-badge-haji {
            background: linear-gradient(135deg, #C9A84C, #E8C97A);
            color: #1A2A3A;
        }

        .cp-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.3;
        }

        body.light .cp-title {
            color: #1A2A3A;
        }

        .cp-text {
            font-size: .9rem;
            color: var(--text-muted);
            line-height: 1.85;
        }

        .tp-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
            margin-top: 2rem;
        }

        .tp-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.6rem;
            backdrop-filter: blur(10px);
            transition: all .35s;
            position: relative;
            overflow: hidden;
        }

        .tp-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
            box-shadow: 0 14px 36px rgba(0, 0, 0, .2);
        }

        .tp-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: rgba(201, 168, 76, .12);
            position: absolute;
            top: .5rem;
            right: 1rem;
            line-height: 1;
        }

        .tp-head {
            display: flex;
            align-items: center;
            gap: .7rem;
            margin-bottom: .8rem;
        }

        .tp-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .tp-dot-zakat {
            background: var(--emerald-l);
        }

        .tp-dot-mawaris {
            background: #5B8DC0;
        }

        .tp-dot-haji {
            background: var(--gold-l);
        }

        .tp-label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .tp-label-zakat {
            color: var(--emerald-ll);
        }

        .tp-label-mawaris {
            color: #7EB8E8;
        }

        .tp-label-haji {
            color: var(--gold-l);
        }

        .tp-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .5rem;
        }

        body.light .tp-title {
            color: #1A2A3A;
        }

        .tp-text {
            font-size: .83rem;
            color: var(--text-muted);
            line-height: 1.75;
        }

        .tp-tags {
            display: flex;
            flex-wrap: wrap;
            gap: .35rem;
            margin-top: .8rem;
        }

        .tp-tag {
            padding: .18rem .6rem;
            border-radius: 4px;
            font-size: .68rem;
            font-weight: 600;
            background: rgba(13, 115, 119, .12);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .18);
        }

        .alur-section {
            background: var(--navy-mid);
        }

        body.light .alur-section {
            background: var(--navy-light);
        }

        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 28px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--emerald), var(--gold), transparent);
            z-index: 0;
        }

        .tl-item {
            display: flex;
            gap: 1.8rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .tl-dot {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 2px solid var(--card-border);
            box-shadow: 0 0 0 4px rgba(11, 22, 40, .8);
            position: relative;
            z-index: 2;
        }

        .tl-dot-zakat {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
        }

        .tl-dot-mawaris {
            background: linear-gradient(135deg, #1A3A5C, var(--navy-light));
        }

        .tl-dot-haji {
            background: linear-gradient(135deg, var(--gold), var(--gold-l));
        }

        .tl-content {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.6rem 1.8rem;
            flex: 1;
            backdrop-filter: blur(10px);
            transition: all .35s;
        }

        .tl-content:hover {
            border-color: var(--emerald-l);
            transform: translateX(6px);
        }

        .tl-week {
            font-size: .7rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .6px;
            text-transform: uppercase;
            margin-bottom: .4rem;
        }

        .tl-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .5rem;
        }

        body.light .tl-title {
            color: #1A2A3A;
        }

        .tl-text {
            font-size: .85rem;
            color: var(--text-muted);
            line-height: 1.75;
            margin-bottom: .8rem;
        }

        .tl-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .35rem;
        }

        .tl-chip {
            padding: .2rem .65rem;
            border-radius: 20px;
            font-size: .68rem;
            font-weight: 600;
            border: 1px solid rgba(201, 168, 76, .2);
            color: var(--gold-l);
            background: rgba(201, 168, 76, .07);
        }

        .topik-section {
            background: var(--navy);
        }

        body.light .topik-section {
            background: #F0F4FF;
        }

        .topik-tabs {
            display: flex;
            gap: .5rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .topik-tab {
            padding: .55rem 1.4rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s;
            font-family: 'Nunito', sans-serif;
        }

        .topik-tab:hover,
        .topik-tab.active {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            border-color: transparent;
            color: #fff;
        }

        .topik-content {
            display: none;
        }

        .topik-content.active {
            display: block;
        }

        .topik-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.2rem;
        }

        .topik-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.6rem;
            backdrop-filter: blur(10px);
            transition: all .35s;
        }

        .topik-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
            box-shadow: 0 14px 36px rgba(0, 0, 0, .2);
        }

        .tk-order {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
        }

        .tk-order-zakat {
            background: linear-gradient(135deg, #0D7377, #14A098);
        }

        .tk-order-mawaris {
            background: linear-gradient(135deg, #1A3A5C, #2A5A8C);
        }

        .tk-order-haji {
            background: linear-gradient(135deg, #C9A84C, #E8C97A);
            color: #1A2A3A;
        }

        .tk-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .4rem;
        }

        body.light .tk-title {
            color: #1A2A3A;
        }

        .tk-text {
            font-size: .82rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .tk-badge {
            display: inline-block;
            margin-top: .8rem;
            padding: .2rem .65rem;
            border-radius: 4px;
            font-size: .68rem;
            font-weight: 600;
            background: rgba(201, 168, 76, .1);
            color: var(--gold-l);
            border: 1px solid rgba(201, 168, 76, .18);
        }

        .empty-section {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-section .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media(max-width:1100px) {
            .info-strip-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .tp-grid {
                grid-template-columns: 1fr;
            }

            .topik-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:768px) {
            .page-title {
                font-size: 2rem;
            }

            .info-strip-inner {
                grid-template-columns: 1fr 1fr;
            }

            .topik-grid {
                grid-template-columns: 1fr;
            }

            .timeline::before {
                left: 22px;
            }

            .tl-dot {
                width: 46px;
                height: 46px;
                font-size: 1.1rem;
            }
        }

        @media(max-width:480px) {
            .page-title {
                font-size: 1.7rem;
            }

            .info-strip-inner {
                grid-template-columns: 1fr;
            }

            .tl-item {
                gap: 1rem;
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
                <span class="current">📋 ATP</span>
            </div>
            <div class="page-title-wrap">
                <div class="page-icon-big">📋</div>
                <div>
                    <div class="page-eyebrow">✦ Kurikulum Merdeka</div>
                    <h1 class="page-title">Alur Tujuan <span class="em">Pembelajaran</span></h1>
                    <p class="page-desc">Capaian Pembelajaran (CP), Tujuan Pembelajaran (TP), dan alur pembelajaran
                        terstruktur mata pelajaran Pendidikan Agama Islam — Zakat, Mawaris, dan Haji sesuai Kurikulum
                        Merdeka.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO STRIP -->
    <div class="info-strip">
        <div class="info-strip-inner">
            <div class="info-strip-card">
                <div class="isc-icon">🎓</div>
                <div><span class="isc-label">Jenjang</span>
                    <div class="isc-val">SMA/MA Kelas XI</div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">📘</div>
                <div><span class="isc-label">Mata Pelajaran</span>
                    <div class="isc-val">Pendidikan Agama Islam</div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">📅</div>
                <div><span class="isc-label">Alokasi Waktu</span>
                    <div class="isc-val">18 Pertemuan × 2 JP</div>
                </div>
            </div>
            <div class="info-strip-card">
                <div class="isc-icon">🏫</div>
                <div><span class="isc-label">Kurikulum</span>
                    <div class="isc-val">Merdeka Belajar 2024</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CP & TP SECTION -->
    @if ($cp->count() || $tp->count())
        <section class="cp-section">
            <div class="container">

                {{-- CP --}}
                @if ($cp->count())
                    <div class="section-header">
                        <div class="s-badge">✦ Capaian Pembelajaran</div>
                        <h2 class="s-title">Capaian <span class="em">Pembelajaran (CP)</span></h2>
                        <p class="s-sub">Kompetensi yang diharapkan dicapai peserta didik setelah mempelajari ketiga topik
                            utama fiqih Islam.</p>
                    </div>
                    @foreach ($cp as $item)
                        <div class="cp-card topik-{{ $item->topik }}">
                            <div class="cp-head">
                                <div class="cp-badge cp-badge-{{ $item->topik }}">
                                    {{ $item->sub_judul ?? 'CP — ' . ucfirst($item->topik) }}
                                </div>
                                <div class="cp-title">{{ $item->judul }}</div>
                            </div>
                            <p class="cp-text">{{ $item->isi }}</p>
                        </div>
                    @endforeach
                @endif

                {{-- TP --}}
                @if ($tp->count())
                    <div class="section-header" style="margin-top:4rem;">
                        <div class="s-badge">✦ Tujuan Pembelajaran</div>
                        <h2 class="s-title">Tujuan <span class="em">Pembelajaran (TP)</span></h2>
                        <p class="s-sub">Penjabaran capaian pembelajaran menjadi tujuan-tujuan spesifik yang terukur dan
                            dapat diamati.</p>
                    </div>
                    <div class="tp-grid">
                        @foreach ($tp as $i => $item)
                            <div class="tp-card">
                                <div class="tp-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="tp-head">
                                    <div class="tp-dot tp-dot-{{ $item->topik }}"></div>
                                    <span class="tp-label tp-label-{{ $item->topik }}">
                                        {{ $item->sub_judul ?? 'TP ' . $loop->iteration . ' — ' . ucfirst($item->topik) }}
                                    </span>
                                </div>
                                <div class="tp-title">{{ $item->judul }}</div>
                                <p class="tp-text">{{ $item->isi }}</p>
                                @if ($item->tags_array)
                                    <div class="tp-tags">
                                        @foreach ($item->tags_array as $tag)
                                            <span class="tp-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>
    @endif

    <!-- TIMELINE -->
    @if ($timeline->count())
        <section class="alur-section">
            <div class="container">
                <div class="section-header">
                    <div class="s-badge">✦ Alur Pembelajaran</div>
                    <h2 class="s-title">Alur & Jadwal <span class="em">Pembelajaran</span></h2>
                    <p class="s-sub">Urutan pembelajaran yang logis dan terstruktur selama satu semester untuk ketiga topik
                        utama.</p>
                </div>
                <div class="timeline">
                    @foreach ($timeline as $item)
                        <div class="tl-item">
                            <div class="tl-dot tl-dot-{{ $item->topik }}">
                                @php
                                    $tlIcon = match ($item->topik) {
                                        'zakat' => '🤲',
                                        'mawaris' => '⚖️',
                                        'haji' => '🕋',
                                        default => '📌',
                                    };
                                @endphp
                                {{ $tlIcon }}
                            </div>
                            <div class="tl-content">
                                @if ($item->minggu)
                                    <div class="tl-week">{{ $item->minggu }}</div>
                                @endif
                                <div class="tl-title">{{ $item->judul }}</div>
                                <p class="tl-text">{{ $item->isi }}</p>
                                @if ($item->chips_array)
                                    <div class="tl-chips">
                                        @foreach ($item->chips_array as $chip)
                                            <span class="tl-chip">{{ $chip }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- TOPIK DETAIL -->
    @if ($topikZakat->count() || $topikMawaris->count() || $topikHaji->count())
        <section class="topik-section">
            <div class="container">
                <div class="section-header">
                    <div class="s-badge">✦ Rincian Topik</div>
                    <h2 class="s-title">Sub-Topik per <span class="em">Materi</span></h2>
                </div>
                <div class="topik-tabs">
                    @if ($topikZakat->count())
                        <button class="topik-tab active" data-tab="zakat">🤲 Zakat</button>
                    @endif
                    @if ($topikMawaris->count())
                        <button class="topik-tab {{ !$topikZakat->count() ? 'active' : '' }}" data-tab="mawaris">⚖️
                            Mawaris</button>
                    @endif
                    @if ($topikHaji->count())
                        <button class="topik-tab {{ !$topikZakat->count() && !$topikMawaris->count() ? 'active' : '' }}"
                            data-tab="haji">🕋 Haji</button>
                    @endif
                </div>

                @foreach ([['zakat', $topikZakat], ['mawaris', $topikMawaris], ['haji', $topikHaji]] as [$nama, $items])
                    @if ($items->count())
                        <div class="topik-content {{ $nama === 'zakat' && $topikZakat->count() ? 'active' : ($nama === 'mawaris' && !$topikZakat->count() ? 'active' : ($nama === 'haji' && !$topikZakat->count() && !$topikMawaris->count() ? 'active' : '')) }}"
                            id="tab-{{ $nama }}">
                            <div class="topik-grid">
                                @foreach ($items as $item)
                                    <div class="topik-card">
                                        <div class="tk-order tk-order-{{ $item->topik }}">
                                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="tk-title">{{ $item->judul }}</div>
                                        <p class="tk-text">{{ $item->isi }}</p>
                                        @if ($item->sub_judul)
                                            <span class="tk-badge">{{ $item->sub_judul }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    {{-- Tampil kalau semua kosong --}}
    @if (
        !$cp->count() &&
            !$tp->count() &&
            !$timeline->count() &&
            !$topikZakat->count() &&
            !$topikMawaris->count() &&
            !$topikHaji->count())
        <section>
            <div class="container">
                <div class="empty-section">
                    <div class="empty-icon">📭</div>
                    <p>Konten ATP belum tersedia. Admin belum menambahkan data.</p>
                </div>
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.topik-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.topik-tab').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.topik-content').forEach(c => c.classList.remove('active'));
                btn.classList.add('active');
                const tab = document.getElementById('tab-' + btn.dataset.tab);
                if (tab) tab.classList.add('active');
            });
        });
    </script>
@endpush
