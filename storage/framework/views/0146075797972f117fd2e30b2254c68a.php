<?php $__env->startSection('title', $product->name); ?>
<?php $__env->startSection('content'); ?>
<?php
    $slides = [];

    if (!empty($product->video)) {
        $vidPath = ltrim(trim((string) $product->video), '/');
        $vidUrl = str_starts_with($vidPath, 'storage/') ? asset($vidPath) : asset('storage/' . $vidPath);
        $slides[] = [
            'type' => 'video',
            'src' => $vidUrl,
            'thumb' => asset('images/produk1.jpg'),
            'label' => 'VID',
        ];
    }

    $photoUrls = [];
    if (!empty($product->images)) {
        $decoded = is_array($product->images) ? $product->images : json_decode($product->images, true);
        if (is_array($decoded)) {
            foreach ($decoded as $item) {
                if (is_string($item) && trim($item) !== '') {
                    $trimmed = ltrim(trim($item), '/');
                    $photoUrls[] = str_starts_with($trimmed, 'storage/') || str_starts_with($trimmed, 'images/')
                        ? asset($trimmed)
                        : asset('storage/' . $trimmed);
                }
            }
        }
    }
    if (empty($photoUrls)) {
        $photoUrls[] = asset('images/produk1.jpg');
    }
    $photoUrls = array_values(array_unique($photoUrls));

    if (!empty($product->video)) {
        $slides[0]['thumb'] = $photoUrls[0];
    }

    foreach ($photoUrls as $idx => $pUrl) {
        $slides[] = [
            'type' => 'image',
            'src' => $pUrl,
            'thumb' => $pUrl,
            'label' => (string) ($idx + 1),
        ];
    }

    $rawDesc = str_replace(["\r\n", "\r"], "\n", (string) $product->description);
    $lines = explode("\n", $rawDesc);
    $descItems = [];
    foreach ($lines as $line) {
        $t = trim($line);
        if ($t === '') {
            $descItems[] = ['type' => 'spacer'];
            continue;
        }
        if (preg_match('/^[-*ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¢]\s+(.+)$/u', $t, $m)) {
            $descItems[] = ['type' => 'bullet', 'text' => $m[1]];
        } else {
            $descItems[] = ['type' => 'line', 'text' => $t];
        }
    }
    while (!empty($descItems) && end($descItems)['type'] === 'spacer') {
        array_pop($descItems);
    }
?>

