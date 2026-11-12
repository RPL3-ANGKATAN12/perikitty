@extends('layouts.app')

@section('title', 'Dashboard Admin - Perikitty Olshop')

@section('content')

@php
    $pendingOrders = \App\Models\Order::where('status', 'pending')->count();

    $cards = [
        [
            'title' => 'Produk',
            'desc' => 'Kelola produk dan stok.',
            'info' => \App\Models\Product::count() . ' produk',
            'route' => 'admin.products.index',
        ],
        [
            'title' => 'Kategori',
            'desc' => 'Atur kategori produk.',
            'info' => \App\Models\Category::count() . ' kategori',
            'route' => 'admin.categories.index',
        ],
        [
            'title' => 'Pesanan',
            'desc' => 'Kelola pesanan pelanggan.',
            'info' => $pendingOrders . ' menunggu konfirmasi',
            'route' => 'admin.orders.index',
        ],
        [
            'title' => 'Pengaduan',
            'desc' => 'Balas pengaduan pelanggan.',
            'info' => \App\Models\Complaint::whereNull('admin_reply')->count() . ' belum dibalas',
            'route' => 'admin.complaints.index',
        ],
        [
            'title' => 'Saran',
            'desc' => 'Baca saran dari pelanggan.',
            'info' => \App\Models\Feedback::count() . ' saran',
            'route' => 'admin.feedback.index',
        ],
        [
            'title' => 'Pembeli',
            'desc' => 'Jumlah pembeli terdaftar.',
            'info' => \App\Models\User::where('is_admin', false)->count() . ' pembeli',
            'route' => null,
        ],
    ];
@endphp

<section style="
    max-width: 1100px;
    margin: auto;
    padding: 50px 6%;
">

    <div style="
        background: #f3ece0;
        border-radius: 20px;
        padding: 30px 35px;
        margin-bottom: 30px;
    ">
        <h1 style="margin: 0 0 8px; color: #2b2a26; font-size: 34px;">
            Dashboard Admin
        </h1>

        <p style="margin: 0; color: #777;">
            Selamat datang di panel admin Perikitty Olshop.
        </p>
    </div>

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(260px, 100%), 1fr));
        gap: 22px;
    ">

        @foreach ($cards as $card)

            @if ($card['route'])
                <a
                    href="{{ route($card['route']) }}"
                    style="
                        text-decoration: none;
                        color: inherit;
                        display: block;
                        background: white;
                        border: 1px solid #e8e0d2;
                        border-radius: 16px;
                        padding: 26px;
                    "
                >
            @else
                <div style="
                    background: white;
                    border: 1px solid #e8e0d2;
                    border-radius: 16px;
                    padding: 26px;
                ">
            @endif

                <h3 style="margin: 0 0 8px; color: #1f3d36; font-size: 22px;">
                    {{ $card['title'] }}
                </h3>

                <p style="margin: 0 0 14px; color: #777;">
                    {{ $card['desc'] }}
                </p>

                <div style="color: #c4592f; font-weight: bold; font-size: 14px;">
                    {{ $card['info'] }}
                </div>

            @if ($card['route'])
                </a>
            @else
                </div>
            @endif

        @endforeach

    </div>

</section>

@endsection