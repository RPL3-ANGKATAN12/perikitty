<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Perikitty')</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #fff9fc;
            color: #2d2429;
        }
        .adm-shell {
            display: flex;
            min-height: 100vh;
        }
        .adm-sidebar {
            width: 265px;
            flex-shrink: 0;
            background: linear-gradient(180deg, #fff5f9 0%, #fffaf7 55%, #ffffff 100%);
            border-right: 1px solid #f5d8e7;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 6px 0 24px rgba(224, 98, 160, 0.05);
        }
        .adm-brand {
            padding: 6px 10px 18px;
            border-bottom: 1px solid #f7e1ec;
            margin-bottom: 18px;
        }
        .adm-brand-pill {
            display: inline-block;
            background: #ffe3f0;
            color: #b83778;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 999px;
            margin-bottom: 8px;
        }
        .adm-brand-title {
            margin: 0;
            font-size: 21px;
            font-weight: 800;
            color: #2b1d24;
            letter-spacing: -0.3px;
        }
        .adm-brand-sub {
            margin: 3px 0 0;
            font-size: 12px;
            color: #87757e;
        }
        .adm-nav-label {
            font-size: 11px;
            font-weight: 800;
            color: #9e8893;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 0 12px 8px;
        }
        .adm-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .adm-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 14px;
            border-radius: 13px;
            text-decoration: none;
            color: #4f4048;
            font-weight: 650;
            font-size: 14px;
            border: 1px solid transparent;
            transition: all 0.15s ease;
        }
        .adm-link:hover {
            background: #fff0f7;
            color: #b53274;
            border-color: #f8d4e6;
        }
        .adm-link.active {
            background: linear-gradient(135deg, #ffe0ef 0%, #fff0f7 100%);
            color: #a82868;
            font-weight: 800;
            border-color: #f4bdd9;
            box-shadow: 0 6px 14px rgba(216, 91, 155, 0.12);
        }
        .adm-footer {
            padding-top: 16px;
            border-top: 1px solid #f7e1ec;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .adm-home-link {
            display: block;
            text-align: center;
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            color: #7c4d64;
            background: #fff7fb;
            border: 1px solid #f4d4e4;
        }
        .adm-home-link:hover {
            background: #ffeaf4;
        }
        .adm-logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 14px;
            border-radius: 12px;
            border: 1.5px solid #fecdd3;
            background: #fff5f6;
            color: #be123c;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .adm-logout-btn:hover {
            background: #ffe4e6;
        }
        .adm-main {
            flex: 1;
            min-width: 0;
            padding: 28px 32px;
            background: #fff9fc;
        }
        @media (max-width: 820px) {
            .adm-shell { flex-direction: column; }
            .adm-sidebar { width: 100%; border-right: none; border-bottom: 1px solid #f5d8e7; }
            .adm-main { padding: 20px 16px; }
        }
    </style>
</head>
<body>
<div class="adm-shell">
    <aside class="adm-sidebar">
        <div>
            <div class="adm-brand">
                <span class="adm-brand-pill">Admin Panel</span>
                <h2 class="adm-brand-title">Perikitty Admin</h2>
                <p class="adm-brand-sub">Manajemen katalog &amp; pesanan</p>
            </div>

            <div class="adm-nav-label">Menu Utama</div>
            <nav class="adm-nav">
                <a href="{{ route('admin.dashboard') }}" class="adm-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>&#128230;</span>
                    <span>Data Produk</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="adm-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <span>&#128203;</span>
                    <span>Data Pesanan</span>
                </a>
                <a href="{{ route('admin.create') }}" class="adm-link {{ request()->routeIs('admin.create') ? 'active' : '' }}">
                    <span>&#10133;</span>
                    <span>Tambah Produk</span>
                </a>
            </nav>
        </div>

        <div class="adm-footer">
            <a href="{{ route('home') }}" class="adm-home-link">Lihat Beranda Toko</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="adm-logout-btn">
                    <span>&#128682;</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="adm-main">
        @yield('content')
    </main>
</div>
</body>
</html>