<style>
    .sp-page {
        padding: clamp(10px, 2vw, 20px) clamp(14px, 4vw, 6%);
        background: #f8f6f7;
        min-height: 70vh;
    }
    .sp-wrap {
        max-width: 820px;
        margin: 0 auto;
    }
    .sp-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-muted, #6b5b63);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 14px;
    }
    .sp-back:hover {
        color: var(--accent, #d44b8d);
    }
    .sp-card {
        background: #ffffff;
        border: 1px solid var(--border, #f0dce7);
        border-radius: 16px;
        padding: clamp(12px, 2vw, 18px);
        display: grid;
        grid-template-columns: minmax(0, 220px) minmax(0, 480px);
        justify-content: center;
        gap: clamp(16px, 3vw, 26px);
        align-items: start;
    }
    .sp-media {
        min-width: 0;
        max-width: 220px;
        width: 100%;
        justify-self: center;
    }
    .sp-stage {
        position: relative;
        width: 100%;
        aspect-ratio: 9 / 16;
        max-height: 360px;
        background: #141013;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid var(--border, #ead4e0);
        touch-action: pan-y pinch-zoom;
    }
    .sp-slide-media {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
        user-select: none;
    }
    .sp-slide-media.active {
        display: block;
    }
    .sp-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        border-radius: 999px;
        border: none;
        background: rgba(20, 16, 19, 0.55);
        color: #ffffff;
        font-size: 18px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
    }
    .sp-arrow:hover {
        background: rgba(20, 16, 19, 0.8);
    }
    .sp-arrow.prev { left: 8px; }
    .sp-arrow.next { right: 8px; }
    .sp-badge {
        position: absolute;
        right: 8px;
        bottom: 8px;
        background: rgba(20, 16, 19, 0.72);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 999px;
        z-index: 2;
    }
    .sp-dots {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 8px;
        flex-wrap: wrap;
    }
    .sp-dot {
        width: 6px;
        height: 6px;
        border-radius: 999px;
        border: none;
        padding: 0;
        background: #e3cbd8;
        cursor: pointer;
    }
    .sp-dot.active {
        width: 16px;
        background: var(--accent, #d44b8d);
    }
    .sp-thumbs {
        display: flex;
        gap: 6px;
        margin-top: 8px;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: thin;
    }
    .sp-thumb {
        position: relative;
        flex: 0 0 46px;
        width: 46px;
        aspect-ratio: 9 / 16;
        border-radius: 7px;
        overflow: hidden;
        padding: 0;
        border: 2px solid transparent;
        background: #141013;
        cursor: pointer;
    }
    .sp-thumb.active {
        border-color: var(--accent, #d44b8d);
    }
    .sp-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .sp-thumb-vid {
        position: absolute;
        left: 2px;
        bottom: 2px;
        background: rgba(212, 75, 141, 0.92);
        color: #ffffff;
        font-size: 8px;
        font-weight: 800;
        padding: 1px 3px;
        border-radius: 3px;
        letter-spacing: 0.2px;
    }
    .sp-info {
        min-width: 0;
        max-width: 480px;
        width: 100%;
    }
    .sp-title {
        margin: 0 0 6px;
        font-size: clamp(17px, 1.9vw, 21px);
        font-family: 'Playfair Display', serif;
        color: var(--text, #261c22);
        line-height: 1.2;
    }
    .sp-price-box {
        background: #fff5f9;
        border: 1px solid #f7dce9;
        border-radius: 8px;
        padding: 7px 11px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
    }
    .sp-price {
        font-size: clamp(16px, 1.8vw, 19px);
        color: var(--accent, #d44b8d);
        font-weight: 800;
    }
    .sp-stock {
        font-size: 12.5px;
        color: var(--text-muted, #6b5b63);
        font-weight: 600;
    }
    .sp-desc-box {
        border: 1px solid var(--border, #f0dce7);
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 12px;
        background: #ffffff;
    }
    .sp-desc-label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--text, #261c22);
        margin-bottom: 6px;
        padding-bottom: 5px;
        border-bottom: 1px solid #f5e6ee;
    }
    .sp-desc-body {
        font-size: 12.5px;
        line-height: 1.38;
        color: #4a3d44;
    }
    .sp-desc-line {
        margin: 0 0 3px;
    }
    .sp-desc-spacer {
        height: 4px;
    }
    .sp-desc-bullet {
        position: relative;
        padding-left: 12px;
        margin: 0 0 2px;
    }
    .sp-desc-bullet::before {
        content: "ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¢";
        position: absolute;
        left: 2px;
        color: var(--accent, #d44b8d);
        font-weight: 800;
    }
    .sp-add-btn {
        width: 100%;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 700;
        border-radius: 9px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .sp-card {
            grid-template-columns: 1fr;
            justify-content: stretch;
            gap: 16px;
            padding: 14px;
        }
        .sp-media {
            max-width: 205px;
        }
        .sp-stage {
            max-height: 330px;
        }
        .sp-info {
            max-width: 100%;
        }
    }
        .sp-media {
        min-width: 0;
        max-width: 220px;
        width: 100%;
        justify-self: center;
    }
        .sp-stage {
        position: relative;
        width: 100%;
        aspect-ratio: 9 / 16;
        max-height: 360px;
        background: #141013;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid var(--border, #ead4e0);
        touch-action: pan-y pinch-zoom;
    }
    }
</style>

<section class="sp-page">
    <div class="sp-wrap">
        <a href="<?php echo e(route('products.index')); ?>" class="sp-back">&larr; Kembali ke Koleksi</a>

        <div class="sp-card">
            <div class="sp-media">
                <div class="sp-stage" id="spStage">
                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($slide['type'] === 'video'): ?>
                            <video
                                class="sp-slide-media <?php echo e($idx === 0 ? 'active' : ''); ?>"
                                data-index="<?php echo e($idx); ?>"
                                src="<?php echo e($slide['src']); ?>"
                                controls
                                playsinline
                                preload="metadata"></video>
                        <?php else: ?>
                            <img
                                class="sp-slide-media <?php echo e($idx === 0 ? 'active' : ''); ?>"
                                data-index="<?php echo e($idx); ?>"
                                src="<?php echo e($slide['src']); ?>"
                                alt="<?php echo e($product->name); ?> - <?php echo e($slide['label']); ?>">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(count($slides) > 1): ?>
                        <button type="button" class="sp-arrow prev" id="spPrev" aria-label="Slide sebelumnya">&lsaquo;</button>
                        <button type="button" class="sp-arrow next" id="spNext" aria-label="Slide berikutnya">&rsaquo;</button>
                        <span class="sp-badge" id="spBadge">
                            <?php echo e($slides[0]['type'] === 'video' ? 'Video' : '1'); ?> / <?php echo e(count($slides)); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <?php if(count($slides) > 1): ?>
                    <div class="sp-dots" id="spDots">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="sp-dot <?php echo e($idx === 0 ? 'active' : ''); ?>" data-index="<?php echo e($idx); ?>" aria-label="Slide <?php echo e($idx + 1); ?>"></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="sp-thumbs" id="spThumbs">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="sp-thumb <?php echo e($idx === 0 ? 'active' : ''); ?>" data-index="<?php echo e($idx); ?>">
                                <img src="<?php echo e($s['thumb']); ?>" alt="Thumb <?php echo e($idx + 1); ?>">
                                <?php if($s['type'] === 'video'): ?>
                                    <span class="sp-thumb-vid">VID</span>
                                <?php endif; ?>
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="sp-info">
                <h1 class="sp-title"><?php echo e($product->name); ?></h1>

                <div class="sp-price-box">
                    <span class="sp-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                    <span class="sp-stock">Stok: <?php echo e($product->stock); ?></span>
                </div>

                <div class="sp-desc-box">
                    <div class="sp-desc-label">Deskripsi Produk</div>
                    <div class="sp-desc-body">
                        <?php $__currentLoopData = $descItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item['type'] === 'spacer'): ?>
                                <div class="sp-desc-spacer"></div>
                            <?php elseif($item['type'] === 'bullet'): ?>
                                <div class="sp-desc-bullet"><?php echo e($item['text']); ?></div>
                            <?php else: ?>
                                <div class="sp-desc-line"><?php echo e($item['text']); ?></div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary sp-add-btn">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    const slidesMeta = <?php echo json_encode(array_map(fn($s) => ['type' => $s['type']], $slides), 512) ?>;
    if (!slidesMeta.length) return;

    let current = 0;
    const mediaEls = Array.from(document.querySelectorAll('#spStage .sp-slide-media'));
    const badge = document.getElementById('spBadge');
    const dots = Array.from(document.querySelectorAll('#spDots .sp-dot'));
    const thumbs = Array.from(document.querySelectorAll('#spThumbs .sp-thumb'));
    const prevBtn = document.getElementById('spPrev');
    const nextBtn = document.getElementById('spNext');
    const stage = document.getElementById('spStage');

    function goTo(index) {
        const total = mediaEls.length;
        current = ((index % total) + total) % total;

        mediaEls.forEach((el, i) => {
            const isActive = i === current;
            el.classList.toggle('active', isActive);
            if (!isActive && el.tagName === 'VIDEO' && typeof el.pause === 'function') {
                el.pause();
            }
        });

        if (badge) {
            const prefix = slidesMeta[current] && slidesMeta[current].type === 'video' ? 'Video' : String(current + 1);
            badge.textContent = prefix + ' / ' + total;
        }

        dots.forEach((d, i) => d.classList.toggle('active', i === current));
        thumbs.forEach((t, i) => {
            const active = i === current;
            t.classList.toggle('active', active);
            if (active) {
                t.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        });
    }

    if (prevBtn) prevBtn.addEventListener('click', () => goTo(current - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => goTo(current + 1));

    dots.forEach(dot => {
        dot.addEventListener('click', () => goTo(Number(dot.dataset.index || 0)));
    });

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => goTo(Number(thumb.dataset.index || 0)));
    });

    if (stage && mediaEls.length > 1) {
        let sx = 0;
        let sy = 0;
        stage.addEventListener('touchstart', (e) => {
            if (!e.touches || !e.touches.length) return;
            sx = e.touches[0].clientX;
            sy = e.touches[0].clientY;
        }, { passive: true });

        stage.addEventListener('touchend', (e) => {
            if (!e.changedTouches || !e.changedTouches.length) return;
            const dx = e.changedTouches[0].clientX - sx;
            const dy = e.changedTouches[0].clientY - sy;
            if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
                if (dx < 0) goTo(current + 1);
                else goTo(current - 1);
            }
        }, { passive: true });
    }
})();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/products/show.blade.php ENDPATH**/ ?>