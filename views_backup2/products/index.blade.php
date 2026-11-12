@extends('layouts.app')

@section('title', 'Produk - Perikitty Olshop')

@section('content')

<section style="
    max-width: 1100px;
    margin: auto;
    padding: 50px 6%;
">

    <div style="
        text-align: center;
        margin-bottom: 35px;
    ">
        <h1 style="
            margin: 0 0 10px;
            color: #2b2a26;
            font-size: 36px;
        ">
            Produk Perikitty Olshop
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Pilih produk yang kamu inginkan.
        </p>
    </div>

    <form
        method="GET"
        action="{{ route('products.index') }}"
        style="
            display: flex;
            gap: 10px;
            max-width: 700px;
            margin: 0 auto 40px;
        "
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            style="
                flex: 1;
                padding: 13px 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
                font-size: 15px;
            "
        >

        <button
            type="submit"
            class="btn btn-primary"
            style="
                border: 0;
                cursor: pointer;
            "
        >
            Cari
        </button>

    </form>

    @if ($products->count())

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(220px, 100%), 1fr));
            gap: 22px;
        ">

            @foreach ($products as $product)

                <a
                    href="{{ route('products.show', $product) }}"
                    style="
                        text-decoration: none;
                        color: inherit;
                        display: block;
                    "
                >

                    <div style="
                        background: white;
                        border: 1px solid #e8e0d2;
                        border-radius: 16px;
                        overflow: hidden;
                    ">

                        @if ($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                style="
                                    width: 100%;
                                    height: 220px;
                                    object-fit: cover;
                                    display: block;
                                "
                            >

                        @else

                            <div style="
                                height: 220px;
                                background: #f3ece0;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: #9a8f7c;
                            ">
                                Tidak ada foto
                            </div>

                        @endif

                        <div style="padding: 18px;">

                            @if ($product->category)

                                <div style="
                                    font-size: 13px;
                                    color: #c4592f;
                                    margin-bottom: 7px;
                                    font-weight: bold;
                                ">
                                    {{ $product->category->name }}
                                </div>

                            @endif

                            <h3 style="
                                margin: 0 0 10px;
                                color: #2b2a26;
                            ">
                                {{ $product->name }}
                            </h3>

                            <p style="
                                margin: 0 0 12px;
                                color: #c4592f;
                                font-size: 18px;
                                font-weight: bold;
                            ">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <p style="
                                margin: 0 0 15px;
                                color: #777;
                                font-size: 14px;
                            ">
                                Stok: {{ $product->stock }}
                            </p>

                            <div style="
                                display: inline-block;
                                background: #c4592f;
                                color: white;
                                padding: 9px 14px;
                                border-radius: 9px;
                                font-size: 14px;
                                font-weight: bold;
                            ">
                                Lihat Detail →
                            </div>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 50px 25px;
            text-align: center;
        ">

            <h2 style="
                color: #2b2a26;
                margin-bottom: 10px;
            ">
                Belum ada produk
            </h2>

            <p style="
                color: #777;
                margin: 0;
            ">
                Produk akan muncul di sini setelah ditambahkan.
            </p>

        </div>

    @endif

</section>

@endsection