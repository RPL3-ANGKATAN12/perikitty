<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'Perikitty Olshop')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #1f3d36;
            --navy-2: #2b5047;
            --navy-3: #3a6659;
            --cream: #faf6ef;
            --cream-2: #f1e9da;
            --gold: #c4592f;
            --gold-soft: #d9794f;
            --text-light: #faf6ef;
            --text-muted-light: #c8d6cf;
            --text-dark: #1f3d36;
            --text-muted: #6f6b61;
            --border-light: rgba(250, 246, 239, 0.14);
            --border-dark: rgba(15, 26, 46, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            font-size: 15px;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
        }

        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.03em;
            font-weight: 700;
            line-height: 1.15;
            margin: 0;
        }

        /* ============ NAVBAR (navy) ============ */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--navy);
            border-bottom: 1px solid var(--border-light);
            padding: 14px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            color: var(--text-light);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.04em;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .logo-mark {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--gold), var(--gold-soft));
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            font-size: 16px;
            font-weight: 800;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .nav-links > a {
            color: var(--text-muted-light);
            font-weight: 500;
            font-size: 13px;
            padding: 8px 14px;
            border-radius: 8px;
        }

        .nav-links > a:hover {
            color: var(--gold);
            background: rgba(250, 246, 239, 0.08);
        }

        /* ============ BUTTONS ============ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            line-height: 1;
            letter-spacing: 0.02em;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--navy) !important;
        }

        .btn-primary:hover {
            background: var(--gold-soft);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border-light);
            color: var(--text-light) !important;
        }

        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold) !important;
        }

        /* Tombol outline di dalam halaman (latar krem) */
        .page-content .btn-outline {
            border-color: var(--navy);
            color: var(--navy) !important;
        }

        .page-content .btn-outline:hover {
            background: var(--navy);
            color: var(--cream) !important;
        }

        /* Tombol di section cream */
        .btn-navy {
            background: var(--navy);
            color: var(--cream) !important;
        }

        .btn-navy:hover {
            background: var(--navy-2);
            transform: translateY(-1px);
        }

        .btn-outline-navy {
            background: transparent;
            border: 1.5px solid var(--navy);
            color: var(--navy) !important;
        }

        .btn-outline-navy:hover {
            background: var(--navy);
            color: var(--cream) !important;
        }

        .logout-btn {
            background: transparent;
            border: 1.5px solid var(--border-light);
            color: var(--text-muted-light);
            cursor: pointer;
            font-family: inherit;
            font-weight: 500;
            font-size: 13px;
            padding: 9px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ============ CONTENT ============ */
        .page-content {
            min-height: calc(100vh - 200px);
        }

        /* ============ ALERT ============ */
        .alert {
            max-width: 1200px;
            margin: 20px auto 0;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        /* ============ FOOTER ============ */
        footer {
            margin-top: 0;
            padding: 48px 5% 90px;
            background: var(--navy);
            color: var(--text-muted-light);
            text-align: center;
            border-top: 1px solid var(--border-light);
        }

        footer .footer-logo {
            font-size: 22px;
            font-weight: 800;
            color: var(--cream);
            margin-bottom: 8px;
            letter-spacing: -0.04em;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        footer .footer-logo .logo-mark {
            width: 30px;
            height: 30px;
            font-size: 14px;
        }

        footer p {
            margin: 6px 0;
            font-size: 13px;
        }

        footer .footer-tagline {
            color: var(--text-muted-light);
            margin-bottom: 24px;
        }

        footer .footer-divider {
            height: 1px;
            background: var(--border-light);
            margin: 20px auto;
            max-width: 120px;
        }

        footer .footer-copy {
            font-size: 12px;
            color: #9db3a9;
        }

        /* ============================================
           TOMBOL WHATSAPP
           ============================================ */
        .wa-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 900;
            width: 54px;
            height: 54px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .wa-float:hover {
            transform: scale(1.08);
        }

        .wa-float svg {
            width: 26px;
            height: 26px;
            fill: #ffffff;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 750px) {
            .navbar {
                padding: 12px 5%;
            }

            .nav-links > a {
                font-size: 12px;
                padding: 6px 10px;
            }

            .logo {
                font-size: 17px;
            }

            .logo-mark {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }

            .wa-float {
                width: 50px;
                height: 50px;
                bottom: 16px;
                right: 16px;
            }

            .wa-float svg {
                width: 24px;
                height: 24px;
            }

            footer {
                padding: 40px 5% 90px;
            }
        }
            /* ===== Tema baru: hangat, elegan, santai ===== */
        .btn { border-radius: 999px; }
        .btn-primary { color: #ffffff !important; box-shadow: 0 6px 16px rgba(196, 89, 47, 0.28); }
        .btn-primary:hover { background: #d9794f; box-shadow: 0 8px 20px rgba(196, 89, 47, 0.35); }
        .logo-mark { color: #ffffff; border-radius: 10px; }
        .navbar { box-shadow: 0 4px 22px rgba(31, 61, 54, 0.18); }
        .nav-links > a:hover { color: #ffffff; background: rgba(250, 246, 239, 0.1); }
        .logout-btn { border-radius: 999px; }
        .logout-btn:hover { border-color: #ffffff; color: #ffffff; }
        .alert { border-radius: 14px; }
        main a[href*="/produk/"] > div { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        main a[href*="/produk/"] > div:hover { transform: translateY(-5px); box-shadow: 0 14px 32px rgba(31, 61, 54, 0.12); }
        ::selection { background: #c4592f; color: #ffffff; }
            /* ===== Tampilan HP ===== */
        .nav-check { display: none; }

        .nav-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1.5px solid var(--border-light);
            color: var(--text-light);
            cursor: pointer;
            flex-shrink: 0;
        }

        @media (max-width: 860px) {
            .navbar { flex-wrap: wrap; row-gap: 0; }
            .nav-toggle { display: flex; }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 2px;
                padding: 12px 0 6px;
                max-height: calc(100vh - 90px);
                overflow-y: auto;
            }

            .nav-check:checked ~ .nav-links { display: flex; }

            .nav-links > a { font-size: 15px; padding: 13px 14px; }
            .nav-links > a.btn { margin-top: 8px; }
            .nav-links form { margin-top: 8px; }
            .logout-btn { width: 100%; padding: 13px 16px; font-size: 15px; }
        }

        @media (max-width: 750px) {
            .alert { margin: 16px 5% 0; }
            input, select, textarea { font-size: 16px !important; }
        }
    </style>

    @stack('styles')
</head>

<body>

<nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
        <span class="logo-mark">P</span>
        Perikitty
    </a>

    <input type="checkbox" id="nav-toggle" class="nav-check" aria-hidden="true">
    <label for="nav-toggle" class="nav-toggle" aria-label="Buka menu">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    </label>

    <div class="nav-links">
        @auth
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.products.index') }}">Kelola Produk</a>
                <a href="{{ route('admin.categories.index') }}">Kategori</a>
                <a href="{{ route('admin.orders.index') }}">Pesanan</a>
                <a href="{{ route('admin.complaints.index') }}">Pengaduan</a>
                <a href="{{ route('admin.feedback.index') }}">Saran</a>
                <a href="{{ route('home') }}">Lihat Toko</a>
            @else
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('products.index') }}">Produk</a>
                <a href="{{ route('categories.index') }}">Kategori</a>
                <a href="{{ route('cart.index') }}">Keranjang</a>
                <a href="{{ route('orders.index') }}">Pesanan</a>
                <a href="{{ route('complaints.index') }}">Pengaduan</a>
                <a href="{{ route('feedback.index') }}">Saran</a>
                <a href="{{ route('profile.edit') }}">Profil</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Produk</a>
            <a href="{{ route('categories.index') }}">Kategori</a>
            <a href="{{ route('cart.index') }}">Keranjang</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
        @endauth
    </div>
</nav>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<main class="page-content">
    @yield('content')
</main>

<footer>
    <div class="footer-logo">
        <span class="logo-mark">P</span>
        Perikitty
    </div>
    <p class="footer-tagline">Online Shop • Mudah • Nyaman</p>
    <div class="footer-divider"></div>
    <p class="footer-copy">© {{ date('Y') }} Perikitty Olshop. All rights reserved.</p>
</footer>

<a
    href="https://wa.me/{{ config('shop.whatsapp') }}?text=Halo%20Perikitty%2C%20saya%20mau%20tanya"
    target="_blank"
    rel="noopener"
    class="wa-float"
    aria-label="Chat WhatsApp"
>
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.49