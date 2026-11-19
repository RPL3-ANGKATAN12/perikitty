@extends('layouts.admin')
@section('content')
<style>
    .dm-wrap {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }
    .dm-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        background: linear-gradient(135deg, #fff5f9 0%, #ffffff 70%);
        border: 1px solid #f3d5e4;
        padding: 22px 26px;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(216, 91, 155, 0.06);
    }
    .dm-title {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.3px;
    }
    .dm-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: #64748b;
    }
    .dm-btn-add {
        background: linear-gradient(135deg, #d85b9b 0%, #be4282 100%);
        color: #fff;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 8px 18px rgba(216, 91, 155, 0.25);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .dm-btn-add:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(216, 91, 155, 0.32);
    }
    .dm-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 14px;
    }
    .dm-stat-card {
        background: #ffffff;
        border: 1px solid #f1e4ec;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
    }
    .dm-stat-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .dm-stat-value {
        margin-top: 6px;
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
    }
    .dm-stat-value.accent {
        color: #be4282;
    }
    .dm-alert-success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 14px 18px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
    }
    .dm-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1e4ec;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        overflow-x: auto;
    }
    .dm-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .dm-table thead th {
        background: #fdf2f8;
        color: #831843;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 20px;
        border-bottom: 1px solid #f3d5e4;
    }
    .dm-table tbody tr {
        border-bottom: 1px solid #f8fafc;
        transition: background 0.15s ease;
    }
    .dm-table tbody tr:hover {
        background: #fff9fc;
    }
    .dm-table tbody tr:last-child {
        border-bottom: none;
    }
    .dm-table tbody td {
        padding: 14px 20px;
        font-size: 14px;
        color: #334155;
        vertical-align: middle;
    }
    .dm-thumb {
        width: 54px;
        height: 54px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #f1e4ec;
        background: #fdf2f8;
    }
    .dm-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .dm-prod-name {
        font-weight: 700;
        color: #0f172a;
    }
    .dm-price {
        font-weight: 800;
        color: #be4282;
        white-space: nowrap;
    }
    .dm-stock-pill {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        background: #f1f5f9;
        color: #0f172a;
    }
    .dm-stock-pill.empty {
        background: #fee2e2;
        color: #b91c1c;
    }
    .dm-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dm-btn-edit {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        padding: 7px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        transition: background 0.15s ease;
    }
    .dm-btn-edit:hover {
        background: #fde68a;
    }
    .dm-btn-del {
        background: #ffe4e6;
        color: #be123c;
        border: 1px solid #fecdd3;
        padding: 7px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        font-size: 12px;
        transition: background 0.15s ease;
    }
    .dm-btn-del:hover {
        background: #fecdd3;
    }
    .dm-empty {
        padding: 36px 20px;
        text-align: center;
        color: #94a3b8;
        font-size: 14px;
    }
</style>

<div class="dm-wrap">
    <div class="dm-header">
        <div>
            <h1 class="dm-title">Data Produk (Tabel Master)</h1>
            <p class="dm-subtitle">Kelola katalog produk, harga, dan stok toko Perikitty</p>
        </div>
        <a href="{{ route('admin.create') }}" class="dm-btn-add">+ Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="dm-alert-success">{{ session('success') }}</div>
    @endif

    <div class="dm-stats">
        <div class="dm-stat-card">
            <div class="dm-stat-label">Total Produk</div>
            <div class="dm-stat-value">{{ $products->count() }} Item</div>
        </div>
        <div class="dm-stat-card">
            <div class="dm-stat-label">Total Unit Stok</div>
            <div class="dm-stat-value">{{ $products->sum('stock') }} Pcs</div>
        </div>
        <div class="dm-stat-card">
            <div class="dm-stat-label">Estimasi Nilai Stok</div>
            <div class="dm-stat-value accent">Rp {{ number_format($products->sum(fn($item) => $item->price * $item->stock), 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="dm-card">
        <table class="dm-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                @php $imgs = json_decode($p->images ?? '[]', true) ?: []; @endphp
                <tr>
                    <td>
                        <div class="dm-thumb">
                            <img src="{{ isset($imgs[0]) ? asset('storage/' . $imgs[0]) : asset('images/produk1.jpg') }}" alt="{{ $p->name }}">
                        </div>
                    </td>
                    <td class="dm-prod-name">{{ $p->name }}</td>
                    <td class="dm-price">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="dm-stock-pill {{ $p->stock <= 0 ? 'empty' : '' }}">
                            {{ $p->stock > 0 ? $p->stock . ' tersedia' : 'Habis' }}
                        </span>
                    </td>
                    <td>
                        <div class="dm-actions">
                            <a href="{{ route('admin.edit', $p->id) }}" class="dm-btn-edit">Edit</a>
                            <form action="{{ route('admin.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dm-btn-del">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="dm-empty">Belum ada produk pada data master.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
