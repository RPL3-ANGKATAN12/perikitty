<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Perikitty Olshop'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #ffffff; --surface: #faf7f9; --text: #2d2d2d; --text-muted: #7a7a7a; --accent: #d85b9b; --gold: #c9a227; --border: #f0e5eb; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; font-weight: 700; color: var(--text); }
        a { text-decoration: none; color: inherit; transition: 0.3s; }
        
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 8%; background: var(--bg); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; }
        .logo { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: var(--accent); }
        .nav-links { display: flex; align-items: center; gap: 24px; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .nav-links a:hover { color: var(--accent); }
        
        .btn { padding: 12px 28px; border-radius: 100px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; border: 2px solid var(--accent); font-family: 'Plus Jakarta Sans', sans-serif; transition: 0.3s; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #b8447c; border-color: #b8447c; }
        .btn-outline { background: transparent; color: var(--accent); }
        .btn-outline:hover { background: var(--accent); color: #fff; }
        
        .page-content { flex: 1; }
        footer { padding: 40px; text-align: center; border-top: 1px solid var(--border); color: var(--text-muted); font-size: 13px; margin-top: auto; }

        .profile-menu { position: relative; display: inline-block; }
        .profile-btn { display: flex; align-items: center; gap: 10px; cursor: pointer; background: var(--surface); padding: 6px 16px 6px 6px; border-radius: 100px; border: 1px solid var(--border); transition: 0.3s; }
        .profile-avatar { width: 36px; height: 36px; background: var(--accent); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold; }
        
        .dropdown-content { display: none; position: absolute; right: 0; background-color: #fff; min-width: 220px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-radius: 12px; z-index: 1000; overflow: hidden; border: 1px solid var(--border); margin-top: 10px; }
        .dropdown-content.show { display: block; }
        .dropdown-content a, .dropdown-content button { color: var(--text); padding: 14px 20px; text-decoration: none; display: block; font-size: 14px; font-weight: 600; border-bottom: 1px solid var(--border); width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-family: inherit; }
        .dropdown-content a:hover, .dropdown-content button:hover { background-color: var(--surface); color: var(--accent); }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="<?php echo e(route('home')); ?>" class="logo">Perikitty.</a>
    <div class="nav-links">
        <a href="<?php echo e(route('home')); ?>">Beranda</a>
        <a href="<?php echo e(route('products.index')); ?>">Koleksi</a>
        <a href="<?php echo e(route('categories.index')); ?>">Kategori</a>
        
        <?php if(auth()->guard()->check()): ?>
            
            <?php if(auth()->user()->role === 'admin'): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" style="color: var(--accent); font-weight: 800;">Dashboard Admin</a>
            <?php else: ?>
            
                <a href="<?php echo e(route('cart.index')); ?>">Keranjang</a>
            <?php endif; ?>

            <div class="profile-menu">
                <div class="profile-btn" onclick="toggleDropdown()">
                    <div class="profile-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
                    <span style="font-size: 13px;"><?php echo e(explode(' ', auth()->user()->name)[0]); ?></span>
                </div>
                
                <div class="dropdown-content" id="myDropdown">
                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" style="color: var(--accent); font-weight: 800;">Dashboard Admin</a>
                    <?php else: ?>
                    
                        <a href="<?php echo e(route('profile.index')); ?>">Profil & Pesanan Saya</a>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>">Masuk</a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Daftar</a>
        <?php endif; ?>
    </div>
</nav>
<main class="page-content"><?php echo $__env->yieldContent('content'); ?></main>
<footer>© <?php echo e(date('Y')); ?> Perikitty. Made with love.</footer>

<script>
    function toggleDropdown() { document.getElementById("myDropdown").classList.toggle("show"); }
    window.onclick = function(event) { if (!event.target.closest('.profile-btn')) { var dropdowns = document.getElementsByClassName("dropdown-content"); for (var i = 0; i < dropdowns.length; i++) { var openDropdown = dropdowns[i]; if (openDropdown.classList.contains('show')) { openDropdown.classList.remove('show'); } } } }
</script>
</body>
</html><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/layouts/app.blade.php ENDPATH**/ ?>