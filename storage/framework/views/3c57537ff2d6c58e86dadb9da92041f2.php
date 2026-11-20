<?php $__env->startSection('title', 'Login - Perikitty'); ?>
<?php $__env->startSection('content'); ?>
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Selamat Datang Kembali</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Silakan masuk ke akun Anda.</p>
    </div>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Masukkan email">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password">
        </div>
        <button type="submit" class="btn">Masuk</button>
        
        <div class="bottom-link">
            Belum punya akun pembeli? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/auth/login.blade.php ENDPATH**/ ?>