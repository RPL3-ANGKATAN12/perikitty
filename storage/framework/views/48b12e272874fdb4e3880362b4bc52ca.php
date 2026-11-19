<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perikitty Olshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #f4f6f8; --sidebar: #1e293b; --text: #334155; --accent: #d85b9b; --border: #e2e8f0; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

        .sidebar { width: 260px; background: var(--sidebar); color: #fff; padding: 30px 20px; position: fixed; top: 0; bottom: 0; left: 0; display: flex; flex-direction: column; }
        .sidebar h2 { font-size: 22px; margin-bottom: 40px; color: var(--accent); letter-spacing: 1px; font-weight: 700; }
        .sidebar a { color: #94a3b8; text-decoration: none; padding: 14px 16px; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; font-weight: 600; transition: 0.3s; font-size: 15px; border-left: 4px solid transparent; }
        .sidebar a:hover, .sidebar a.active { background: rgba(216, 91, 155, 0.1); color: #fff; border-left: 4px solid var(--accent); }
        .sidebar form.logout { margin-top: auto; }
        .sidebar .logout-btn { width: 100%; background: rgba(239, 68, 68, 0.1); color: #fca5a5; border: none; font-family: inherit; font-size: 15px; font-weight: 600; cursor: pointer; text-align: left; padding: 14px 16px; border-radius: 8px; transition: 0.3s; }
        .sidebar .logout-btn:hover { background: #ef4444; color: #fff; }

        .main-content { margin-left: 260px; flex: 1; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid var(--border); padding-bottom: 20px; }
        .header h1 { font-size: 28px; font-weight: 700; color: #0f172a; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Perikitty Admin</h2>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard', 'admin.edit') ? 'active' : ''); ?>">&#128230; Data Produk</a>
        <a href="<?php echo e(route('admin.orders')); ?>" class="<?php echo e(request()->routeIs('admin.orders') ? 'active' : ''); ?>">&#128203; Data Pesanan</a>
        <a href="<?php echo e(route('admin.create')); ?>" class="<?php echo e(request()->routeIs('admin.create') ? 'active' : ''); ?>">&#10133; Tambah Produk</a>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn">&#128682; Logout</button>
        </form>
    </div>

    <div class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/layouts/admin.blade.php ENDPATH**/ ?>