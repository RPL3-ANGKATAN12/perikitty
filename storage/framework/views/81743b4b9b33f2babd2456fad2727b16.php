
<?php $__env->startSection('content'); ?>

<?php
    $highlightId = session('last_product_id');
    $latestProduct = $highlightId
        ? ($products->firstWhere('id', $highlightId) ?? $products->sortByDesc('updated_at')->first())
        : $products->sortByDesc('updated_at')->first();

    $previewImgs = [];
    if ($latestProduct) {
        if (!empty($latestProduct->images)) {
            $decoded = is_array($latestProduct->images) ? $latestProduct->images : json_decode($latestProduct->images, true);
            if (is_array($decoded)) {
                $previewImgs = array_values(array_filter($decoded));
            }
        }
        if (empty($previewImgs) && !empty($latestProduct->image)) {
            $previewImgs[] = $latestProduct->image;
        }
    }
?>

<?php if($latestProduct): ?>
<div style="margin-bottom: 20px; background: #fff9fc; border: 1.5px solid #f4cde1; border-radius: 18px; padding: 18px 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
        <?php if(!empty($previewImgs)): ?>
            <img src="<?php echo e(asset('storage/' . ltrim($previewImgs[0], '/'))); ?>" alt="<?php echo e($latestProduct->name); ?>"
                style="width: 72px; height: 72px; object-fit: cover; border-radius: 14px; border: 1px solid #f0c9dd; background: #fff;">
        <?php endif; ?>
        <div>
            <div style="display: inline-block; background: #ffe0ef; color: #9e2f68; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 999px; margin-bottom: 5px;">
                <?php echo e($highlightId ? 'BARU DIUPLOAD / DIUBAH' : 'TERAKHIR DIPERBARUI'); ?> &bull; <?php echo e(count($previewImgs)); ?> FOTO
            </div>
            <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #261c22;"><?php echo e($latestProduct->name); ?></h3>
            <p style="margin: 3px 0 0; font-size: 13px; color: #6b5b63;">
                Harga: <strong style="color: #d44b8d;">Rp <?php echo e(number_format($latestProduct->price ?? 0, 0, ',', '.')); ?></strong>
                &bull; Diperbarui: <strong><?php echo e(optional($latestProduct->updated_at)->diffForHumans() ?? 'baru saja'); ?></strong>
            </p>
        </div>
    </div>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="<?php echo e(url('/')); ?>" target="_blank"
            style="background: #ffffff; color: #8c2d5e; border: 1.5px solid #f0c9dd; padding: 9px 15px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px;">
            Cek di Beranda
        </a>
        <a href="<?php echo e(route('products.show', $latestProduct->id)); ?>" target="_blank"
            style="background: #d44b8d; color: #ffffff; padding: 9px 15px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px;">
            Lihat Tampilan Produk
        </a>
    </div>
