<?php $__env->startSection('title', 'Daftar Pembeli - Perikitty'); ?>
<?php $__env->startSection('content'); ?>
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Daftar Akun Pembeli</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Buat akun untuk mulai berbelanja di Perikitty.</p>
    </div>

    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Nama Anda">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="email@contoh.com">
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
            <input type="password" name="password" required placeholder="Minimal 6 karakter">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password">
        </div>
        <button type="submit" class="btn">Daftar Sekarang</button>
        
        <div class="bottom-link">Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk di sini</a></div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/auth/register.blade.php ENDPATH**/ ?>