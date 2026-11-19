<?php $__env->startSection('content'); ?>
    <div class="header">
        <h1>Data Produk (Tabel Master)</h1>
        <a href="<?php echo e(route('admin.create')); ?>" style="background: var(--accent); color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 14px;">+ Tambah Produk</a>
    </div>

    <?php if(session('success')): ?>
        <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--border);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc; color: #64748b; font-size: 13px; border-bottom: 1px solid var(--border);">
                <tr><th style="padding: 16px 24px;">Foto</th><th style="padding: 16px 24px;">Nama Produk</th><th style="padding: 16px 24px;">Harga</th><th style="padding: 16px 24px;">Stok</th><th style="padding: 16px 24px;">Aksi</th></tr>
            </thead>
            <tbody style="font-size: 14px;">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $imgs = json_decode($p->images ?? '[]', true) ?: []; ?>
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 16px 24px;"><div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden;"><img src="<?php echo e(isset($imgs[0]) ? asset('storage/' . $imgs[0]) : asset('images/produk1.jpg')); ?>" style="width: 100%; height: 100%; object-fit: cover;"></div></td>
                    <td style="padding: 16px 24px; font-weight: 600; color: #0f172a;"><?php echo e($p->name); ?></td>
                    <td style="padding: 16px 24px; font-weight: 700;">Rp <?php echo e(number_format($p->price, 0, ',', '.')); ?></td>
                    <td style="padding: 16px 24px;"><?php echo e($p->stock); ?></td>
                    <td style="padding: 16px 24px; display: flex; gap: 8px;">
                        <a href="<?php echo e(route('admin.edit', $p->id)); ?>" style="background: #eab308; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px;">Edit</a>
                        <form action="<?php echo e(route('admin.destroy', $p->id)); ?>" method="POST" onsubmit="return confirm('Hapus produk ini?');"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?> <button type="submit" style="background: #ef4444; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 12px;">Hapus</button></form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="padding: 24px; text-align: center; color: #888;">Belum ada produk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>