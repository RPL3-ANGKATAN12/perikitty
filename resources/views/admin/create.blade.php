@extends('layouts.admin')
@section('content')
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
    <h1>Tambah Produk Baru</h1>
    <a href="{{ route('admin.dashboard') }}" style="color: #666; text-decoration: none; font-weight: 600;">&larr; Kembali</a>
</div>

<div class="pm-wrap">
    @if ($errors->any())
        <div style="background: #ffe4e6; color: #9f1239; border: 1px solid #fda4af; padding: 12px 14px; border-radius: 10px; margin-bottom: 16px; font-size: 13px;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pm-group">
            <label class="pm-label">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="pm-input" placeholder="Contoh: Baju Tidur Sutra">
        </div>

        <div class="pm-row-3 pm-group">
            <div>
                <label class="pm-label">Harga</label>
                <input type="number" name="price" value="{{ old('price') }}" required class="pm-input" min="0">
            </div>
            <div>
                <label class="pm-label">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required class="pm-input" min="0">
            </div>
            <div>
                <label class="pm-label">Kategori</label>
                <select name="category_id" required class="pm-select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="pm-group">
            <label class="pm-label">Deskripsi</label>
            <textarea name="description" rows="4" required class="pm-textarea" placeholder="Tulis detail bahan, ukuran, atau pilihan warna...">{{ old('description') }}</textarea>
        </div>

        <div class="pm-group">
            <label class="pm-label">Tambah Foto Varian Warna (Bisa Sekaligus atau Klik Tambah Foto Lagi)</label>
            <div class="pm-drop">
                <div class="pm-pick-row">
                    <input type="file" id="createImagesInput" name="images[]" multiple accept="image/*">
                    <button type="button" id="createAddMoreBtn" class="pm-add-more-btn">+ Tambah Foto Lagi</button>
                </div>
                <div class="pm-toolbar">
                    <span id="createImagesCounter" class="pm-counter">0 foto dipilih</span>
                    <button type="button" id="createClearImages" class="pm-clear-btn" style="display:none;">Hapus Semua Pilihan</button>
                </div>
                <span class="pm-hint">Pilih banyak file sekaligus (tahan <strong>Ctrl</strong> / <strong>Shift</strong>) atau klik <strong>+ Tambah Foto Lagi</strong> untuk menambah foto tanpa menimpa yang sudah ada.</span>
                <div id="createImagesPreview" class="pm-preview-grid"></div>
            </div>
        </div>

        <div class="pm-group" style="margin-bottom: 24px;">
            <label class="pm-label">Upload 1 Video Produk (Opsional, Tampil di Slide Pertama)</label>
            <div class="pm-drop">
                <input type="file" id="createVideoInput" name="video" accept="video/*" class="pm-input" style="background:#fff;">
                <span class="pm-hint">Video akan ditempatkan di slide paling awal sebelum slide foto varian warna.</span>
                <div id="createVideoInfo" class="pm-hint" style="font-weight: 700; color: #b83777;"></div>
            </div>
        </div>

        <button type="submit" class="pm-submit">Simpan Produk</button>
    </form>
</div>

<script>
(function () {
    const imgInput = document.getElementById('createImagesInput');
    const addMoreBtn = document.getElementById('createAddMoreBtn');
    const preview = document.getElementById('createImagesPreview');
    const counter = document.getElementById('createImagesCounter');
    const clearBtn = document.getElementById('createClearImages');
    const vidInput = document.getElementById('createVideoInput');
    const vidInfo = document.getElementById('createVideoInfo');

    const dt = new DataTransfer();

    function renderQueue() {
        preview.innerHTML = '';
        const files = Array.from(dt.files);
        if (counter) counter.textContent = files.length + ' foto dipilih';
        if (clearBtn) clearBtn.style.display = files.length ? 'inline-block' : 'none';

        files.forEach((file, idx) => {
            const url = URL.createObjectURL(file);
            const box = document.createElement('div');
            box.className = 'pm-thumb';

            const img = document.createElement('img');
            img.src = url;
            img.alt = 'Foto ' + (idx + 1);
            img.onload = () => URL.revokeObjectURL(url);

            const tag = document.createElement('span');
            tag.className = 'pm-thumb-tag';
            tag.textContent = 'Foto ' + (idx + 1);

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
            vidInfo.textContent = f ? ('Video terpilih: ' + f.name) : '';
        });
    }
})();
</script>
@endsection