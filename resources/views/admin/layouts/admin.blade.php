<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | NurulIlmi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700;800&family=Nunito:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --navy: #0B1628;
            --navy-mid: #112240;
            --navy-light: #1A3A5C;
            --emerald: #0D7377;
            --emerald-l: #14A098;
            --emerald-ll: #1FC8C0;
            --gold: #C9A84C;
            --gold-l: #E8C97A;
            --white: #FFFFFF;
            --text-main: #E8EDF5;
            --text-muted: #8899BB;
            --card-bg: rgba(17, 34, 64, 0.9);
            --card-border: rgba(201, 168, 76, 0.15);
            --sidebar-w: 240px;
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
            font-family: 'Nunito', sans-serif;
            background: var(--navy);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy-mid);
            border-right: 1px solid var(--card-border);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 1.4rem 1.2rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .sidebar-logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-family: 'Baloo 2', sans-serif;
            font-size: .9rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.2;
        }

        .sidebar-logo-text span {
            display: block;
            font-size: .58rem;
            font-weight: 400;
            color: var(--text-muted);
        }

        .sidebar-section {
            padding: .8rem 1rem .3rem;
            font-size: .62rem;
            font-weight: 800;
            color: var(--text-muted);
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            list-style: none;
            padding: .2rem 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .6rem 1rem;
            font-size: .82rem;
            font-weight: 600;
            color: var(--text-muted);
            text-decoration: none;
            transition: all .2s;
            border-radius: 0;
        }

        .sidebar-nav li a:hover {
            background: rgba(201, 168, 76, .06);
            color: var(--gold-l);
        }

        .sidebar-nav li a.active {
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
            border-right: 2px solid var(--emerald-l);
        }

        .sidebar-nav li a .nav-icon {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid var(--card-border);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .7rem .8rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, .03);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--emerald), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name {
            font-size: .78rem;
            font-weight: 700;
            color: var(--white);
        }

        .user-role {
            font-size: .63rem;
            color: var(--emerald-ll);
        }

        .btn-logout {
            display: block;
            width: 100%;
            margin-top: .5rem;
            padding: .5rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: transparent;
            color: var(--text-muted);
            font-size: .75rem;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
            text-align: center;
        }

        .btn-logout:hover {
            border-color: rgba(239, 68, 68, .3);
            color: #f87171;
        }

        /* MAIN CONTENT */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-topbar {
            height: 56px;
            background: var(--navy-mid);
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
        }

        .topbar-breadcrumb {
            font-size: .78rem;
            color: var(--text-muted);
        }

        .topbar-breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .topbar-breadcrumb a:hover {
            color: var(--gold-l);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .btn-site {
            padding: .38rem .9rem;
            border-radius: 7px;
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
            font-size: .75rem;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid rgba(13, 115, 119, .2);
            transition: all .2s;
        }

        .btn-site:hover {
            background: rgba(13, 115, 119, .25);
        }

        .admin-content {
            padding: 1.5rem;
            flex: 1;
        }

        /* CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 1.2rem;
            backdrop-filter: blur(10px);
        }

        .stat-num {
            font-family: 'Baloo 2', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--gold-l);
        }

        .stat-label {
            font-size: .75rem;
            color: var(--text-muted);
            margin-top: .2rem;
        }

        /* TABLE */
        .admin-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            margin-bottom: 1.5rem;
        }

        .admin-card-header {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-card-title {
            font-size: .9rem;
            font-weight: 800;
            color: var(--white);
        }

        .btn-add {
            padding: .45rem 1rem;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
        }

        .btn-add:hover {
            transform: translateY(-1px);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .82rem;
        }

        th {
            padding: .7rem 1rem;
            text-align: left;
            font-size: .65rem;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .4px;
            background: rgba(255, 255, 255, .02);
            border-bottom: 1px solid var(--card-border);
        }

        td {
            padding: .7rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .04);
            color: var(--text-muted);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(13, 115, 119, .04);
        }

        .td-title {
            color: var(--white);
            font-weight: 700;
        }

        .badge {
            padding: .2rem .6rem;
            border-radius: 4px;
            font-size: .65rem;
            font-weight: 700;
            display: inline-block;
        }

        .badge-z {
            background: rgba(13, 115, 119, .15);
            color: var(--emerald-ll);
        }

        .badge-m {
            background: rgba(59, 111, 168, .15);
            color: #7eb8e8;
        }

        .badge-h {
            background: rgba(201, 168, 76, .12);
            color: var(--gold-l);
        }

        .badge-active {
            background: rgba(13, 115, 119, .12);
            color: var(--emerald-ll);
        }

        .badge-inactive {
            background: rgba(239, 68, 68, .1);
            color: #f87171;
        }

        .td-actions {
            display: flex;
            gap: .4rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-edit {
            padding: .28rem .65rem;
            border-radius: 6px;
            background: rgba(201, 168, 76, .1);
            color: var(--gold-l);
            font-size: .7rem;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid rgba(201, 168, 76, .15);
            transition: all .2s;
        }

        .btn-edit:hover {
            background: rgba(201, 168, 76, .2);
        }

        .btn-delete {
            padding: .28rem .65rem;
            border-radius: 6px;
            background: rgba(239, 68, 68, .08);
            color: #f87171;
            font-size: .7rem;
            font-weight: 700;
            border: 1px solid rgba(239, 68, 68, .15);
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, .15);
        }

        /* FORM */
        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .form-group.full {
            grid-column: 1/-1;
        }

        .form-label {
            font-size: .75rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .form-control {
            padding: .6rem .9rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            background: rgba(11, 22, 40, .6);
            color: var(--text-main);
            font-size: .85rem;
            font-family: 'Nunito', sans-serif;
            outline: none;
            transition: border-color .2s;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--emerald-l);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        select.form-control option {
            background: var(--navy-mid);
        }

        .form-hint {
            font-size: .68rem;
            color: var(--text-muted);
        }

        .form-error {
            font-size: .7rem;
            color: #f87171;
            margin-top: .2rem;
        }

        .btn-submit {
            padding: .65rem 1.6rem;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .88rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
        }

        .btn-cancel {
            padding: .65rem 1.6rem;
            border-radius: 9px;
            background: transparent;
            color: var(--text-muted);
            font-size: .88rem;
            font-weight: 700;
            border: 1px solid var(--card-border);
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: all .2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            border-color: var(--gold-l);
            color: var(--gold-l);
        }

        .form-actions {
            display: flex;
            gap: .8rem;
            margin-top: 1.2rem;
            flex-wrap: wrap;
        }

        .current-pdf {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem .8rem;
            background: rgba(13, 115, 119, .08);
            border: 1px solid rgba(13, 115, 119, .15);
            border-radius: 8px;
            font-size: .78rem;
            color: var(--emerald-ll);
            margin-top: .4rem;
        }

        /* PAGINATION */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            padding: 1rem 0;
        }

        .pagination-wrap .pagination {
            display: flex;
            gap: .3rem;
            list-style: none;
        }

        .pagination-wrap .page-item .page-link {
            padding: .4rem .7rem;
            border-radius: 7px;
            border: 1px solid var(--card-border);
            background: transparent;
            color: var(--text-muted);
            font-size: .78rem;
            text-decoration: none;
            transition: all .2s;
        }

        .pagination-wrap .page-item.active .page-link,
        .pagination-wrap .page-link:hover {
            background: var(--emerald);
            border-color: var(--emerald);
            color: #fff;
        }

        /* ALERT */
        .alert {
            padding: .9rem 1.2rem;
            border-radius: 10px;
            margin-bottom: 1rem;
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

        .thumbnail-prev {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--card-border);
        }

        @media(max-width:768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">🌙</div>
            <div class="sidebar-logo-text">NurulIlmi<span>Admin Panel</span></div>
        </div>

        <div class="sidebar-section">Menu Utama</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Konten</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.materi.index') }}"
                    class="{{ request()->routeIs('admin.materi.*') ? 'active' : '' }}">
                    <span class="nav-icon">📚</span> Materi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.video.index') }}"
                    class="{{ request()->routeIs('admin.video.*') ? 'active' : '' }}">
                    <span class="nav-icon">🎬</span> Video
                </a>
            </li>
            <li>
                <a href="{{ route('admin.evaluasi.index') }}"
                    class="{{ request()->routeIs('admin.evaluasi.*') ? 'active' : '' }}">
                    <span class="nav-icon">📝</span> Evaluasi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.atp.index') }}"
                    class="{{ request()->routeIs('admin.atp.*') ? 'active' : '' }}">
                    <span class="nav-icon">🔏</span> ATP
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Sistem</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('home') }}" target="_blank">
                    <span class="nav-icon">🌐</span> Lihat Website
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <div class="user-info">
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="admin-main">
        <div class="admin-topbar">
            <div>
                <div class="topbar-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @hasSection('breadcrumb')
                        <span style="margin:0 .3rem;opacity:.4;">›</span>@yield('breadcrumb')
                    @endif
                </div>
                <div class="topbar-title">@yield('title', 'Dashboard')</div>
            </div>
            <div class="topbar-right">
                <a href="{{ route('home') }}" class="btn-site" target="_blank">🌐 Lihat Website</a>
            </div>
        </div>

        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            @yield('admin-content')
        </div>
    </main>

</body>

</html>
