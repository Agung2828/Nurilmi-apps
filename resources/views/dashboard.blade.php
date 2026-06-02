@extends('layouts.app')

@section('title', 'Video Pembelajaran')

@push('styles')
    <style>
        :root {
            --navbar-h: 64px;
        }

        .page-hero {
            padding: calc(var(--navbar-h) + 3.5rem) 2rem 4rem;
            background: radial-gradient(ellipse 70% 50% at 70% 50%, rgba(13, 115, 119, .15) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 20% 20%, rgba(201, 168, 76, .07) 0%, transparent 50%),
                var(--navy);
            position: relative;
            overflow: hidden;
        }

        body.light .page-hero {
            background: radial-gradient(ellipse 70% 50% at 70% 50%, rgba(13, 115, 119, .1) 0%, transparent 60%), var(--navy);
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

        .filter-section {
            background: var(--navy);
            padding: 2.5rem 2rem 0;
        }

        body.light .filter-section {
            background: #F0F4FF;
        }

        .filter-inner {
            max-width: 1320px;
            margin: 0 auto;
        }

        .filter-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }

        .search-wrap2 {
            flex: 1;
            min-width: 220px;
            position: relative;
        }

        .search-wrap2 input {
            width: 100%;
            padding: .75rem 1.2rem .75rem 3rem;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-main);
            font-size: .9rem;
            font-family: 'Poppins', sans-serif;
            backdrop-filter: blur(10px);
            outline: none;
            transition: all .3s;
        }

        .search-wrap2 input:focus {
            border-color: var(--emerald-l);
        }

        .search-wrap2 input::placeholder {
            color: var(--text-muted);
        }

        .search-icon2 {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            pointer-events: none;
        }

        .filter-tabs {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: .55rem 1.4rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: var(--glass);
            color: var(--text-muted);
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            text-decoration: none;
        }

        .filter-tab:hover {
            border-color: var(--emerald-l);
            color: var(--text-main);
        }

        .filter-tab.active {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            border-color: transparent;
            color: #fff;
        }

        .sort-wrap select {
            padding: .65rem 1.1rem;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-main);
            font-size: .85rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            cursor: pointer;
        }

        .video-section {
            background: var(--navy);
            padding: 0 2rem 5rem;
        }

        body.light .video-section {
            background: #F0F4FF;
        }

        .video-grid {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.6rem;
        }

        .video-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            display: flex;
            flex-direction: column;
        }

        .video-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, .35);
            border-color: var(--emerald-l);
        }

        .video-card[data-category="mawaris"]:hover {
            border-color: var(--navy-light);
        }

        .video-card[data-category="haji"]:hover {
            border-color: var(--gold);
        }

        /* Thumbnail YouTube */
        .video-thumb {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #0a1020;
            cursor: pointer;
        }

        .video-thumb-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .video-card:hover .video-thumb-img {
            transform: scale(1.05);
        }

        /* Thumbnail File — placeholder gelap dengan ikon play */
        .video-thumb-file {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
            cursor: pointer;
            background: linear-gradient(135deg, #0b1628, #1A3A5C);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vtf-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(11, 22, 40, .6), rgba(13, 115, 119, .25));
        }

        .vtf-icon {
            font-size: 3rem;
            position: relative;
            z-index: 2;
        }

        .vtf-label {
            position: absolute;
            bottom: .6rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: .65rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .7);
            background: rgba(0, 0, 0, .5);
            padding: .2rem .6rem;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 3;
        }

        .play-btn {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
            opacity: 0;
            transition: opacity .3s;
            background: rgba(0, 0, 0, .3);
        }

        .video-thumb:hover .play-btn,
        .video-thumb-file:hover .play-btn {
            opacity: 1;
        }

        .play-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(201, 168, 76, .9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .video-duration {
            position: absolute;
            bottom: .6rem;
            right: .7rem;
            background: rgba(0, 0, 0, .75);
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: .18rem .5rem;
            border-radius: 4px;
            z-index: 4;
        }

        .video-cat-badge {
            position: absolute;
            top: .7rem;
            left: .7rem;
            z-index: 4;
            padding: .25rem .7rem;
            border-radius: 5px;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .badge-zakat {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
        }

        .badge-mawaris {
            background: linear-gradient(135deg, #1A3A5C, var(--navy-light));
            color: #fff;
        }

        .badge-haji {
            background: linear-gradient(135deg, var(--gold), var(--gold-l));
            color: #1A2A3A;
        }

        .video-body {
            padding: 1.4rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .video-meta {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: .7rem;
            flex-wrap: wrap;
        }

        .video-series {
            font-size: .68rem;
            font-weight: 700;
            color: var(--gold-l);
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* Badge tipe video (YouTube/File) */
        .video-type-badge {
            font-size: .62rem;
            font-weight: 600;
            padding: .15rem .5rem;
            border-radius: 4px;
            background: rgba(255, 255, 255, .08);
            color: var(--text-muted);
            border: 1px solid var(--card-border);
        }

        .video-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.35;
            margin-bottom: .6rem;
            flex: 1;
        }

        body.light .video-title {
            color: #1A2A3A;
        }

        .video-desc {
            font-size: .82rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .video-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: .8rem;
            border-top: 1px solid var(--card-border);
            margin-top: auto;
        }

        .video-instructor {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .vi-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--emerald), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
        }

        .vi-name {
            font-size: .75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .btn-watch {
            padding: .38rem .95rem;
            border-radius: 7px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .75rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            text-decoration: none;
        }

        .btn-watch:hover {
            transform: translateY(-2px);
        }

        .btn-watch-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-l));
            color: #1A2A3A;
        }

        .no-result {
            grid-column: 1/-1;
            text-align: center;
            padding: 4rem 2rem;
        }

        .no-result-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .no-result-text {
            font-size: 1rem;
            color: var(--text-muted);
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 10, 20, .85);
            backdrop-filter: blur(10px);
            z-index: 9500;
            display: flex;
            align-items: center;
            justify-content: center;
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
            border-radius: 20px;
            width: 90%;
            max-width: 820px;
            overflow: hidden;
            transform: scale(.93) translateY(20px);
            transition: transform .4s cubic-bezier(.16, 1, .3, 1);
            position: relative;
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-video {
            aspect-ratio: 16/9;
            width: 100%;
            background: #000;
        }

        .modal-video iframe,
        .modal-video video {
            width: 100%;
            height: 100%;
            border: none;
        }

        .modal-info {
            padding: 1.5rem 1.8rem;
        }

        .modal-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .4rem;
        }

        body.light .modal-title {
            color: #1A2A3A;
        }

        .modal-meta {
            font-size: .82rem;
            color: var(--text-muted);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(0, 0, 0, .5);
            border: 1px solid var(--card-border);
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s;
        }

        .modal-close:hover {
            background: rgba(201, 168, 76, .2);
        }

        .playlist-section {
            background: var(--navy);
            padding: 4rem 2rem;
        }

        body.light .playlist-section {
            background: #F0F4FF;
        }

        .playlist-inner {
            max-width: 1320px;
            margin: 0 auto;
        }

        .section-header {
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
        }

        .playlist-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.2rem;
        }

        .playlist-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            transition: all .35s;
            display: flex;
            gap: 1.2rem;
            align-items: flex-start;
            cursor: pointer;
        }

        .playlist-card:hover {
            border-color: var(--emerald-l);
            transform: translateY(-4px);
        }

        .pl-number {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: rgba(201, 168, 76, .15);
            line-height: 1;
            flex-shrink: 0;
            width: 40px;
        }

        .pl-cat {
            font-size: .68rem;
            font-weight: 700;
            color: var(--emerald-ll);
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-bottom: .3rem;
        }

        .pl-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .4rem;
        }

        body.light .pl-title {
            color: #1A2A3A;
        }

        .pl-count {
            font-size: .78rem;
            color: var(--text-muted);
        }

        .pl-count span {
            color: var(--gold-l);
            font-weight: 600;
        }

        @media(max-width:1100px) {
            .info-strip-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .video-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .playlist-grid {
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

            .video-grid {
                grid-template-columns: 1fr;
            }

            .playlist-grid {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }

        @media(max-width:480px) {
            .page-title {
                font-size: 1.7rem;
            }

            .info-strip-inner {
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
                <span class="current">🎬 Video Pembelajaran</span>
            </div>
            <div class="page-title-wrap">
                <div class="page-icon-big">🎬</div>
                <div>
                    <div class="page-eyebrow">✦ Media Pembelajaran Interaktif</div>
                    <h1 class="page-title">Video <span class="em">Pembelajaran</span></h1>
                    <p class="page-desc">Koleksi video edukatif untuk memahami Zakat, Mawaris, dan Haji secara mendalam.
                        Dikurasi khusus untuk peserta didik SMA/MA dan guru PAI.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO STRIP -->
    <div class="info-strip">
        <div class="info-strip-inner">
            <div class="info-strip-card reveal">
                <div class="isc-icon">🎬</div>
                <div><span class="isc-label">Total Video</span>
                    <div class="isc-val">{{ $stats['total'] }} Video</div>
                </div>
            </div>
            <div class="info-strip-card reveal reveal-d1">
                <div class="isc-icon">🤲</div>
                <div><span class="isc-label">Topik Zakat</span>
                    <div class="isc-val">{{ $stats['zakat'] }} Video</div>
                </div>
            </div>
            <div class="info-strip-card reveal reveal-d2">
                <div class="isc-icon">⚖️</div>
                <div><span class="isc-label">Topik Mawaris</span>
                    <div class="isc-val">{{ $stats['mawaris'] }} Video</div>
                </div>
            </div>
            <div class="info-strip-card reveal reveal-d3">
                <div class="isc-icon">🕋</div>
                <div><span class="isc-label">Topik Haji</span>
                    <div class="isc-val">{{ $stats['haji'] }} Video</div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="filter-section">
        <div class="filter-inner">
            <div class="filter-bar reveal">
                <div class="search-wrap2">
                    <span class="search-icon2">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari video pembelajaran..." oninput="filterVideos()"
                        value="{{ request('search') }}">
                </div>
                <div class="filter-tabs">
                    <a href="{{ route('video.index') }}"
                        class="filter-tab {{ !request('topik') || request('topik') == 'all' ? 'active' : '' }}">📋 Semua</a>
                    <a href="{{ route('video.index', ['topik' => 'zakat']) }}"
                        class="filter-tab {{ request('topik') == 'zakat' ? 'active' : '' }}">🤲 Zakat</a>
                    <a href="{{ route('video.index', ['topik' => 'mawaris']) }}"
                        class="filter-tab {{ request('topik') == 'mawaris' ? 'active' : '' }}">⚖️ Mawaris</a>
                    <a href="{{ route('video.index', ['topik' => 'haji']) }}"
                        class="filter-tab {{ request('topik') == 'haji' ? 'active' : '' }}">🕋 Haji</a>
                </div>
                <div class="sort-wrap">
                    <select id="sortSelect" onchange="filterVideos()">
                        <option value="default">Urutan Default</option>
                        <option value="az">A – Z</option>
                        <option value="za">Z – A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- VIDEO GRID -->
    <section class="video-section">
        <div class="video-grid" id="videoGrid">

            @forelse($videos as $video)
                @php
                    $badgeClass = 'badge-' . $video->topik;
                    $isHaji = $video->topik === 'haji';
                    $isMawaris = $video->topik === 'mawaris';
                    $topikEmoji = ['zakat' => '🤲', 'mawaris' => '⚖️', 'haji' => '🕋'][$video->topik] ?? '📚';
                    $isFile = $video->video_type === 'file';
                    $modalTitle = addslashes($video->judul);
                    $modalDesc = addslashes($video->deskripsi ?? '');
                    $fileUrl = $isFile ? asset('storage/' . $video->video_path) : '';
                @endphp

                <div class="video-card reveal" data-category="{{ $video->topik }}" data-title="{{ $video->judul }}">

                    {{-- ── THUMBNAIL ── --}}
                    @if ($isFile)
                        {{-- File lokal: placeholder dengan ikon --}}
                        <div class="video-thumb-file"
                            onclick="openModal('file','{{ addslashes($fileUrl) }}','{{ $modalTitle }}','{{ $modalDesc }}')">
                            <div class="vtf-overlay"></div>
                            <span class="vtf-icon">{{ $topikEmoji }}</span>
                            <div class="vtf-label">📁 Video Lokal</div>
                            <div class="play-btn">
                                <div class="play-circle">▶</div>
                            </div>
                            <div class="video-cat-badge {{ $badgeClass }}">{{ ucfirst($video->topik) }}</div>
                            @if ($video->durasi)
                                <div class="video-duration">{{ $video->durasi }}</div>
                            @endif
                        </div>
                    @else
                        {{-- YouTube: thumbnail dari API --}}
                        <div class="video-thumb"
                            onclick="openModal('youtube','{{ $video->youtube_id }}','{{ $modalTitle }}','{{ $modalDesc }}')">
                            <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg"
                                alt="{{ $video->judul }}" class="video-thumb-img" onerror="this.style.display='none'">
                            <div class="play-btn">
                                <div class="play-circle">▶</div>
                            </div>
                            @if ($video->durasi)
                                <div class="video-duration">{{ $video->durasi }}</div>
                            @endif
                            <div class="video-cat-badge {{ $badgeClass }}">{{ ucfirst($video->topik) }}</div>
                        </div>
                    @endif

                    {{-- ── BODY ── --}}
                    <div class="video-body">
                        <div class="video-meta">
                            @if ($video->seri)
                                <span class="video-series">{{ $video->seri }}</span>
                            @endif
                            {{-- Badge tipe --}}
                            <span class="video-type-badge">
                                {{ $isFile ? '📁 File' : '📺 YouTube' }}
                            </span>
                        </div>
                        <div class="video-title">{{ $video->judul }}</div>
                        @if ($video->deskripsi)
                            <p class="video-desc">{{ Str::limit($video->deskripsi, 120) }}</p>
                        @endif
                        <div class="video-footer">
                            <div class="video-instructor">
                                <div class="vi-avatar">NI</div>
                                <span class="vi-name">NurulIlmi</span>
                            </div>
                            {{-- Tombol Tonton --}}
                            @if ($isFile)
                                <button class="btn-watch {{ $isHaji ? 'btn-watch-gold' : '' }}"
                                    onclick="openModal('file','{{ addslashes($fileUrl) }}','{{ $modalTitle }}','{{ $modalDesc }}')">
                                    ▶ Tonton
                                </button>
                            @else
                                <button class="btn-watch {{ $isHaji ? 'btn-watch-gold' : '' }}"
                                    onclick="openModal('youtube','{{ $video->youtube_id }}','{{ $modalTitle }}','{{ $modalDesc }}')">
                                    ▶ Tonton
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-result">
                    <div class="no-result-icon">🎬</div>
                    <p class="no-result-text">Belum ada video tersedia.</p>
                </div>
            @endforelse

            <div class="no-result" id="noResult" style="display:none;">
                <div class="no-result-icon">🔍</div>
                <p class="no-result-text">Tidak ada video yang cocok.</p>
            </div>
        </div>
    </section>

    <!-- PLAYLIST -->
    <section class="playlist-section">
        <div class="playlist-inner">
            <div class="section-header reveal">
                <div class="s-badge">✦ Daftar Putar</div>
                <h2 class="s-title">Playlist <span class="em">per Topik</span></h2>
                <p class="s-sub">Tonton video secara berurutan untuk pemahaman yang lebih terstruktur.</p>
            </div>
            <div class="playlist-grid">
                <div class="playlist-card reveal">
                    <div class="pl-number">01</div>
                    <div>
                        <div class="pl-cat">🤲 Zakat</div>
                        <div class="pl-title">Playlist Lengkap Zakat</div>
                        <div class="pl-count"><span>{{ $stats['zakat'] }} video</span></div>
                    </div>
                </div>
                <div class="playlist-card reveal reveal-d1">
                    <div class="pl-number">02</div>
                    <div>
                        <div class="pl-cat">⚖️ Mawaris</div>
                        <div class="pl-title">Playlist Lengkap Mawaris</div>
                        <div class="pl-count"><span>{{ $stats['mawaris'] }} video</span></div>
                    </div>
                </div>
                <div class="playlist-card reveal reveal-d2">
                    <div class="pl-number">03</div>
                    <div>
                        <div class="pl-cat">🕋 Haji</div>
                        <div class="pl-title">Playlist Lengkap Haji</div>
                        <div class="pl-count"><span>{{ $stats['haji'] }} video</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL (YouTube & File) -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOnBg(event)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()">✕</button>

            {{-- Container YouTube --}}
            <div class="modal-video" id="modalYoutube" style="display:none;">
                <iframe id="modalIframe" src="" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

            {{-- Container File lokal --}}
            <div class="modal-video" id="modalFile" style="display:none;">
                <video id="modalVideoEl" controls controlslist="nodownload">
                    <source id="modalVideoSrc" src="" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>

            <div class="modal-info">
                <div class="modal-title" id="modalTitle"></div>
                <div class="modal-meta" id="modalMeta"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ── Filter & Sort ──────────────────────────────────────────────
        function filterVideos() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            const sort = document.getElementById('sortSelect').value;
            const cards = Array.from(document.querySelectorAll('.video-card'));
            let visible = [];

            cards.forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const matchSearch = q === '' || title.includes(q);
                if (matchSearch) {
                    card.style.display = '';
                    visible.push(card);
                } else card.style.display = 'none';
            });

            const grid = document.getElementById('videoGrid');
            if (sort === 'az') visible.sort((a, b) => a.dataset.title.localeCompare(b.dataset.title, 'id'));
            else if (sort === 'za') visible.sort((a, b) => b.dataset.title.localeCompare(a.dataset.title, 'id'));
            visible.forEach(c => grid.appendChild(c));

            document.getElementById('noResult').style.display = visible.length === 0 ? 'block' : 'none';
            visible.forEach((el, i) => {
                el.classList.remove('visible');
                setTimeout(() => el.classList.add('visible'), i * 60 + 50);
            });
        }

        // ── Modal ──────────────────────────────────────────────────────
        // type: 'youtube' | 'file'
        // src : youtube_id   | URL file
        function openModal(type, src, title, desc) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMeta').textContent = desc;

            const ytBox = document.getElementById('modalYoutube');
            const fileBox = document.getElementById('modalFile');

            if (type === 'youtube') {
                document.getElementById('modalIframe').src =
                    'https://www.youtube.com/embed/' + src + '?autoplay=1&rel=0';
                ytBox.style.display = 'block';
                fileBox.style.display = 'none';
            } else {
                document.getElementById('modalVideoSrc').src = src;
                const vid = document.getElementById('modalVideoEl');
                vid.load();
                vid.play().catch(() => {});
                fileBox.style.display = 'block';
                ytBox.style.display = 'none';
            }

            document.getElementById('modalOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('open');
            // Stop YouTube
            document.getElementById('modalIframe').src = '';
            // Stop file video
            const vid = document.getElementById('modalVideoEl');
            vid.pause();
            vid.currentTime = 0;
            document.body.style.overflow = '';
        }

        function closeModalOnBg(e) {
            if (e.target === document.getElementById('modalOverlay')) closeModal();
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
@endpush
