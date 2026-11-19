<?php $__env->startSection('title', 'Beranda - Perikitty'); ?>
<?php $__env->startSection('content'); ?>


<section style="padding: 60px 8%; background: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 40px; min-height: 60vh;">
    <div style="flex: 1; max-width: 500px;">
        <p style="color: var(--accent); font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 16px;">Perikitty Olshop 2026</p>
        <h1 style="font-size: clamp(36px, 4vw, 56px); line-height: 1.1; margin-bottom: 20px; font-family: 'Playfair Display', serif; color: var(--text); font-weight: 600;">Sentuhan Elegan <br><span style="font-style: italic; color: var(--accent);">untuk Rumahmu</span></h1>
        <p style="color: var(--text-muted); margin-bottom: 30px; font-size: 15px; line-height: 1.7;">Peralatan rumah tangga pilihan dengan desain abadi yang memadukan fungsi dan estetika.</p>
        <a href="<?php echo e(route('products.index')); ?>" style="display: inline-block; padding: 14px 32px; background: var(--text); color: #fff; text-decoration: none; font-size: 12px; letter-spacing: 2px; text-transform: uppercase;">Belanja Sekarang</a>
    </div>
    <div style="flex: 1; display: flex; justify-content: flex-end;">
        <div style="width: 100%; max-width: 350px; height: 350px; background: #fdf2f8; display: flex; align-items: center; justify-content: center; font-size: 100px; position: relative;">🏺<div style="position: absolute; top: -15px; right: -15px; width: 100%; height: 100%; border: 1px solid var(--gold); z-index: -1;"></div></div>
    </div>
</section>


<div style="background: var(--surface); padding: 16px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); overflow: hidden; white-space: nowrap;">
    <div style="display: inline-block; animation: marquee 25s linear infinite; font-family: 'Playfair Display', serif; font-size: 20px; color: var(--text-muted); font-style: italic;">
        <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span style="margin: 0 30px;">✦ <?php echo e($cat->name); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span style="margin: 0 30px;">✦ <?php echo e($cat->name); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<style>@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }</style>


<section style="padding: 60px 8%; background: #ffffff;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <h2 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text);">Pilihan Terbaik</h2>
        <a href="<?php echo e(route('products.index')); ?>" style="color: var(--accent); font-size: 13px; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--accent); padding-bottom: 2px;">Lihat Semua</a>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px;">
        <?php $__currentLoopData = \App\Models\Product::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="text-align: left;">
            <div style="height: 220px; background: #faf7f9; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; font-size: 60px; border-radius: 8px; overflow: hidden;">
                
                <?php if($product->images): ?>
                    <img src="<?php echo e(asset('storage/' . json_decode($product->images)[0])); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg')); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php endif; ?>
            </div>
            <h3 style="font-size: 16px; font-family: 'Playfair Display', serif; font-weight: 600; margin-bottom: 4px; color: var(--text);"><?php echo e($product->name); ?></h3>
            <p style="color: var(--text); font-weight: 700; font-size: 14px;">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
            <a href="<?php echo e(route('products.show', $product->id)); ?>" style="display: inline-block; margin-top: 8px; color: var(--text-muted); font-size: 12px; text-decoration: underline;">Lihat Detail</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section style="padding: 60px 8%; background: #faf7f9; border-top: 1px solid var(--border);">
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Jelajahi Kategori</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Temukan perabot yang tepat untuk setiap sudut rumah.</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; max-width: 1000px; margin: auto;">
        <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('products.index')); ?>?category=<?php echo e($cat->id); ?>" style="text-decoration: none; display: block;">
            <div style="background: #ffffff; border: 1px solid var(--border); padding: 24px 16px; border-radius: 12px; text-align: center; transition: 0.3s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <div style="font-size: 30px; margin-bottom: 12px;">📦</div>
                <h3 style="font-size: 15px; font-family: 'Plus Jakarta Sans'; font-weight: 700; color: var(--text); margin: 0;"><?php echo e($cat->name); ?></h3>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section style="padding: 60px 8%; background: #ffffff; text-align: center; border-top: 1px solid var(--border);">
    <a href="<?php echo e(route('about')); ?>" style="text-decoration: none; display: inline-block;">
        <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 16px; border: 3px solid var(--border); box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
            <img src="<?php echo e(asset('images/owner.jpeg')); ?>" alt="Petty Fariana" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <h3 style="font-size: 20px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 4px;">Petty Fariana</h3>
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 16px;">Founder Perikitty Olshop</p>
        <span style="display: inline-block; padding: 10px 24px; border: 1px solid var(--accent); color: var(--accent); border-radius: 100px; font-size: 13px; font-weight: 700; transition: 0.3s;">Kenali Kisah Kami &rarr;</span>
    </a>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/home/index.blade.php ENDPATH**/ ?>