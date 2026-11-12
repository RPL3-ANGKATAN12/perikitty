@extends('layouts.app')

@section('title', 'Tambah Produk - Admin Perikitty')

@section('content')

<div style="max-width:750px;margin:40px auto;padding:0 20px;">

    <div style="background:white;padding:30px;border-radius:16px;box-shadow:0 5px 20px rgba(0,0,0,.05);">

        <h1 style="margin-top:0;">Tambah Produk</h1>

        <p style="color:#777;">
            Tambahkan produk baru ke Perikitty Olshop.
        </p>

        @if ($errors->any())

            <div style="background:#fff0f0;color:#c62828;padding:15px;border-radius:10px;margin-bottom:20px;">

                <ul style="margin:0;padding-left:20px;">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data"
        >

            @csrf

            <div style="margin-bottom:18px;">

                <label for="name" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Nama Produk
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Rantang Pink"
                    required
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;"
                >

            </div>


            <div style="margin-bottom:18px;">

                <label for="category_id" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Kategori
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;"
                >

                    <option value="">-- Pilih Kategori --</option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div style="margin-bottom:18px;">

                <label for="price" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Harga
                </label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    min="0"
                    placeholder="Contoh: 25000"
                    required
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;"
                >

            </div>


            <div style="margin-bottom:18px;">

                <label for="stock" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Stok
                </label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    required
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;"
                >

            </div>


            <div style="margin-bottom:18px;">

                <label for="description" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Tulis deskripsi produk..."
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;resize:vertical;"
                >{{ old('description') }}</textarea>

            </div>


            <div style="margin-bottom:18px;">

                <label for="image" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Foto Produk
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    style="width:100%;"
                >

                <small style="display:block;margin-top:7px;color:#777;">
                    JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                </small>

            </div>


            <div style="margin-bottom:18px;">

                <label for="video" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Video Produk
                </label>

                <input
                    type="file"
                    id="video"
                    name="video"
                    accept=".mp4,.mov,.avi,.webm"
                    style="width:100%;"
                >

                <small style="display:block;margin-top:7px;color:#777;">
                    MP4, MOV, AVI, atau WEBM. Maksimal 20 MB.
                </small>

            </div>


            <div style="margin-bottom:25px;">

                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', true))
                    >

                    <span style="font-weight:bold;">
                        Produk aktif dan tampil di toko
                    </span>

                </label>

            </div>


            <div style="display:flex;gap:10px;flex-wrap:wrap;">

                <button
                    type="submit"
                    class="btn btn-primary"
                    style="border:0;cursor:pointer;"
                >
                    Simpan Produk
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-outline"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
