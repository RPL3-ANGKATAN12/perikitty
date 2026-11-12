@extends('layouts.app')

@section('title', 'Kategori - Perikitty Olshop')

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
            Kategori
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Pilih kategori untuk melihat produknya.
        </p>
    </div>

    @if ($categories->count())

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(220px, 100%), 1fr));
            gap: 22px;
        ">

            @foreach ($categories as $category)

                <a
                    href="{{ route('products.index', ['kategori' => $category->id]) }}"
                    style="
                        text-decoration: none;
                        color: inherit;
                        display: block;
                        background: white;
                        border: 1px solid #e8e0d2;
                        border-radius: 16px;
                        padding: 28px 22px;
                        text-align: center;
                    "
                >
                    <h3 style="margin: 0 0 8px; color: #2b2a26;">
                        {{ $category->name }}
                    </h3>

                    <p style="margin: 0; color: #777; font-size: 14px;">
                        {{ $counts[$category->id] ?? 0 }} produk
                    </p>
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
            color: #777;
        ">
            Belum ada kategori.
        </div>

    @endif

</section>

@endsection