</div>
<?php endif; ?>
<style>
    .dm-page {
        display: flex;
        flex-direction: column;
        gap: 20px;
        color: #2d2429;
    }
    .dm-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        background: linear-gradient(120deg, #fff5f9 0%, #fffaf7 55%, #ffffff 100%);
        border: 1px solid #f7d8e8;
        padding: 24px 28px;
        border-radius: 20px;
        box-shadow: 0 10px 28px rgba(224, 98, 160, 0.08);
    }
    .dm-badge-top {
        display: inline-block;
        background: #ffe4f1;
        color: #b83b7a;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        margin-bottom: 8px;
    }
    .dm-title {
        margin: 0;
        font-size: 25px;
        font-weight: 800;
        color: #261c22;
    }
    .dm-sub {
        margin: 5px 0 0;
        font-size: 13.5px;
        color: #6b5b63;
    }
    .dm-hero-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .dm-btn-csv {
        background: #ffffff;
        color: #8b2e5e;
        border: 1.5px solid #f2c4db;
        padding: 11px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .dm-btn-csv:hover {
        background: #fff0f7;
        border-color: #e062a0;
    }
    .dm-btn-add {
        background: linear-gradient(135deg, #ec6ca8 0%, #d44b8d 100%);
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 8px 20px rgba(212, 75, 141, 0.25);
        transition: transform 0.15s ease;
    }
    .dm-btn-add:hover {
        transform: translateY(-1px);
    }
    .dm-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(185px, 1fr));
        gap: 14px;
    }
    .dm-stat {
        background: #ffffff;
        border: 1px solid #f5e1ec;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 6px 16px rgba(224, 98, 160, 0.05);
    }
    .dm-stat-label {
        font-size: 12px;
        font-weight: 700;
        color: #7c6b73;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .dm-stat-val {
        margin-top: 6px;
        font-size: 21px;
        font-weight: 800;
        color: #261c22;
    }
    .dm-stat-val.rose { color: #d44b8d; }
    .dm-stat-val.mint { color: #15803d; }

    .dm-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        background: #ffffff;
        border: 1px solid #f5e1ec;
        padding: 14px 18px;
        border-radius: 16px;
    }
    .dm-search {
        flex: 1;
        min-width: 220px;
        padding: 11px 16px;
        border-radius: 11px;
        border: 1.5px solid #f0d7e5;
        background: #fffcfd;
        font-size: 14px;
        color: #261c22;
        outline: none;
    }
    .dm-search:focus {
        border-color: #e062a0;
        background: #ffffff;
    }
    .dm-filters {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .dm-chip {
        border: 1px solid #f0d7e5;
        background: #fff9fc;
        color: #5c4d55;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .dm-chip.active {
        background: #ffe0ef;
        color: #a82b6a;
        border-color: #f2b4d3;
    }
    .dm-alert {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 14px 18px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
    }
    .dm-table-wrap {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #f5e1ec;
        box-shadow: 0 10px 26px rgba(224, 98, 160, 0.06);
        overflow-x: auto;
    }
    table.dm-tbl {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    table.dm-tbl thead th {
        background: #fff2f8;
        color: #8c2d5e;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 20px;
        border-bottom: 1px solid #f5d6e6;
    }
    table.dm-tbl tbody tr {
        border-bottom: 1px solid #fdf2f7;
        transition: background 0.15s ease;
    }
    table.dm-tbl tbody tr:hover {
        background: #fff9fc;
    }
    table.dm-tbl tbody td {
        padding: 14px 20px;
        font-size: 14px;
        color: #3b3036;
        vertical-align: middle;
    }
    .dm-img {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        overflow: hidden;
        border: 1.5px solid #f5d6e6;
        background: #fff5f9;
    }
    .dm-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .dm-name {
        font-weight: 700;
        color: #261c22;
        font-size: 14.5px;
    }
    .dm-price {
        font-weight: 800;
        color: #c93b82;
        white-space: nowrap;
    }
    .pill {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }
    .pill.ok { background: #dcfce7; color: #166534; }
    .pill.low { background: #fef3c7; color: #92400e; }
    .pill.out { background: #ffe4e6; color: #be123c; }

    .dm-act {
        display: inline-flex;
        gap: 8px;
        align-items: center;
        white-space: nowrap;
    }
    .dm-act form {
        margin: 0;
        display: inline-flex;
    }
    .btn-edit, .btn-del {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 32px;
        padding: 0 14px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
        text-decoration: none;
    }
    .btn-edit:hover { background: #fde68a; }
    .btn-del {
        background: #ffe4e6;
        color: #be123c;
        border: 1px solid #fda4af;
    }
    .btn-del:hover { background: #fecdd3; }
</style>

<div class="dm-page">
    <div class="dm-hero">
        <div>
            <span class="dm-badge-top">Perikitty Catalog &amp; Master</span>
            <h1 class="dm-title">Data Master Produk</h1>
            <p class="dm-sub">Kelola daftar produk, pantau ketersediaan stok, dan ekspor data katalog</p>
        </div>
        <div class="dm-hero-actions">
            <button type="button" onclick="exportCatalogCsv()" class="dm-btn-csv">Export CSV</button>
            <a href="<?php echo e(route('admin.create')); ?>" class="dm-btn-add">+ Tambah Produk</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="dm-alert"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php
        $totalProducts = $products->count();
        $totalStock = $products->sum('stock');
        $lowStockCount = $products->where('stock', '>', 0)->where('stock', '<=', 5)->count();
        $catalogValue = $products->sum(fn($item) => $item->price * $item->stock);
    ?>

    <div class="dm-stats">
        <div class="dm-stat">
            <div class="dm-stat-label">Total Produk</div>
            <div class="dm-stat-val"><?php echo e($totalProducts); ?> Item</div>
        </div>
        <div class="dm-stat">
            <div class="dm-stat-label">Total Stok Aktif</div>
            <div class="dm-stat-val mint"><?php echo e($totalStock); ?> Unit</div>
        </div>
        <div class="dm-stat">
            <div class="dm-stat-label">Stok Menipis (&le; 5)</div>
            <div class="dm-stat-val rose"><?php echo e($lowStockCount); ?> Produk</div>
        </div>
        <div class="dm-stat">
            <div class="dm-stat-label">Nilai Katalog</div>
            <div class="dm-stat-val rose">Rp <?php echo e(number_format($catalogValue, 0, ',', '.')); ?></div>
        </div>
    </div>

    <div class="dm-toolbar">
        <input type="text" id="searchInput" class="dm-search" placeholder="Cari nama produk..." oninput="applyFilter()">
        <div class="dm-filters">
            <button type="button" class="dm-chip active" data-filter="all" onclick="setFilter('all', this)">Semua</button>
            <button type="button" class="dm-chip" data-filter="ok" onclick="setFilter('ok', this)">Tersedia</button>
            <button type="button" class="dm-chip" data-filter="low" onclick="setFilter('low', this)">Menipis</button>
            <button type="button" class="dm-chip" data-filter="out" onclick="setFilter('out', this)">Habis</button>
        </div>
    </div>

    <div class="dm-table-wrap">
        <table class="dm-tbl" id="catalogTable">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok &amp; Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $imgs = json_decode($p->images ?? '[]', true) ?: [];
                    $statusKey = $p->stock <= 0 ? 'out' : ($p->stock <= 5 ? 'low' : 'ok');
                ?>
                <tr class="product-row" data-name="<?php echo e(strtolower($p->name)); ?>" data-status="<?php echo e($statusKey); ?>" data-price="<?php echo e($p->price); ?>" data-stock="<?php echo e($p->stock); ?>">
                    <td>
                        <div class="dm-img">
                            <img src="<?php echo e(isset($imgs[0]) ? asset('storage/' . $imgs[0]) : asset('images/produk1.jpg')); ?>" alt="<?php echo e($p->name); ?>">
                        </div>
                    </td>
                    <td class="dm-name"><?php echo e($p->name); ?></td>
                    <td class="dm-price">Rp <?php echo e(number_format($p->price, 0, ',', '.')); ?></td>
                    <td>
                        <?php if($p->stock <= 0): ?>
                            <span class="pill out">Habis (0)</span>
                        <?php elseif($p->stock <= 5): ?>
                            <span class="pill low">Menipis (<?php echo e($p->stock); ?>)</span>
                        <?php else: ?>
                            <span class="pill ok">Tersedia (<?php echo e($p->stock); ?>)</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="dm-act">
                            <a href="<?php echo e(route('admin.edit', $p->id)); ?>" class="btn-edit">Edit</a>
                            <form action="<?php echo e(route('admin.destroy', $p->id)); ?>" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-del">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="padding: 36px; text-align: center; color: #8c7b84;">Belum ada data produk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    let activeFilter = 'all';
    function setFilter(filter, btn) {
        activeFilter = filter;
        document.querySelectorAll('.dm-chip').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');
        applyFilter();
    }
    function applyFilter() {
        const q = (document.getElementById('searchInput').value || '').toLowerCase().trim();
        document.querySelectorAll('.product-row').forEach(row => {
            const name = row.dataset.name || '';
            const status = row.dataset.status || '';
            const matchText = !q || name.includes(q);
            const matchStatus = activeFilter === 'all' || status === activeFilter;
            row.style.display = (matchText && matchStatus) ? '' : 'none';
        });
    }
    function exportCatalogCsv() {
        const rows = [['Nama Produk', 'Harga', 'Stok', 'Status']];
        document.querySelectorAll('.product-row').forEach(row => {
            if (row.style.display === 'none') return;
            rows.push([
                row.querySelector('.dm-name').innerText.trim(),
                row.dataset.price,
                row.dataset.stock,
                row.dataset.status
            ]);
        });
        const csv = rows.map(r => r.map(v => '"' + String(v).replaceAll('"', '""') + '"').join(',')).join('\n');
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'data-master-produk-perikitty.csv';
        a.click();
        URL.revokeObjectURL(url);
    }
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Herd\perikitty\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>