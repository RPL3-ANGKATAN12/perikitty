@extends('layouts.app')

@section('title', 'Edit Kategori - Admin Perikitty')

@section('content')

<div style="max-width:700px;margin:40px auto;padding:0 20px;">

    <div style="background:white;padding:30px;border-radius:16px;box-shadow:0 5px 20px rgba(0,0,0,.05);">

        <h1 style="margin-top:0;">Edit Kategori</h1>

        <p style="color:#777;">
            Ubah nama kategori produk.
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

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">

            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">

                <label
                    for="name"
                    style="display:block;margin-bottom:8px;font-weight:bold;"
                >
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    required
                    style="width:100%;padding:13px;border:1px solid #ddd;border-radius:10px;font-size:15px;"
                >

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
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-outline"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
