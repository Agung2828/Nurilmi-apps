<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — NurulIlmi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
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
            --gold-ll: #F5E0A0;
            --white: #FFFFFF;
            --text-main: #E8EDF5;
            --text-muted: #8899BB;
            --card-bg: rgba(17, 34, 64, 0.85);
            --card-border: rgba(201, 168, 76, 0.18);
            --glass: rgba(255, 255, 255, 0.04);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--navy);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background animated blobs */
        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .12;
            pointer-events: none;
            animation: blobFloat 8s ease-in-out infinite;
        }

        .bg-blob-1 {
            width: 500px;
            height: 500px;
            background: var(--emerald);
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .bg-blob-2 {
            width: 400px;
            height: 400px;
            background: var(--gold);
            bottom: -100px;
            right: -100px;
            animation-delay: 3s;
        }

        .bg-blob-3 {
            width: 300px;
            height: 300px;
            background: var(--emerald-l);
            top: 50%;
            right: 20%;
            animation-delay: 6s;
        }

        @keyframes blobFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(20px, -20px) scale(1.05);
            }
        }

        /* Grid pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            opacity: .025;
            background-image:
                linear-gradient(var(--gold) 1px, transparent 1px),
                linear-gradient(90deg, var(--gold) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        /* Two-column layout */
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 960px;
            min-height: 520px;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--card-border);
            box-shadow: 0 32px 80px rgba(0, 0, 0, .4);
            position: relative;
            z-index: 2;
            backdrop-filter: blur(20px);
        }

        /* LEFT PANEL — Branding */
        .login-left {
            width: 45%;
            background: linear-gradient(145deg, rgba(13, 115, 119, .35) 0%, rgba(11, 22, 40, .9) 60%, rgba(26, 58, 92, .4) 100%);
            padding: 3.5rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--card-border);
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 115, 119, .3), transparent 70%);
            bottom: -80px;
            left: -80px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 168, 76, .15), transparent 70%);
            top: -40px;
            right: -40px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: .9rem;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 8px 24px rgba(13, 115, 119, .4);
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.2;
        }

        .brand-name span {
            display: block;
            font-size: .7rem;
            font-weight: 400;
            color: var(--text-muted);
            letter-spacing: .4px;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .brand-eyebrow {
            font-size: .68rem;
            font-weight: 600;
            color: var(--gold-l);
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: .7rem;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .brand-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .brand-title .em {
            background: linear-gradient(135deg, var(--emerald-ll), var(--gold-l));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .brand-desc {
            font-size: .82rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.8rem;
        }

        .brand-features {
            display: flex;
            flex-direction: column;
            gap: .65rem;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: .65rem;
            font-size: .78rem;
            color: var(--text-muted);
        }

        .brand-feature-dot {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            background: rgba(13, 115, 119, .25);
            border: 1px solid rgba(13, 115, 119, .3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            flex-shrink: 0;
        }

        .brand-bottom {
            position: relative;
            z-index: 1;
            font-size: .68rem;
            color: var(--text-muted);
        }

        /* RIGHT PANEL — Form */
        .login-right {
            width: 55%;
            background: var(--card-bg);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-title {
            font-family: 'Baloo 2', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: .35rem;
        }

        .login-subtitle {
            font-size: .82rem;
            color: var(--text-muted);
        }

        .login-subtitle a {
            color: var(--emerald-ll);
            text-decoration: none;
        }

        /* Session Status */
        .session-status {
            background: rgba(13, 115, 119, .15);
            border: 1px solid rgba(13, 115, 119, .3);
            border-radius: 10px;
            padding: .8rem 1rem;
            color: var(--emerald-ll);
            font-size: .82rem;
            margin-bottom: 1.2rem;
        }

        /* Form */
        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: .5rem;
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .form-input {
            width: 100%;
            padding: .8rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: rgba(11, 22, 40, .6);
            color: var(--text-main);
            font-size: .9rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color .25s, box-shadow .25s;
        }

        .form-input:focus {
            border-color: var(--emerald-l);
            box-shadow: 0 0 0 3px rgba(13, 115, 119, .15);
        }

        .form-input::placeholder {
            color: rgba(136, 153, 187, .5);
        }

        .form-input.error {
            border-color: #f87171;
        }

        .form-error {
            font-size: .72rem;
            color: #f87171;
            margin-top: .35rem;
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        /* Remember + Forgot */
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            cursor: pointer;
            font-size: .8rem;
            color: var(--text-muted);
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--emerald-l);
            cursor: pointer;
        }

        .forgot-link {
            font-size: .78rem;
            color: var(--gold-l);
            text-decoration: none;
            transition: color .2s;
        }

        .forgot-link:hover {
            color: var(--gold-ll);
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: .9rem;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-l));
            color: #fff;
            font-size: .95rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            box-shadow: 0 8px 24px rgba(13, 115, 119, .3);
            letter-spacing: .3px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(13, 115, 119, .45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: .8rem;
            margin: 1.5rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--card-border);
        }

        .divider-text {
            font-size: .72rem;
            color: var(--text-muted);
        }

        /* Back to site link */
        .back-to-site {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            color: var(--text-muted);
            font-size: .78rem;
            text-decoration: none;
            padding: .55rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
            transition: all .25s;
        }

        .back-to-site:hover {
            border-color: var(--gold);
            color: var(--gold-l);
        }

        /* Responsive */
        @media(max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 440px;
                margin: 1rem;
                min-height: auto;
            }

            .login-left {
                width: 100%;
                padding: 2rem 1.8rem;
                border-right: none;
                border-bottom: 1px solid var(--card-border);
            }

            .brand-content {
                display: none;
            }

            .brand-bottom {
                display: none;
            }

            .login-right {
                width: 100%;
                padding: 2rem 1.8rem;
            }
        }

        @media(max-width: 480px) {
            .login-wrapper {
                margin: .75rem;
            }
        }
    </style>
</head>

<body>

    <!-- Background elements -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="bg-blob bg-blob-3"></div>

    <div class="login-wrapper">

        <!-- LEFT — Branding -->
        <div class="login-left">
            <div class="brand-logo">
                <div class="brand-icon">🌙</div>
                <div class="brand-name">
                    NurulIlmi
                    <span>Admin Panel</span>
                </div>
            </div>

            <div class="brand-content">
                <div class="brand-eyebrow">✦ Media Pembelajaran Islami</div>
                <div class="brand-title">
                    Selamat Datang di<br>
                    Panel <span class="em">Admin</span>
                </div>
                <p class="brand-desc">
                    Kelola seluruh konten media pembelajaran interaktif Zakat, Mawaris, dan Haji untuk peserta didik
                    SMA/MA.
                </p>
                <div class="brand-features">
                    <div class="brand-feature">
                        <div class="brand-feature-dot">📚</div>
                        Kelola materi & konten pembelajaran
                    </div>
                    <div class="brand-feature">
                        <div class="brand-feature-dot">🎬</div>
                        Upload & atur video pembelajaran
                    </div>
                    <div class="brand-feature">
                        <div class="brand-feature-dot">📝</div>
                        Buat soal evaluasi interaktif
                    </div>
                    <div class="brand-feature">
                        <div class="brand-feature-dot">📋</div>
                        Kelola ATP & alur pembelajaran
                    </div>
                </div>
            </div>

            <div class="brand-bottom">
                © {{ date('Y') }} NurulIlmi — Hengki Ras Bumi, M.Pd
            </div>
        </div>

        <!-- RIGHT — Form -->
        <div class="login-right">
            <div class="login-header">
                <div class="login-title">Masuk ke Admin</div>
                <div class="login-subtitle">Gunakan akun administrator untuk melanjutkan</div>
            </div>

            {{-- Session Status (misal: password reset berhasil) --}}
            @if (session('status'))
                <div class="session-status">✅ {{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}" placeholder="admin@nurulilmi.com"
                        required autofocus autocomplete="username">
                    @error('email')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'error' : '' }}" placeholder="••••••••••"
                        required autocomplete="current-password">
                    @error('password')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="form-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login">
                    🔐 Masuk ke Admin
                </button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-text">atau</div>
                <div class="divider-line"></div>
            </div>

            <a href="{{ route('home') }}" class="back-to-site">
                🏠 Kembali ke Website
            </a>
        </div>

    </div>

</body>

</html>
