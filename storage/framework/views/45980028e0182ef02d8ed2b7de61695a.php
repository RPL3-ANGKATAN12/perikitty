<?php $__env->startSection('title', 'Pesanan Saya - Perikitty'); ?>
<?php $__env->startSection('content'); ?>
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 30px;">Halo, <?php echo e(auth()->user()->name); ?></h1>
        <h2 style="font-size: 24px; margin-bottom: 20px; color: var(--text);">Riwayat Pesanan</h2>
        
        <div style="background: #faf7f9; border-radius: 16px; border: 1px solid var(--border); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #fdf2f8; color: var(--text-muted); font-size: 13px;">
                    <tr>
                        <th style="padding: 16px 24px;">No. Pesanan</th>
                        <th style="padding: 16px 24px;">Total</th>
                        <th style="padding: 16px 24px;">Status</th>
                        <th style="padding: 16px 24px;">Tanggal</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px 24px; font-weight: 600;"><?php echo e($order->order_number); ?></td>
                        <td style="padding: 16px 24px; color: var(--accent); font-weight: 700;">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></td>
                        <td style="padding: 16px 24px;"><span style="background: rgba(216,91,155,0.1); color: var(--accent); padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 700;"><?php echo e($order->status); ?></span></td>
                        <td style="padding: 16px 24px;"><?php echo e($order->created_at->format('d M Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" style="padding: 24px; text-align: center; color: var(--text-muted);">Belum ada pesanan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/profile/index.blade.php ENDPATH**/ ?>