@extends('layouts.app')
@section('title', 'Tambah Produk - Perikitty')
@section('content')
<section style="padding: 60px 5%; background: var(--bg); min-height: 80vh; display: flex; justify-content: center;">
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 40px; width: 100%; max-width: 600px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--text); margin-bottom: 24px;">Tambah Produk Baru</h1>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 16px;"><label style="color: var(--text-muted); font-size: 14px;">Nama Produk</label><input type="text" name="name" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div><label style="color: var(--text-muted); font-size: 14px;">Harga (Rp)</label><input type="number" name="price" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></div>
                <div><label style="color: var(--text-muted); font-size: 14px;">Stok</label><input type="number" name="stock" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></div>
            </div>
            <div style="margin-bottom: 24px;"><label style="color: var(--text-muted); font-size: 14px;">Deskripsi</label><textarea name="description" rows="4" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></textarea></div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 16px;">Simpan Produk</button>
        </form>
    </div>
</section>
@endsection
