@extends('layouts.app')

@section('title', 'Pesanan Saya - Perikitty Olshop')

@section('content')

@php
    $statusLabels = [
        'pending' => 'Menunggu konfirmasi',
        'processing' => 'Dikemas',
        'shipped' => 'Dikirim',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];
@endphp

<section style="
    max-width: 900px;
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
            Pesanan Saya
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Riwayat belanjamu di Perikitty Olshop.
        </p>
    </div>

    @if ($orders->count())

        @foreach ($orders as $order)

            <a
                href="{{ route('orders.show', $order) }}"
                style="
                    text-decoration: none;
                    color: inherit;
                    display: block;
                    margin-bottom: 16px;
                "
            >

                <div style="
                    background: white;
                    border: 1px solid #e8e0d2;
                    border-radius: 16px;
                    padding: 20px 25px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 12px;
                    justify-content: space-between;
                    align-items: center;
                ">

                    <div>
                        <div style="
                            color: #2b2a26;
                            font-weight: bold;
                            font-size: 17px;
                            margin-bottom: 4px;
                        ">
                            {{ $order->order_number }}
                        </div>

                        <div style="color: #777; font-size: 14px;">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div style="
                        background: #e3eee8;
                        color: #1f3d36;
                        padding: 6px 12px;
                        border-radius: 20px;
                        font-size: 13px;
                        font-weight: bold;
                    ">
                        {{ $statusLabels[$order->status] ?? $order->status }}
                    </div>

                    <div style="
                        color: #c4592f;
                        font-size: 18px;
                        font-weight: bold;
                    ">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                </div>

            </a>

        @endforeach

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
                Belum ada pesanan
            </h2>

            <p style="
                color: #777;
                margin: 0 0 20px;
            ">
                Yuk mulai belanja dulu.
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