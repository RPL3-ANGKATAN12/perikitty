@extends('layouts.admin')
@section('content')
    <div class="header">
        <h1>Tambah Produk Baru</h1>
        <a href="{{ route('admin.dashboard') }}" style="color: #666; text-decoration: none; font-weight: 600;">&larr; Kembali</a>
    </div>
    <div style="background: #fff; padding: 30px; border-radius: 12px; max-width: 700px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid #e2e8f0;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 20px;"><label style="display:block; margin-bottom:8px; font-weight:600;">Nama Produk</label><input type="text" name="name" required style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div><label style="display:block; margin-bottom:8px; font-weight:600;">Harga</label><input type="number" name="price" required style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></div>
                <div><label style="display:block; margin-bottom:8px; font-weight:600;">Stok</label><input type="number" name="stock" required style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></div>
                <div><label style="display:block; margin-bottom:8px; font-weight:600;">Kategori</label><select name="category_id" required style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;">@foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach</select></div>
            </div>
            <div style="margin-bottom: 20px;"><label style="display:block; margin-bottom:8px; font-weight:600;">Deskripsi</label><textarea name="description" rows="4" required style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></textarea></div>
            <div style="margin-bottom: 20px;"><label style="display:block; margin-bottom:8px; font-weight:600;">Upload Banyak Foto</label><input type="file" name="images[]" multiple accept="image/*" style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></div>
            <div style="margin-bottom: 30px;"><label style="display:block; margin-bottom:8px; font-weight:600;">Upload Video (Opsional)</label><input type="file" name="video" accept="video/*" style="width:100%; padding:12px; border:1px solid #ccc; border-radius:8px;"></div>
            <button type="submit" style="background: #d85b9b; color: #fff; padding: 16px 32px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; width: 100%;">Simpan Produk</button>
        </form>
    </div>
@endsection