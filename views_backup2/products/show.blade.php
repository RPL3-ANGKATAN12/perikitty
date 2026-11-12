@extends('layouts.app')

@section('title', $product->name . ' - Perikitty Olshop')

@section('content')

<section style="
    max-width: 1000px;
    margin: auto;
    padding: 40px 6%;
">

    <a
        href="{{ route('products.index') }}"
        style="
            display: inline-block;
            margin-bottom: 20px;
            color: #c4592f;
            text-decoration: none;
            font-weight: bold;
        "
    >
        ← Kembali ke Produk
    </a>

    @if (session('error'))
        <div style="
            background: #fff0f0;
            border: 1px solid #f0c4c4;
            border-radius: 12px;
            color: #b03030;
            padding: 14px 20px;
            margin-bottom: 20px;
            font-size: 14px;
        ">
            {{ session('error') }}
        </div>
    @endif

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
        gap: 30px;
        background: white;
        border: 1px solid #e8e0d2;
        padding: 25px;
        border-radius: 20px;
    ">

        <div>
            @if ($product->image)

                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    style="
                        width: 100%;
                        max-height: 450px;
                        object-fit: contain;
                        border-radius: 15px;
                        background: #f6f1e7;
                        display: block;
                    "
                >

            @else

                <div style="
                    height: 350px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #f3ece0;
                    border-radius: 15px;
                    color: #888;
                ">
                    Tidak ada gambar
                </div>

            @endif
        </div>

        <div>

            @if ($product->category)
                <div style="
                    display: inline-block;
                    background: #e3eee8;
                    color: #1f3d36;
                    padding: 6px 12px;
                    border-radius: 20px;
                    font-size: 14px;
                    margin-bottom: 12px;
                ">
                    {{ $product->category->name }}
                </div>
            @endif

            <h1 style="
                margin: 0 0 15px;
                font-size: 32px;
                color: #2b2a26;
            ">
                {{ $product->name }}
            </h1>

            <div style="
                font-size: 26px;
                font-weight: bold;
                color: #c4592f;
                margin-bottom: 15px;
            ">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div style="margin-bottom: 20px;">
                @if ($product->stock > 0)
                    <span style="color: #198754;">
                        Stok tersedia: {{ $product->stock }}
                    </span>
                @else
                    <span style="color: #dc3545;">
                        Stok habis
                    </span>
                @endif
            </div>

            <hr style="border: none; border-top: 1px solid #e8e0d2; margin: 20px 0;">

            <h3 style="margin: 0 0 10px; color: #2b2a26;">
                Deskripsi
            </h3>

            <p style="
                line-height: 1.7;
                color: #555;
                white-space: pre-line;
                margin: 0 0 25px;
            ">
                {{ $product->description ?: 'Belum ada deskripsi produk.' }}
            </p>

            @if ($product->stock > 0)

                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="
                            width: 100%;
                            border: 0;
                            cursor: pointer;
                            font-size: 16px;
                        "
                    >
                        Tambah ke Keranjang
                    </button>
                </form>

            @else

                <button
                    type="button"
                    disabled
                    style="
                        width: 100%;
                        padding: 14px;
                        border: none;
                        border-radius: 12px;
                        background: #ccc;
                        color: #666;
                        font-size: 16px;
                    "
                >
                    Stok Habis
                </button>

            @endif

        </div>

    </div>

</section>

@endsection