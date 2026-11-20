<?php $__env->startSection('title', 'Semua Koleksi - Perikitty'); ?>
<?php $__env->startSection('content'); ?>

<?php
    $allCategories = $categories ?? \App\Models\Category::all();
    $selectedCatId = request('category');
    $listProducts = $products ?? \App\Models\Product::when($selectedCatId, fn($q) => $q->where('category_id', $selectedCatId))->when(request('q'), fn($q) => $q->where('name', 'like', '%' . request('q') . '%'))->latest()->get();
?>

<section style="padding: 52px 8% 72px; min-height: 75vh; background: linear-gradient(180deg, #fff4f8 0%, #fff9fb 45%, #fff3f8 100%);">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px; margin-bottom: 28px;">
        <div>
            <p style="color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin: 0 0 6px;">Katalog Perikitty</p>
            <h1 style="font-size: clamp(30px, 3.6vw, 40px); font-family: 'Playfair Display', serif; color: var(--text); margin: 0 0 6px; font-weight: 600;">Semua Koleksi</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Temukan perabot impianmu di sini.</p>
        </div>

        <form action="<?php echo e(route('products.index')); ?>" method="GET" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
            <?php if($selectedCatId): ?>
                <input type="hidden" name="category" value="<?php echo e($selectedCatId); ?>">
            <?php endif; ?>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari barang..." style="padding: 10px 16px; border-radius: 999px; border: 1px solid #f0c9dc; background: #fffdfd; color: var(--text); font-size: 13px; min-width: 210px; outline: none;">
            <button type="submit" style="padding: 10px 20px; border-radius: 999px; border: none; background: var(--accent); color: #fff; font-size: 12px; font-weight: 700; cursor: pointer; letter-spacing: 0.5px;">Cari</button>
        </form>
    </div>

    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 34px; padding-bottom: 16px; border-bottom: 1px solid #f4cfe0;">
        <a href="<?php echo e(route('products.index')); ?>" style="text-decoration: none; padding: 8px 16px; border-radius: 999px; font-size: 12px; font-weight: 700; border: 1px solid <?php echo e(empty($selectedCatId) ? 'var(--accent)' : '#f2cde0'); ?>; background: <?php echo e(empty($selectedCatId) ? 'var(--accent)' : '#fff6fa'); ?>; color: <?php echo e(empty($selectedCatId) ? '#fff' : '#7c3a56'); ?>;">
            Semua
        </a>
        <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $isActive = (string)$selectedCatId === (string)$cat->id; ?>
            <a href="<?php echo e(route('products.index')); ?>?category=<?php echo e($cat->id); ?>" style="text-decoration: none; padding: 8px 16px; border-radius: 999px; font-size: 12px; font-weight: 700; border: 1px solid <?php echo e($isActive ? 'var(--accent)' : '#f2cde0'); ?>; background: <?php echo e($isActive ? 'var(--accent)' : '#fff6fa'); ?>; color: <?php echo e($isActive ? '#fff' : '#7c3a56'); ?>;">
                <?php echo e($cat->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(count($listProducts) > 0): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 22px;">
            <?php $__currentLoopData = $listProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('products.show', $product->id)); ?>" style="text-decoration: none; display: block;">
                <div style="background: linear-gradient(180deg, #fffdfd 0%, #ffeaf2 100%); border: 1px solid #f2cde0; border-radius: 16px; padding: 12px; height: 100%; transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; box-shadow: 0 6px 18px rgba(219, 39, 119, 0.05);"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 12px 24px rgba(219, 39, 119, 0.12)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f2cde0'; this.style.boxShadow='0 6px 18px rgba(219, 39, 119, 0.05)';">
                    <div style="height: 205px; background: #fce2ed; border-radius: 11px; overflow: hidden; margin-bottom: 12px; display: flex; align-items: center; justify-content: center;">
                        <?php if($product->images): ?>
                            <?php $imgs = json_decode($product->images, true) ?? []; ?>
                            <?php if(count($imgs) > 0): ?>
                                <img src="<?php echo e(asset('storage/' . $imgs[0])); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg')); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg')); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                    </div>
                    <p style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #9d4b6c; margin: 0 0 4px;">Perikitty Collection</p>
                    <h2 style="font-size: 15px; font-family: 'Playfair Display', serif; font-weight: 600; color: var(--text); margin: 0 0 8px; line-height: 1.35;"><?php echo e($product->name); ?></h2>
                    <p style="color: var(--accent); font-weight: 700; font-size: 14px; margin: 0;">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 56px 24px; background: #fff7fa; border: 1px solid #f2cde0; border-radius: 18px; max-width: 520px; margin: 24px auto 0;">
            <p style="font-family: 'Playfair Display', serif; font-size: 20px; color: var(--text); margin: 0 0 8px;">Belum ada produk di kategori ini</p>
            <p style="color: var(--text-muted); font-size: 13px; margin: 0 0 18px;">Coba pilih kategori lain atau reset filter pencarian.</p>
            <a href="<?php echo e(route('products.index')); ?>" style="display: inline-block; padding: 10px 22px; background: var(--accent); color: #fff; text-decoration: none; border-radius: 999px; font-size: 12px; font-weight: 700;">Lihat Semua Koleksi</a>
        </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/products/index.blade.php ENDPATH**/ ?>