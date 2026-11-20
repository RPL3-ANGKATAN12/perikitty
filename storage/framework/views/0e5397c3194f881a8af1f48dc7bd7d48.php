<?php $__env->startSection('title', 'Keranjang - Perikitty'); ?>
<?php $__env->startSection('content'); ?>
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 30px;">Keranjang Belanja</h1>
        <?php if(session('success')): ?> <div style="background:#d4edda; color:#155724; padding:16px; border-radius:8px; margin-bottom:20px;"><?php echo e(session('success')); ?></div> <?php endif; ?>

        <?php if(empty($cart)): ?>
            <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 60px; text-align: center;">
                <h2 style="color: var(--text);">Keranjang masih kosong.</h2>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary" style="margin-top: 20px; display: inline-block;">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 30px;">
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                    <div style="width: 80px; height: 80px; background: #fff; border-radius: 10px; overflow: hidden;">
                        <img src="<?php echo e(asset('storage/products/' . $item['image'])); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='<?php echo e(asset('images/produk1.jpg')); ?>'">
                    </div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 18px; color: var(--text); margin-bottom: 6px;"><?php echo e($item['name']); ?></h3>
                        <p style="color: var(--accent); font-weight: 700;">Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; background: #fff; padding: 6px 12px; border-radius: 100px; border: 1px solid var(--border);">
                        <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST"><?php echo csrf_field(); ?> <input type="hidden" name="action" value="decrease"><button type="submit" style="background:none; border:none; cursor:pointer; font-size:16px;">-</button></form>
                        <span style="font-weight:600;"><?php echo e($item['qty']); ?></span>
                        <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST"><?php echo csrf_field(); ?> <input type="hidden" name="action" value="increase"><button type="submit" style="background:none; border:none; cursor:pointer; font-size:16px;">+</button></form>
                    </div>
                    <div style="font-weight: 800; color: var(--text); min-width: 100px; text-align: right;">Rp <?php echo e(number_format($item['price'] * $item['qty'], 0, ',', '.')); ?></div>
                    <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?> <button type="submit" style="background:none; border:none; cursor:pointer; font-size:20px;">🗑️</button></form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: var(--text-muted); margin-bottom: 4px;">Total Pembayaran</p>
                    <div style="font-size: 28px; font-weight: 800; color: var(--text);">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></div>
                </div>
                <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-primary" style="padding: 16px 32px; text-decoration: none;">Lanjut ke Checkout &rarr;</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/cart/index.blade.php ENDPATH**/ ?>