<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Auth - Perikitty'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #ffffff;
            --surface: #faf7f9;
            --text: #2d2d2d;
            --text-muted: #7a7a7a;
            --accent: #d85b9b;
            --border: #f0e5eb;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
        
        .auth-container { display: flex; width: 100%; }
        
        /* KIRI: Abstract Gradient (Bukan gambar, jadi pasti muncul!) */
        .auth-left { 
            flex: 0 0 45%; 
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 50%, #fbcfe8 100%);
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            padding: 60px; 
            text-align: center;
            border-right: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }
        
        /* Aksen lingkaran elegan di background */
        .auth-left::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 300px;
            height: 300px;
            background: rgba(216, 91, 155, 0.1);
            border-radius: 50%;
            filter: blur(40px);
        }
        
        .auth-left h2 { font-family: 'Playfair Display', serif; font-size: 52px; color: var(--accent); margin-bottom: 20px; letter-spacing: -1px; z-index: 2; }
        .auth-left p { color: var(--text-muted); font-size: 16px; max-width: 340px; line-height: 1.8; z-index: 2; }
        
        /* KANAN: Form (55%) */
        .auth-right { flex: 0 0 55%; display: flex; align-items: center; justify-content: center; padding: 40px; position: relative; background: #ffffff; }
        
        .back-link { position: absolute; top: 40px; left: 40px; display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 14px; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .back-link:hover { color: var(--accent); }
        
        .auth-box { width: 100%; max-width: 380px; }
        
        .logo { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: var(--text); margin-bottom: 30px; text-align: center; }
        .logo span { color: var(--accent); }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; color: var(--text-muted); margin-bottom: 8px; font-weight: 500; }
        input { width: 100%; padding: 16px; border-radius: 10px; border: 1px solid var(--border); background: var(--surface); color: var(--text); outline: none; font-family: inherit; font-size: 15px; transition: 0.3s; }
        input:focus { border-color: var(--accent); background: #ffffff; box-shadow: 0 0 0 3px rgba(216, 91, 155, 0.1); }
        
        .btn { width: 100%; padding: 16px; border-radius: 10px; border: none; background: var(--accent); color: #fff; font-weight: 700; font-size: 15px; cursor: pointer; margin-top: 10px; font-family: inherit; transition: 0.3s; }
        .btn:hover { background: #b8447c; }
        
        .bottom-link { text-align: center; margin-top: 24px; font-size: 14px; color: var(--text-muted); }
        .bottom-link a { color: var(--accent); font-weight: 700; text-decoration: none; }
        
        @media (max-width: 768px) {
            .auth-left { display: none; }
            .auth-right { flex: 100%; padding: 20px; }
            .back-link { top: 20px; left: 20px; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <h2>Perikitty.</h2>
            <p>Koleksi perabot dan peralatan rumah tangga elegan untuk menyempurnakan ruang impian Anda.</p>
        </div>
        <div class="auth-right">
            <a href="<?php echo e(route('home')); ?>" class="back-link">&larr; Kembali ke Beranda</a>
            <div class="auth-box">
                <div class="logo">Perikitty<span>.</span></div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/layouts/auth.blade.php ENDPATH**/ ?>