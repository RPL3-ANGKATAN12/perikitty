<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perikitty Olshop')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #ffffff; /* Putih bersih */
            --surface: #faf7f9; /* Pink sangat muda */
            --text: #2d2d2d; /* Abu gelap elegan */
            --text-muted: #7a7a7a;
            --accent: #d85b9b; /* Rose/Pink Premium */
            --gold: #c9a227;
            --border: #f0e5eb;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; font-weight: 700; color: var(--text); }
        a { text-decoration: none; color: inherit; transition: 0.3s; }
        
        /* Navbar Cerah */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 24px 8%; background: var(--bg); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; }
        .logo { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: var(--accent); }
        .nav-links { display: flex; align-items: center; gap: 30px; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .nav-links a:hover { color: var(--accent); }
        
        /* Tombol Elegan */
        .btn { padding: 14px 32px; border-radius: 100px; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; border: 2px solid var(--accent); font-family: 'Plus Jakarta Sans', sans-serif; transition: 0.3s; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #b8447c; border-color: #b8447c; }
        .btn-outline { background: transparent; color: var(--accent); }
        .btn-outline:hover { background: var(--accent); color: #fff; }
        
        .page-content { flex: 1; }
        footer { padding: 40px; text-align: center; border-top: 1px solid var(--border); color: var(--text-muted); font-size: 13px; margin-top: auto; }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="{{ route('home') }}" class="logo">Perikitty.</a>
    <div class="nav-links">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('products.index') }}">Koleksi</a>
        <a href="{{ route('categories.index') }}">Kategori</a>
        <a href="{{ route('cart.index') }}">Keranjang</a>
        @auth
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">@csrf<button type="submit" style="background:none;border:none;color:inherit;font-family:inherit;font-size:inherit;cursor:pointer;">Logout</button></form>
        @else
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 10px 24px;">Daftar</a>
        @endauth
    </div>
</nav>
<main class="page-content">@yield('content')</main>
<footer>© {{ date('Y') }} Perikitty. Made with love.</footer>
</body>
</html>