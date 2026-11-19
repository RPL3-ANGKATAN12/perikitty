@extends('layouts.app')

@section('title', 'Edit Produk - Admin Perikitty')

@section('content')

<div style="max-width:750px;margin:40px auto;padding:0 20px;">

    <div style="background:white;padding:30px;border-radius:16px;box-shadow:0 5px 20px rgba(0,0,0,.05);">

        <h1 style="margin-top:0;">Edit Produk</h1>

        <p style="color:#777;">
            Ubah informasi produk {{ $product->name }}.
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
            action="{{ route('admin.products.update', $product) }}"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div style="margin-bottom:18px;">

                <label for="name" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Nama Produk
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $product->name) }}"
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
                            @selected(old('category_id', $product->category_id) == $category->id)
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
                    value="{{ old('price', $product->price) }}"
                    min="0"
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
                    value="{{ old('stock', $product->stock) }}"
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
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;resize:vertical;"
                >{{ old('description', $product->description) }}</textarea>

            </div>


            @if ($product->image)

                <div style="margin-bottom:18px;">

                    <p style="font-weight:bold;margin-bottom:8px;">
                        Foto Saat Ini
                    </p>

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="width:150px;height:150px;object-fit:cover;border-radius:12px;"
                    >

                </div>

            @endif


            <div style="margin-bottom:18px;">

                <label for="image" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Ganti Foto
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    style="width:100%;"
                >

                <small style="display:block;margin-top:7px;color:#777;">
                    Kosongkan jika tidak ingin mengganti foto.
                </small>

            </div>


            @if ($product->video)

                <div style="margin-bottom:18px;">

                    <p style="font-weight:bold;margin-bottom:8px;">
                        Video Saat Ini
                    </p>

                    <video
                        controls
                        style="width:100%;max-width:400px;border-radius:12px;"
                    >
                        <source src="{{ asset('storage/' . $product->video) }}">
                        Browser tidak mendukung video.
                    </video>

                </div>

            @endif


            <div style="margin-bottom:18px;">

                <label for="video" style="display:block;margin-bottom:8px;font-weight:bold;">
                    Ganti Video
                </label>

                <input
                    type="file"
                    id="video"
                    name="video"
                    accept=".mp4,.mov,.avi,.webm"
                    style="width:100%;"
                >

                <small style="display:block;margin-top:7px;color:#777;">
                    Kosongkan jika tidak ingin mengganti video.
                </small>

            </div>


            <div style="margin-bottom:25px;">

                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', $product->is_active))
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
                    Simpan Perubahan
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
