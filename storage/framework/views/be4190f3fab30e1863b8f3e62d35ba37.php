<?php $__env->startSection('content'); ?>
<?php
    $existingImages = is_array($product->images)
        ? $product->images
        : (json_decode($product->images ?? '[]', true) ?: []);
    $existingImages = array_values(array_filter($existingImages, fn($p) => is_string($p) && trim($p) !== ''));
?>

<style>
    .pm-wrap {
        background: #ffffff;
        padding: 24px;
        border-radius: 16px;
        max-width: 780px;
        border: 1px solid #f2d8e6;
        box-shadow: 0 8px 24px rgba(212, 75, 141, 0.06);
    }
    .pm-group { margin-bottom: 18px; }
    .pm-label { display: block; margin-bottom: 7px; font-weight: 700; font-size: 13.5px; color: #261c22; }
    .pm-hint { display: block; font-size: 12px; color: #7c6b73; margin-top: 5px; }
    .pm-input, .pm-select, .pm-textarea {
        width: 100%;
        padding: 11px 13px;
        border: 1.5px solid #ead4e0;
        border-radius: 10px;
        font-size: 14px;
        color: #261c22;
        background: #fffcfd;
        box-sizing: border-box;
    }
    .pm-row-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
    .pm-box-old {
        border: 1.5px solid #f0d3e2;
        background: #fffbfd;
        border-radius: 12px;
        padding: 14px;
    }
    .pm-drop {
        border: 1.5px dashed #e39bc0;
        background: #fff7fb;
        border-radius: 12px;
        padding: 14px;
    }
    .pm-pick-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        background: #ffffff;
        border: 1.5px solid #ead4e0;
        border-radius: 10px;
        padding: 8px 10px;
    }
    .pm-pick-row input[type="file"] {
        flex: 1;
        min-width: 180px;
        border: none;
        padding: 4px;
        background: transparent;
    }
    .pm-add-more-btn {
        background: linear-gradient(135deg, #ec6ca8 0%, #d44b8d 100%);
        color: #ffffff;
        border: none;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
    }
    .pm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(98px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }
    .pm-existing-card {
        border: 1.5px solid #f0c9dd;
        border-radius: 10px;
        padding: 6px;
        background: #fff;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .pm-existing-card.marked-delete {
        border-color: #fda4af;
        background: #fff1f2;
        opacity: 0.72;
    }
    .pm-existing-thumb {
        position: relative;
        aspect-ratio: 9 / 16;
        border-radius: 7px;
        overflow: hidden;
        background: #141013;
    }
    .pm-existing-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .pm-del-check {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        font-weight: 700;
        color: #be123c;
        cursor: pointer;
        user-select: none;
    }
    .pm-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    .pm-counter { font-size: 12.5px; font-weight: 700; color: #9e2f68; }
    .pm-clear-btn {
        background: #ffe4e6;
        color: #be123c;
        border: 1px solid #fda4af;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .pm-mini-btn {
        background: #fff0f7;
        color: #9e2f68;
        border: 1px solid #f2b4d3;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .pm-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(88px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }
    .pm-thumb {
        position: relative;
        aspect-ratio: 9 / 16;
        border-radius: 10px;
        overflow: hidden;
        border: 1.5px solid #f0c9dd;
        background: #141013;
    }
    .pm-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .pm-thumb-tag {
        position: absolute;
        left: 4px;
        bottom: 4px;
        background: rgba(20, 16, 19, 0.78);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 6px;
    }
    .pm-remove-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 20px;
        height: 20px;
        border-radius: 999px;
        border: none;
        background: rgba(190, 18, 60, 0.92);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        line-height: 1;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .pm-submit {
        background: linear-gradient(135deg, #ec6ca8 0%, #d44b8d 100%);
        color: #fff;
        padding: 14px 24px;
        border: none;
        border-radius: 11px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        width: 100%;
    }
    @media (max-width: 640px) {
        .pm-row-3 { grid-template-columns: 1fr; }
        .pm-wrap { padding: 16px; }
    }
</style>

<div class="header">
    <h1>Edit Produk</h1>
    <a href="<?php echo e(route('admin.dashboard')); ?>" style="color: #666; text-decoration: none; font-weight: 600;">&larr; Kembali</a>
</div>

<div class="pm-wrap">
    <?php if($errors->any()): ?>
        <div style="background: #ffe4e6; color: #9f1239; border: 1px solid #fda4af; padding: 12px 14px; border-radius: 10px; margin-bottom: 16px; font-size: 13px;">
            <ul style="margin: 0; padding-left: 18px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="pm-group">
            <label class="pm-label">Nama Produk</label>
            <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required class="pm-input">
        </div>

        <div class="pm-row-3 pm-group">
            <div>
                <label class="pm-label">Harga</label>
                <input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" required class="pm-input" min="0">
            </div>
            <div>
                <label class="pm-label">Stok</label>
                <input type="number" name="stock" value="<?php echo e(old('stock', $product->stock)); ?>" required class="pm-input" min="0">
            </div>
            <div>
                <label class="pm-label">Kategori</label>
                <select name="category_id" required class="pm-select">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $product->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="pm-group">
            <label class="pm-label">Deskripsi</label>
            <textarea name="description" rows="4" required class="pm-textarea"><?php echo e(old('description', $product->description)); ?></textarea>
        </div>

        <div class="pm-group">
            <label class="pm-label">Foto Slide Saat Ini (<?php echo e(count($existingImages)); ?> Foto Tersimpan)</label>
            <div class="pm-box-old">
                <?php if(!empty($existingImages)): ?>
                    <div class="pm-toolbar" style="margin-top:0; margin-bottom:8px;">
                        <span id="oldDeleteSummary" class="pm-counter">Centang "Hapus" pada foto yang ingin dihapus saat simpan</span>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            <button type="button" id="checkAllDeleteBtn" class="pm-clear-btn">Pilih Semua Hapus</button>
                            <button type="button" id="uncheckAllDeleteBtn" class="pm-mini-btn">Batal Centang</button>
                        </div>
                    </div>
                    <div class="pm-grid">
                        <?php $__currentLoopData = $existingImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $imgPath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $clean = ltrim($imgPath, '/');
                                $imgUrl = (str_starts_with($clean, 'storage/') || str_starts_with($clean, 'images/'))
                                    ? asset($clean)
                                    : asset('storage/' . $clean);
                            ?>
                            <div class="pm-existing-card" data-old-card>
                                <div class="pm-existing-thumb">
                                    <img src="<?php echo e($imgUrl); ?>" alt="Slide <?php echo e($idx + 1); ?>">
                                    <span class="pm-thumb-tag">#<?php echo e($idx + 1); ?></span>
                                </div>
                                <label class="pm-del-check">
                                    <input type="checkbox" class="old-del-checkbox" name="delete_images[]" value="<?php echo e($imgPath); ?>">
                                    <span>Hapus</span>
                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="font-size:12.5px; color:#7c6b73;">Belum ada foto varian yang tersimpan di produk ini.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="pm-group">
            <label class="pm-label">Tambah Foto Varian Warna (Bisa Sekaligus atau Klik Tambah Foto Lagi)</label>
            <div class="pm-drop">
                <div class="pm-pick-row">
                    <input type="file" id="editImagesInput" name="images[]" multiple accept="image/*">
                    <button type="button" id="editAddMoreBtn" class="pm-add-more-btn">+ Tambah Foto Lagi</button>
                </div>
                <div class="pm-toolbar">
                    <span id="editImagesCounter" class="pm-counter">0 foto baru dipilih</span>
                    <button type="button" id="editClearImages" class="pm-clear-btn" style="display:none;">Hapus Pilihan Baru</button>
                </div>
                <span class="pm-hint">Pilih banyak file sekaligus (tahan <strong>Ctrl</strong> / <strong>Shift</strong>) atau klik tombol pink <strong>+ Tambah Foto Lagi</strong> di sebelah kotak file untuk menambah foto ke daftar di bawah.</span>
                <label style="display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; font-size: 12px; font-weight: 700; color: #5c4d55; cursor: pointer;">
                    <input type="checkbox" name="replace_images" value="1">
                    <span>Timpa semua foto lama dengan foto baru yang diupload</span>
                </label>
                <div id="editImagesPreview" class="pm-preview-grid"></div>
            </div>
        </div>

        <div class="pm-group" style="margin-bottom: 24px;">
            <label class="pm-label">Ganti 1 Video Produk (Opsional, Tampil di Slide Pertama)</label>
            <div class="pm-drop">
                <?php if(!empty($product->video)): ?>
                    <div style="font-size: 12px; color: #15803d; font-weight: 700; margin-bottom: 6px;">
                        Video aktif saat ini sudah terpasang. Pilih file baru di bawah jika ingin menggantinya.
                    </div>
                <?php endif; ?>
                <input type="file" id="editVideoInput" name="video" accept="video/*" class="pm-input" style="background:#fff;">
                <div id="editVideoInfo" class="pm-hint" style="font-weight: 700; color: #b83777;"></div>
            </div>
        </div>

        <button type="submit" class="pm-submit">Simpan Perubahan</button>
    </form>
</div>

<script>
(function () {
    const imgInput = document.getElementById('editImagesInput');
    const addMoreBtn = document.getElementById('editAddMoreBtn');
    const preview = document.getElementById('editImagesPreview');
    const counter = document.getElementById('editImagesCounter');
    const clearBtn = document.getElementById('editClearImages');
    const vidInput = document.getElementById('editVideoInput');
    const vidInfo = document.getElementById('editVideoInfo');

    const oldBoxes = Array.from(document.querySelectorAll('.old-del-checkbox'));
    const oldSummary = document.getElementById('oldDeleteSummary');
    const checkAllBtn = document.getElementById('checkAllDeleteBtn');
    const uncheckAllBtn = document.getElementById('uncheckAllDeleteBtn');

    function syncOldDeleteUI() {
        let marked = 0;
        oldBoxes.forEach(cb => {
            const card = cb.closest('[data-old-card]');
            if (card) card.classList.toggle('marked-delete', cb.checked);
            if (cb.checked) marked++;
        });
        if (oldSummary) {
            oldSummary.textContent = marked > 0
                ? (marked + ' foto lama akan dihapus saat klik Simpan Perubahan')
                : 'Centang "Hapus" pada foto yang ingin dihapus saat simpan';
        }
    }

    oldBoxes.forEach(cb => cb.addEventListener('change', syncOldDeleteUI));
    if (checkAllBtn) {
        checkAllBtn.addEventListener('click', () => {
            oldBoxes.forEach(cb => { cb.checked = true; });
            syncOldDeleteUI();
        });
    }
    if (uncheckAllBtn) {
        uncheckAllBtn.addEventListener('click', () => {
            oldBoxes.forEach(cb => { cb.checked = false; });
            syncOldDeleteUI();
        });
    }
    syncOldDeleteUI();

    const dt = new DataTransfer();

    function renderQueue() {
        preview.innerHTML = '';
        const files = Array.from(dt.files);
        if (counter) counter.textContent = files.length + ' foto baru dipilih';
        if (clearBtn) clearBtn.style.display = files.length ? 'inline-block' : 'none';

        files.forEach((file, idx) => {
            const url = URL.createObjectURL(file);
            const box = document.createElement('div');
            box.className = 'pm-thumb';

            const img = document.createElement('img');
            img.src = url;
            img.alt = 'Baru ' + (idx + 1);
            img.onload = () => URL.revokeObjectURL(url);

            const tag = document.createElement('span');
            tag.className = 'pm-thumb-tag';
            tag.textContent = 'Baru ' + (idx + 1);

            const rm = document.createElement('button');
            rm.type = 'button';
            rm.className = 'pm-remove-btn';
            rm.title = 'Hapus foto ini';
            rm.innerHTML = '&times;';
            rm.addEventListener('click', function () {
                const next = new DataTransfer();
                Array.from(dt.files).forEach((f, i) => {
                    if (i !== idx) next.items.add(f);
                });
                dt.items.clear();
                Array.from(next.files).forEach(f => dt.items.add(f));
                imgInput.files = dt.files;
                renderQueue();
            });

            box.appendChild(img);
            box.appendChild(tag);
            box.appendChild(rm);
            preview.appendChild(box);
        });
    }

    if (addMoreBtn && imgInput) {
        addMoreBtn.addEventListener('click', () => imgInput.click());
    }

    if (imgInput) {
        imgInput.addEventListener('change', function () {
            const incoming = Array.from(this.files || []);
            incoming.forEach(file => {
                const exists = Array.from(dt.files).some(
                    existing => existing.name === file.name && existing.size === file.size && existing.lastModified === file.lastModified
                );
                if (!exists) dt.items.add(file);
            });
            this.files = dt.files;
            renderQueue();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            dt.items.clear();
            imgInput.files = dt.files;
            renderQueue();
        });
    }

    if (vidInput && vidInfo) {
        vidInput.addEventListener('change', function () {
            const f = this.files && this.files[0];
            vidInfo.textContent = f ? ('Video baru terpilih: ' + f.name) : '';
        });
    }
})();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/admin/edit.blade.php ENDPATH**/ ?>