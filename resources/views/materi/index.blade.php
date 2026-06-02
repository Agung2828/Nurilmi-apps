@extends('layouts.app')

@section('title', 'Materi Pembelajaran')

@push('styles')
    <style>
        .page-header {
            padding: 2rem 1.25rem 1.5rem;
            background: var(--navy);
            border-bottom: 1px solid var(--card-border);
        }

        .page-header-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-bottom: .8rem;
            flex-wrap: wrap;
        }

        .breadcrumb a,
        .breadcrumb span {
            font-size: .73rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color .2s;
        }

        .breadcrumb a:hover {
            color: var(--gold-l);
        }

        .breadcrumb .sep {
            opacity: .4;
        }

        .breadcrumb .cur {
            color: var(--gold-l);
            font-weight: 700;
        }

        .ph-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .ph-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: clamp(1.4rem, 4vw, 1.9rem);
            font-weight: 800;
            color: var(--white);
            margin-bottom: .2rem;
        }

        body.light .ph-title {
            color: #0B1628;
        }

        .ph-desc {
            font-size: .85rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        .search-wrap {
            position: relative;
            min-width: 220px;
            width: 100%;
            max-width: 280px;
        }

        .search-wrap input {
            width: 100%;
            padding: .55rem 1rem .55rem 2.2rem;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-main);
            font-size: .83rem;
            font-family: 'Nunito', sans-serif;
            outline: none;
            transition: border-color .25s;
        }

        .search-wrap input:focus {
            border-color: var(--emerald-l);
        }

        .search-wrap input::placeholder {
            color: var(--text-muted);
        }

        .search-icon {
            position: absolute;
            left: .7rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: .85rem;
            pointer-events: none;
        }

        /* FILTER BAR */
        .filter-bar {
            padding: .65rem 1.25rem;
            background: var(--navy-mid);
            border-bottom: 1px solid var(--card-border);
            position: sticky;
            top: var(--navbar-h);
            z-index: 50;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .filter-bar::-webkit-scrollbar {
            display: none;
        }

        body.light .filter-bar {
            background: var(--navy);
        }

        .filter-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: .4rem;
            align-items: center;
        }

        .ftab {
            padding: .38rem 1rem;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            background: transparent;
            color: var(--text-muted);
            font-size: .78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            font-family: 'Nunito', sans-serif;
            white-space: nowrap;
            text-decoration: none;
            display: inline-block;
        }

        .ftab:hover {
            border-color: var(--emerald-l);
            color: var(--text-main);
        }

        .ftab.act {
            background: var(--emerald);
            border-color: var(--emerald);
            color: #fff;
        }

        .ftab.act-z {
            background: var(--z-color);
            border-color: var(--z-color);
            color: #fff;
        }

        .ftab.act-m {
            background: var(--m-color);
            border-color: var(--m-color);
            color: #fff;
        }

        .ftab.act-h {
            background: var(--h-color);
            border-color: var(--h-color);
            color: #fff;
        }

        /* MAIN */
        .main-layout {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.8rem 1.25rem 5rem;
        }

        /* CHAPTER CARDS */
        .chapter-group {
            margin-bottom: 2.5rem;
        }

        .chapter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .chap-card {
            border-radius: 14px;
            overflow: hidden;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(12px);
            cursor: pointer;
            transition: transform .25s, box-shadow .25s, border-color .25s;
            text-decoration: none;
            display: block;
        }

        .chap-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, .2);
            border-color: rgba(201, 168, 76, .28);
        }

        .chap-banner {
            height: 120px;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: .9rem 1.1rem;
            overflow: hidden;
        }

        /* ── BANNER DENGAN FOTO BACKGROUND ── */
        .chap-banner-z {
            background: url('/assets/nabawi.png') center/cover no-repeat;
        }

        .chap-banner-m {
            background: url('/assets/makkah.png') center/cover no-repeat;
        }

        .chap-banner-h {
            background: url('/assets/alaqsa.jpg') center/cover no-repeat;
        }

        .chap-banner-icon {
            display: none;
        }

        .chap-banner-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.05rem;
            font-weight: 800;
            color: #fff;
            z-index: 2;
            position: relative;
            text-shadow: 0 2px 12px rgba(0, 0, 0, .9), 0 1px 4px rgba(0, 0, 0, .8);
        }

        .chap-banner-sub {
            font-size: .63rem;
            color: rgba(255, 255, 255, .98);
            display: block;
            margin-top: .05rem;
            text-shadow: 0 1px 6px rgba(0, 0, 0, .9);
        }

        .chap-body {
            padding: .9rem 1.1rem;
        }

        .chap-desc {
            font-size: .79rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: .8rem;
        }

        .chap-chips {
            display: flex;
            gap: .3rem;
            flex-wrap: wrap;
            margin-bottom: .7rem;
        }

        .chip {
            padding: .13rem .5rem;
            border-radius: 4px;
            font-size: .63rem;
            font-weight: 700;
        }

        .chip-z {
            background: var(--z-bg);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .2);
        }

        .chip-m {
            background: var(--m-bg);
            color: var(--m-light);
            border: 1px solid rgba(59, 111, 168, .2);
        }

        .chip-h {
            background: var(--h-bg);
            color: var(--gold-l);
            border: 1px solid rgba(201, 168, 76, .2);
        }

        .chap-footer {
            padding: .7rem 1.1rem;
            border-top: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chap-meta {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .chap-btn {
            padding: .35rem .9rem;
            border-radius: 8px;
            border: none;
            font-size: .75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }

        .chap-btn-z {
            background: var(--z-bg);
            color: var(--emerald-ll);
        }

        .chap-btn-m {
            background: var(--m-bg);
            color: var(--m-light);
        }

        .chap-btn-h {
            background: var(--h-bg);
            color: var(--gold-l);
        }

        /* DETAIL VIEW */
        #viewDetail {
            display: none;
        }

        .detail-header {
            display: flex;
            align-items: center;
            gap: .9rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .4rem .85rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            font-size: .78rem;
            font-weight: 700;
            font-family: 'Nunito', sans-serif;
            transition: all .25s;
        }

        .back-btn:hover {
            border-color: var(--emerald-l);
            color: var(--text-main);
        }

        .dh-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .dh-icon-z {
            background: linear-gradient(135deg, var(--z-color), #14A098);
        }

        .dh-icon-m {
            background: linear-gradient(135deg, var(--m-color), #5A8FCC);
        }

        .dh-icon-h {
            background: linear-gradient(135deg, var(--h-color), var(--gold));
        }

        .dh-name {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--white);
        }

        body.light .dh-name {
            color: #0B1628;
        }

        .dh-sub {
            font-size: .73rem;
            color: var(--text-muted);
        }

        .detail-layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 1.2rem;
            align-items: start;
        }

        .toc {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            backdrop-filter: blur(12px);
            position: sticky;
            top: calc(var(--navbar-h) + 56px);
            overflow: hidden;
        }

        .toc-head {
            padding: .8rem 1rem;
            border-bottom: 1px solid var(--card-border);
            font-size: .76rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .toc-list {
            list-style: none;
            padding: .4rem 0;
        }

        .toc-item a {
            display: flex;
            align-items: center;
            gap: .55rem;
            padding: .45rem .9rem;
            font-size: .75rem;
            color: var(--text-muted);
            text-decoration: none;
            cursor: pointer;
            transition: all .18s;
        }

        .toc-item a:hover,
        .toc-item a.active {
            color: var(--gold-l);
            background: rgba(201, 168, 76, .06);
        }

        .toc-num {
            width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .62rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .tn-z {
            background: var(--z-bg);
            color: var(--emerald-ll);
        }

        .tn-m {
            background: var(--m-bg);
            color: var(--m-light);
        }

        .tn-h {
            background: var(--h-bg);
            color: var(--gold-l);
        }

        .materi-list {
            display: flex;
            flex-direction: column;
            gap: .8rem;
        }

        .mi-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            transition: border-color .25s;
        }

        .mi-card.expanded {
            border-color: rgba(13, 115, 119, .35);
        }

        .mi-header {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .9rem 1.1rem;
            cursor: pointer;
            user-select: none;
            transition: background .2s;
        }

        .mi-header:hover {
            background: rgba(255, 255, 255, .018);
        }

        .mi-num {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
        }

        .mn-z {
            background: linear-gradient(135deg, var(--z-color), var(--emerald-l));
        }

        .mn-m {
            background: linear-gradient(135deg, var(--m-color), #5A8FCC);
        }

        .mn-h {
            background: linear-gradient(135deg, var(--h-color), var(--gold));
            color: #1A2A3A;
        }

        .mi-info {
            flex: 1;
            min-width: 0;
        }

        .mi-title {
            font-size: .88rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.3;
        }

        body.light .mi-title {
            color: #0B1628;
        }

        .mi-sub {
            font-size: .71rem;
            color: var(--text-muted);
            margin-top: .08rem;
        }

        .mi-badge {
            padding: .15rem .55rem;
            border-radius: 4px;
            font-size: .62rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .mb-z {
            background: var(--z-bg);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .2);
        }

        .mb-m {
            background: var(--m-bg);
            color: var(--m-light);
            border: 1px solid rgba(59, 111, 168, .2);
        }

        .mb-h {
            background: var(--h-bg);
            color: var(--gold-l);
            border: 1px solid rgba(201, 168, 76, .2);
        }

        .mi-chevron {
            font-size: .7rem;
            color: var(--text-muted);
            transition: transform .3s;
            flex-shrink: 0;
        }

        .mi-card.expanded .mi-chevron {
            transform: rotate(180deg);
        }

        .mi-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .4s cubic-bezier(.16, 1, .3, 1);
        }

        .mi-card.expanded .mi-body {
            max-height: 3000px;
        }

        .mi-content {
            padding: 0 1.1rem 1.1rem;
        }

        .mi-divider {
            height: 1px;
            background: var(--card-border);
            margin-bottom: 1rem;
        }

        .cb-section {
            margin-bottom: 1rem;
        }

        .cb-label {
            font-size: .65rem;
            font-weight: 800;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: var(--gold-l);
            margin-bottom: .45rem;
        }

        .cb-text {
            font-size: .83rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        body.light .cb-text {
            color: #3A4A5A;
        }

        .mi-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: .85rem;
            border-top: 1px solid var(--card-border);
            margin-top: .85rem;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .mi-tags {
            display: flex;
            gap: .3rem;
            flex-wrap: wrap;
        }

        .mi-tag {
            padding: .13rem .45rem;
            border-radius: 4px;
            font-size: .62rem;
            font-weight: 700;
            background: rgba(13, 115, 119, .08);
            color: var(--emerald-ll);
            border: 1px solid rgba(13, 115, 119, .12);
        }

        .mi-actions {
            display: flex;
            gap: .45rem;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: .32rem .75rem;
            border-radius: 7px;
            font-size: .71rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: .28rem;
            text-decoration: none;
        }

        .btn-video {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
        }

        .btn-video:hover {
            transform: translateY(-1px);
        }

        .btn-eval {
            background: linear-gradient(135deg, var(--gold), var(--gold-l));
            color: #1A2A3A;
        }

        .no-result {
            text-align: center;
            padding: 3rem 2rem;
        }

        .no-result .nr-icon {
            font-size: 2.5rem;
            margin-bottom: .6rem;
        }

        .no-result p {
            color: var(--text-muted);
            font-size: .88rem;
        }

        /* PDF VIEWER */
        .pdf-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .85);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .pdf-overlay.open {
            display: flex;
        }

        .pdf-viewer-wrap {
            background: var(--navy-mid);
            border-radius: 14px;
            border: 1px solid var(--card-border);
            width: 100%;
            max-width: 820px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .pdf-viewer-header {
            padding: .75rem 1rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
        }

        .pdf-viewer-title {
            font-size: .85rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pdf-close-btn {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1px solid var(--card-border);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all .2s;
        }

        .pdf-close-btn:hover {
            color: #f87171;
        }

        .pdf-frame {
            flex: 1;
            overflow: hidden;
        }

        .pdf-frame iframe {
            width: 100%;
            height: 100%;
            border: none;
            min-height: 70vh;
        }

        @media(max-width:900px) {
            .detail-layout {
                grid-template-columns: 1fr;
            }

            .toc {
                position: static;
            }

            .toc-list {
                display: flex;
                flex-wrap: wrap;
                padding: .35rem .5rem;
            }

            .toc-item a {
                border-radius: 6px;
                padding: .32rem .55rem;
            }
        }

        @media(max-width:768px) {
            .chapter-grid {
                grid-template-columns: 1fr;
            }

            .ph-content {
                flex-direction: column;
                gap: .8rem;
            }

            .search-wrap {
                max-width: 100%;
            }

            .mi-badge {
                display: none;
            }
        }

        @media(max-width:480px) {
            .main-layout {
                padding: 1.2rem .9rem 5rem;
            }

            .mi-header {
                padding: .8rem .9rem;
            }

            .mi-content {
                padding: 0 .9rem .9rem;
            }

            .page-header {
                padding: 1.5rem .9rem 1.2rem;
            }
        }
    </style>
@endpush

@section('content')

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="page-header-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">🏠 Beranda</a>
                <span class="sep">›</span>
                <span class="cur" id="breadcrumbCur">📚 Materi Pembelajaran</span>
            </div>
            <div class="ph-content">
                <div>
                    <h1 class="ph-title" id="pageTitle">Materi Pembelajaran</h1>
                    <p class="ph-desc" id="pageDesc">Pilih bab yang ingin kamu pelajari. Setiap bab berisi materi lengkap,
                        dalil, dan dokumen PDF.</p>
                </div>
                <div class="search-wrap" id="searchWrap">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari materi..." value="{{ request('search') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="filter-inner">
            <a href="{{ route('materi.index') }}"
                class="ftab {{ !request('topik') || request('topik') == 'all' ? 'act' : '' }}">📋 Semua</a>
            <a href="{{ route('materi.index', ['topik' => 'zakat']) }}"
                class="ftab {{ request('topik') == 'zakat' ? 'act-z' : '' }}">🤲 Zakat</a>
            <a href="{{ route('materi.index', ['topik' => 'mawaris']) }}"
                class="ftab {{ request('topik') == 'mawaris' ? 'act-m' : '' }}">⚖️ Mawaris</a>
            <a href="{{ route('materi.index', ['topik' => 'haji']) }}"
                class="ftab {{ request('topik') == 'haji' ? 'act-h' : '' }}">🕋 Haji</a>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-layout">

        <!-- LIST VIEW -->
        <div id="viewList">
            @php
                $topikConfig = [
                    'zakat' => [
                        'icon' => '🤲',
                        'label' => 'Bab 01 — Zakat',
                        'sub' => 'Fiqih Kontemporer',
                        'banner' => 'chap-banner-z',
                        'btn' => 'chap-btn-z',
                        'chips' => ['Zakat Fitrah', 'Zakat Maal', 'BAZNAS'],
                        'chip_class' => 'chip-z',
                    ],
                    'mawaris' => [
                        'icon' => '⚖️',
                        'label' => 'Bab 02 — Mawaris',
                        'sub' => 'Ilmu Faraid',
                        'banner' => 'chap-banner-m',
                        'btn' => 'chap-btn-m',
                        'chips' => ['Faraid', 'Ahli Waris', 'Perhitungan'],
                        'chip_class' => 'chip-m',
                    ],
                    'haji' => [
                        'icon' => '🕋',
                        'label' => 'Bab 03 — Haji',
                        'sub' => 'Ibadah Mahdhah',
                        'banner' => 'chap-banner-h',
                        'btn' => 'chap-btn-h',
                        'chips' => ['Manasik', 'Rukun Haji', 'Hikmah'],
                        'chip_class' => 'chip-h',
                    ],
                ];
            @endphp

            @if ($materis->isEmpty())
                <div class="no-result">
                    <div class="nr-icon">🔍</div>
                    <p>Tidak ada materi yang cocok.</p>
                </div>
            @else
                @foreach ($materis as $topik => $items)
                    @php $cfg = $topikConfig[$topik] ?? $topikConfig['zakat']; @endphp
                    <div class="chapter-group">
                        <div class="chapter-grid">
                            <div class="chap-card reveal" data-topic="{{ $topik }}"
                                onclick="openTopik('{{ $topik }}')">
                                <div class="chap-banner {{ $cfg['banner'] }}">
                                    <div class="chap-banner-icon">{{ $cfg['icon'] }}</div>
                                    <div>
                                        <div class="chap-banner-title">{{ $cfg['label'] }}</div>
                                        <span class="chap-banner-sub">{{ $cfg['sub'] }} · {{ $items->count() }}
                                            Sub-Topik</span>
                                    </div>
                                </div>
                                <div class="chap-body">
                                    <p class="chap-desc">
                                        {{ $items->first()->sub_judul ?? 'Materi lengkap tentang ' . $topik }}</p>
                                    <div class="chap-chips">
                                        @foreach ($cfg['chips'] as $chip)
                                            <span class="chip {{ $cfg['chip_class'] }}">{{ $chip }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="chap-footer">
                                    <span class="chap-meta">📖 {{ $items->count() }} materi</span>
                                    <button class="chap-btn {{ $cfg['btn'] }}">Buka →</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- DETAIL VIEW -->
        <div id="viewDetail">
            <div class="detail-header">
                <button class="back-btn" onclick="closeTopik()">← Kembali</button>
                <div style="display:flex;align-items:center;gap:.75rem;">
                    <div class="dh-icon" id="detailIcon"></div>
                    <div>
                        <div class="dh-name" id="detailName"></div>
                        <div class="dh-sub" id="detailSub"></div>
                    </div>
                </div>
            </div>

            <div class="detail-layout">
                <!-- TOC -->
                <div class="toc">
                    <div class="toc-head">📋 Daftar Materi</div>
                    <ul class="toc-list" id="tocList"></ul>
                </div>
                <!-- Materi List -->
                <div>
                    <div class="materi-list" id="materiList"></div>
                    <div class="pdf-section" id="pdfSection" style="display:none;">
                        <div class="pdf-section-title">📄 Dokumen PDF Materi</div>
                        <div class="pdf-list" id="pdfList"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- PDF VIEWER -->
    <div class="pdf-overlay" id="pdfOverlay">
        <div class="pdf-viewer-wrap">
            <div class="pdf-viewer-header">
                <div class="pdf-viewer-title" id="pdfViewerTitle">Dokumen PDF</div>
                <button class="pdf-close-btn" onclick="closePdfViewer()">✕</button>
            </div>
            <div class="pdf-frame">
                <iframe id="pdfFrame" src=""></iframe>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const MATERI_DATA = @json($materis);

        const TOPIK_CONFIG = {
            zakat: {
                icon: '🤲',
                iconClass: 'dh-icon-z',
                topic: 'z',
                name: 'Bab Zakat',
                sub: 'Fiqih Kontemporer'
            },
            mawaris: {
                icon: '⚖️',
                iconClass: 'dh-icon-m',
                topic: 'm',
                name: 'Bab Mawaris',
                sub: 'Ilmu Faraid'
            },
            haji: {
                icon: '🕋',
                iconClass: 'dh-icon-h',
                topic: 'h',
                name: 'Bab Haji',
                sub: 'Ibadah Mahdhah'
            },
        };

        let currentTopik = null;

        function openTopik(topik) {
            currentTopik = topik;
            const cfg = TOPIK_CONFIG[topik];
            const items = MATERI_DATA[topik] || [];

            document.getElementById('pageTitle').textContent = cfg.name;
            document.getElementById('pageDesc').textContent = cfg.sub;
            document.getElementById('breadcrumbCur').textContent = '📚 ' + cfg.name;
            document.getElementById('searchWrap').style.display = 'none';

            const iconEl = document.getElementById('detailIcon');
            iconEl.textContent = cfg.icon;
            iconEl.className = 'dh-icon ' + cfg.iconClass;
            document.getElementById('detailName').textContent = cfg.name;
            document.getElementById('detailSub').textContent = cfg.sub;

            // TOC
            const tocList = document.getElementById('tocList');
            tocList.innerHTML = '';
            items.forEach((m, i) => {
                const li = document.createElement('li');
                li.className = 'toc-item';
                li.innerHTML =
                    `<a onclick="scrollToMateri(${m.id})"><span class="toc-num tn-${cfg.topic}">${String(i+1).padStart(2,'0')}</span>${m.judul}</a>`;
                tocList.appendChild(li);
            });

            // Materi list
            const ml = document.getElementById('materiList');
            ml.innerHTML = '';
            items.forEach((m, i) => {
                const div = document.createElement('div');
                div.className = 'mi-card';
                div.id = 'mi-' + m.id;

                const pdfBtn = m.pdf ?
                    `<a href="/storage/${m.pdf}" target="_blank" class="btn-sm btn-eval">📄 Lihat PDF</a>` : '';
                const videoBtn =
                    `<a href="{{ route('video.index') }}?topik=${topik}" class="btn-sm btn-video">🎬 Tonton Video</a>`;

                div.innerHTML = `
            <div class="mi-header" onclick="toggleMi(${m.id})">
                <div class="mi-num mn-${cfg.topic}">${String(i+1).padStart(2,'0')}</div>
                <div class="mi-info">
                    <div class="mi-title">${m.judul}</div>
                    <div class="mi-sub">${m.sub_judul || ''}</div>
                </div>
                <span class="mi-badge mb-${cfg.topic}">${m.badge || ''}</span>
                <span class="mi-chevron">▼</span>
            </div>
            <div class="mi-body">
                <div class="mi-content">
                    <div class="mi-divider"></div>
                    <div class="cb-text">${m.konten}</div>
                    <div class="mi-footer">
                        <div class="mi-tags"></div>
                        <div class="mi-actions">${videoBtn}${pdfBtn}</div>
                    </div>
                </div>
            </div>`;
                ml.appendChild(div);
            });

            document.getElementById('viewList').style.display = 'none';
            document.getElementById('viewDetail').style.display = 'block';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function closeTopik() {
            currentTopik = null;
            document.getElementById('pageTitle').textContent = 'Materi Pembelajaran';
            document.getElementById('pageDesc').textContent = 'Pilih bab yang ingin kamu pelajari.';
            document.getElementById('searchWrap').style.display = '';
            document.getElementById('breadcrumbCur').textContent = '📚 Materi Pembelajaran';
            document.getElementById('viewDetail').style.display = 'none';
            document.getElementById('viewList').style.display = 'block';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function toggleMi(id) {
            const card = document.getElementById('mi-' + id);
            const isOpen = card.classList.contains('expanded');
            document.querySelectorAll('.mi-card.expanded').forEach(c => {
                if (c !== card) c.classList.remove('expanded');
            });
            card.classList.toggle('expanded', !isOpen);
            if (!isOpen) {
                document.querySelectorAll('.toc-item a').forEach(a => a.classList.remove('active'));
                const link = document.querySelector(`.toc-item a[onclick="scrollToMateri(${id})"]`);
                if (link) link.classList.add('active');
            }
        }

        function scrollToMateri(id) {
            toggleMi(id);
            setTimeout(() => {
                const el = document.getElementById('mi-' + id);
                if (el) el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 80);
        }

        function closePdfViewer() {
            document.getElementById('pdfOverlay').classList.remove('open');
            document.getElementById('pdfFrame').src = '';
        }

        document.getElementById('pdfOverlay').addEventListener('click', e => {
            if (e.target === document.getElementById('pdfOverlay')) closePdfViewer();
        });

        @if (request('topik') && request('topik') !== 'all')
            window.addEventListener('load', () => openTopik('{{ request('topik') }}'));
        @endif
    </script>
@endpush
