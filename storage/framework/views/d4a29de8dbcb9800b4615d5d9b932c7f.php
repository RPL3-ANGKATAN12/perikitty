<?php $__env->startSection('title', 'Semua Kategori - Perikitty'); ?>
<?php $__env->startSection('content'); ?>

<?php
    $allCategories = $categories ?? \App\Models\Category::orderBy('id')->get();
    $allProducts = \App\Models\Product::latest()->get();
    $productsByCat = $allProducts->groupBy('category_id');
?>

<section style="padding: 48px 7% 68px; min-height: 75vh; background: linear-gradient(180deg, #fff6fa 0%, #fffdfd 60%, #ffffff 100%);">
    <div style="text-align: center; max-width: 620px; margin: 0 auto 38px;">
        <span style="display: inline-block; background: #fce7f1; color: var(--accent); border: 1px solid #f4c6db; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 5px 14px; border-radius: 999px; margin-bottom: 12px;">Direktori Kategori</span>
        <h1 style="font-size: clamp(28px, 3.5vw, 38px); font-family: 'Playfair Display', serif; color: var(--text); margin: 0 0 8px; font-weight: 700;">Kategori Produk</h1>
        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin: 0;">Telusuri tiap kategori pilihan lalu klik untuk melihat produk di dalamnya pada halaman Koleksi.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; max-width: 1140px; margin: 0 auto;">
        <?php $__empty_1 = true; $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $nameLower = strtolower($cat->name);
            $badgeMark = 'PK';
            if (str_contains($nameLower, 'dapur')) { $badgeMark = 'DP'; }
            elseif (str_contains($nameLower, 'rumah') || str_contains($nameLower, 'perabot')) { $badgeMark = 'RM'; }
            elseif (str_contains($nameLower, 'fashion') || str_contains($nameLower, 'pakaian')) { $badgeMark = 'FS'; }
            elseif (str_contains($nameLower, 'perawatan') || str_contains($nameLower, 'diri')) { $badgeMark = 'SK'; }
            elseif (str_contains($nameLower, 'sendal') || str_contains($nameLower, 'aksesoris')) { $badgeMark = 'AK'; }
            elseif (str_contains($nameLower, 'tumbler') || str_contains($nameLower, 'botol') || str_contains($nameLower, 'minum')) { $badgeMark = 'DR'; }

            $catProducts = $productsByCat->get($cat->id, collect());
            $count = $catProducts->count();
            $sampleNames = $catProducts->pluck('name')->take(3)->implode(', ');
        ?>
        <a href="<?php echo e(route('products.index')); ?>?category=<?php echo e($cat->id); ?>" style="text-decoration: none; display: block;">
            <div style="background: #ffffff; border: 1px solid #f0dbe5; border-radius: 16px; padding: 20px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; gap: 16px; transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease; box-shadow: 0 6px 18px rgba(216, 91, 155, 0.05);"
                 onmouseover="this.style.transform='translateY(-3px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 12px 24px rgba(216, 91, 155, 0.12)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f0dbe5'; this.style.boxShadow='0 6px 18px rgba(216, 91, 155, 0.05)';">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px;">
                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #fdf0f6; border: 1px solid #f4c6db; color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800; letter-spacing: 0.5px;">
                            <?php echo e($badgeMark); ?>

                        </div>
                        <span style="background: #faf7f9; color: var(--text); border: 1px solid var(--border); font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 999px;">
                            <?php echo e($count); ?> Produk
                        </span>
                    </div>
                    <h2 style="font-size: 18px; font-family: 'Playfair Display', serif; font-weight: 700; color: var(--text); margin: 0 0 6px; line-height: 1.3;"><?php echo e($cat->name); ?></h2>
                    <p style="font-size: 12px; color: var(--text-muted); line-height: 1.5; margin: 0;">
                        <?php echo e($sampleNames !== '' ? 'Termasuk: ' . $sampleNames : 'Belum ada produk terdaftar di kategori ini.'); ?>

                    </p>
                </div>
                <div style="padding-top: 10px; border-top: 1px solid #f7edf2; display: flex; align-items: center; justify-content: space-between; font-size: 12px; font-weight: 700; color: var(--accent);">
                    <span>Buka Koleksi</span>
                    <span>&rarr;</span>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #fff; border: 1px solid var(--border); border-radius: 16px;">
            <p style="color: var(--text-muted); margin: 0;">Belum ada kategori yang tersedia.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/categories/index.blade.php ENDPATH**/ ?>