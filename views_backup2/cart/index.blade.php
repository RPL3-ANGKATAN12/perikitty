@extends('layouts.app')

@section('title', 'Keranjang - Perikitty Olshop')

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
            Keranjang Belanja
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Periksa lagi produk pilihanmu sebelum checkout.
        </p>
    </div>

    @if (session('success'))
        <div style="
            background: #f3ece0;
            border: 1px solid #e6c3b5;
            border-radius: 12px;
            color: #2b2a26;
            padding: 14px 20px;
            margin-bottom: 20px;
            font-size: 14px;
        ">
            {{ session('success') }}
        </div>
    @endif

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

    @if (count($cart))

        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
        ">

            @foreach ($cart as $item)

                <div style="
                    display: flex;
                    flex-wrap: wrap;
                    gap: 16px;
                    align-items: center;
                    padding-bottom: 18px;
                    margin-bottom: 18px;
                    border-bottom: 1px solid #e8e0d2;
                ">

                    @if ($item['image'])

                        <img
                            src="{{ asset('storage/' . $item['image']) }}"
                            alt="{{ $item['name'] }}"
                            style="
                                width: 80px;
                                height: 80px;
                                object-fit: cover;
                                border-radius: 12px;
                                flex-shrink: 0;
                            "
                        >

                    @else

                        <div style="
                            width: 80px;
                            height: 80px;
                            background: #f3ece0;
                            border-radius: 12px;
                            flex-shrink: 0;
                        "></div>

                    @endif

                    <div style="flex: 1; min-width: 160px;">
                        <div style="
                            color: #2b2a26;
                            font-weight: bold;
                            font-size: 17px;
                            margin-bottom: 4px;
                        ">
                            {{ $item['name'] }}
                        </div>

                        <div style="color: #c4592f; font-weight: bold;">
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </div>
                    </div>

                    <form
                        action="{{ route('cart.update', $item['id']) }}"
                        method="POST"
                        style="display: flex; gap: 8px; align-items: center;"
                    >
                        @csrf
                        @method('PATCH')

                        <input
                            type="number"
                            name="quantity"
                            value="{{ $item['quantity'] }}"
                            min="0"
                            style="
                                width: 70px;
                                padding: 10px;
                                border: 1px solid #ddd;
                                border-radius: 10px;
                                font-size: 15px;
                            "
                        >

                        <button
                            type="submit"
                            style="
                                background: white;
                                border: 1px solid #c4592f;
                                color: #c4592f;
                                padding: 10px 14px;
                                border-radius: 10px;
                                font-weight: bold;
                                cursor: pointer;
                            "
                        >
                            Ubah
                        </button>
                    </form>

                    <div style="
                        min-width: 110px;
                        text-align: right;
                        color: #2b2a26;
                        font-weight: bold;
                    ">
                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    </div>

                    <form
                        action="{{ route('cart.remove', $item['id']) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                                background: none;
                                border: 0;
                                color: #b03030;
                                cursor: pointer;
                                font-size: 14px;
                            "
                        >
                            Hapus
                        </button>
                    </form>

                </div>

            @endforeach

            <div style="
                display: flex;
                justify-content: space-between;
                color: #c4592f;
                font-size: 20px;
                font-weight: bold;
            ">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

        </div>

        <div style="
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
        ">

            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    style="
                        background: none;
                        border: 0;
                        color: #777;
                        cursor: pointer;
                        font-size: 14px;
                    "
                >
                    Kosongkan keranjang
                </button>
            </form>

            <a
                href="{{ route('checkout.create') }}"
                class="btn btn-primary"
                style="text-decoration: none;"
            >
                Lanjut ke Checkout
            </a>

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
                Keranjangmu masih kosong
            </h2>

            <p style="
                color: #777;
                margin: 0 0 20px;
            ">
                Yuk pilih produk dulu.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="btn btn-primary"
                style="text-decoration: none;"
            >
                Lihat Produk
            </a>

        </div>

    @endif

</section>

@endsection