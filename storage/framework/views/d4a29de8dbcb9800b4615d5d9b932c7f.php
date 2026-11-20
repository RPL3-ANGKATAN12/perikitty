<?php $__env->startSection('title', 'Kategori - Perikitty Olshop'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $categories = \App\Models\Category::all()->map(function ($c) {
        $c->products_count = \App\Models\Product::where('category_id', $c->id)->count();
        return $c;
    });
?>

<style>
    .cat-page {
        padding: clamp(24px, 4vw, 52px) clamp(16px, 5vw, 8%);
        background: radial-gradient(circle at top right, #fff2f8 0%, #ffffff 48%, #fffaf7 100%);
        min-height: 75vh;
    }
    .cat-wrap {
        max-width: 1040px;
        margin: 0 auto;
    }
    .cat-head {
        text-align: center;
        margin-bottom: clamp(24px, 3.5vw, 38px);
    }
    .cat-pill-top {
        display: inline-block;
        background: #ffe3f0;
        color: #b83777;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        margin-bottom: 10px;
    }
    .cat-title {
        margin: 0 0 8px;
        font-size: clamp(26px, 3.4vw, 38px);
        font-family: 'Playfair Display', serif;
        color: var(--text, #261c22);
    }
    .cat-sub {
        margin: 0 auto;
        max-width: 500px;
        font-size: 13.5px;
        color: var(--text-muted, #6b5b63);
        line-height: 1.5;
    }
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 16px;
    }
    .cat-card {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 14px;
        text-decoration: none;
        background: #ffffff;
        border: 1px solid #f2d8e6;
        border-radius: 16px;
        padding: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        overflow: hidden;
    }
    .cat-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 3px;
        background: linear-gradient(90deg, #f39ac6, #d44b8d);
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .cat-card:hover {
        transform: translateY(-3px);
        border-color: #e38bb8;
        box-shadow: 0 12px 24px rgba(212, 75, 141, 0.1);
    }
    .cat-card:hover::before {
        opacity: 1;
    }
    .cat-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .cat-thumb {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        overflow: hidden;
        background: #fff3f9;
        border: 1px solid #f7dce9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .cat-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .cat-count {
        font-size: 11.5px;
        font-weight: 700;
        color: #9e2f68;
        background: #fff0f7;
        border: 1px solid #f6d2e4;
        padding: 4px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }
    .cat-name {
        margin: 0;
        font-size: 16px;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--text, #261c22);
        line-height: 1.25;
    }
    .cat-cta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        color: var(--accent, #d44b8d);
    }
    @media (max-width: 600px) {
        .cat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
        .cat-card {
            padding: 13px;
            border-radius: 14px;
        }
        .cat-thumb {
            width: 44px;
            height: 44px;
        }
        .cat-name {
            font-size: 14.5px;
        }
    }
</style>

<section class="cat-page">
    <div class="cat-wrap">
        <div class="cat-head">
            <span class="cat-pill-top">Eksplorasi Katalog</span>
            <h1 class="cat-title">Semua Kategori</h1>
            <p class="cat-sub">Pilih kategori favoritmu untuk melihat koleksi peralatan dan kebutuhan rumah pilihan.</p>
        </div>

        <div class="cat-grid">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $sampleProd = \App\Models\Product::where('category_id', $cat->id)->latest()->first();
                    $catImg = asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg');
                    if ($sampleProd && !empty($sampleProd->images)) {
                        $dec = is_array($sampleProd->images) ? $sampleProd->images : json_decode($sampleProd->images, true);
                        if (is_array($dec) && !empty($dec[0])) {
                            $p = ltrim(trim((string) $dec[0]), '/');
                            $catImg = (str_starts_with($p, 'storage/') || str_starts_with($p, 'images/')) ? asset($p) : asset('storage/' . $p);
                        }
                    }
                ?>
                <a href="<?php echo e(route('products.index')); ?>?category=<?php echo e($cat->id); ?>" class="cat-card">
                    <div class="cat-top-row">
                        <div class="cat-thumb">
                            <img src="<?php echo e($catImg); ?>" alt="<?php echo e($cat->name); ?>">
                        </div>
                        <span class="cat-count"><?php echo e($cat->products_count ?? 0); ?> Produk</span>
                    </div>
                    <div>
                        <h2 class="cat-name"><?php echo e($cat->name); ?></h2>
                        <span class="cat-cta">Lihat Koleksi &rarr;</span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 48px; color: var(--text-muted);">
                    Belum ada kategori tersedia.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/categories/index.blade.php ENDPATH**/ ?>