@extends('layouts.app')

@section('title', 'Pesanan ' . $order->order_number . ' - Perikitty Olshop')

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
    max-width: 800px;
    margin: auto;
    padding: 40px 6%;
">

    <a
        href="{{ route('orders.index') }}"
        style="
            display: inline-block;
            margin-bottom: 20px;
            color: #c4592f;
            text-decoration: none;
            font-weight: bold;
        "
    >
        ← Kembali ke Pesanan Saya
    </a>

    <div style="
        background: white;
        border: 1px solid #e8e0d2;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;
    ">

        <div style="
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        ">
            <h1 style="margin: 0; color: #2b2a26; font-size: 26px;">
                {{ $order->order_number }}
            </h1>

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
        </div>

        <div style="color: #777; font-size: 14px;">
            {{ $order->created_at->format('d M Y, H:i') }}
        </div>

    </div>

    <div style="
        background: white;
        border: 1px solid #e8e0d2;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;
    ">

        <h2 style="margin: 0 0 18px; color: #2b2a26; font-size: 20px;">
            Produk
        </h2>

        @foreach ($order->items as $item)

            <div style="
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding-bottom: 12px;
                margin-bottom: 12px;
                border-bottom: 1px solid #e8e0d2;
            ">
                <div>
                    <div style="color: #2b2a26; font-weight: bold;">
                        {{ $item->product_name }}
                    </div>
                    <div style="color: #777; font-size: 14px;">
                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                    </div>
                </div>

                <div style="color: #2b2a26; font-weight: bold;">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </div>
            </div>

        @endforeach

        <div style="
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #777;
        ">
            <span>Subtotal</span>
            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
        </div>

        <div style="
            display: flex;
            justify-content: space-between;
            margin-bottom: 14px;
            color: #777;
        ">
            <span>Ongkir</span>
            <span>Rp {{ number_format($order->shipping, 0, ',', '.') }}</span>
        </div>

        <div style="
            display: flex;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #e8e0d2;
            color: #c4592f;
            font-size: 20px;
            font-weight: bold;
        ">
            <span>Total</span>
            <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>

    </div>

    <div style="
        background: white;
        border: 1px solid #e8e0d2;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
    ">

        <h2 style="margin: 0 0 18px; color: #2b2a26; font-size: 20px;">
            Pengiriman
        </h2>

        <div style="color: #2b2a26; font-weight: bold; margin-bottom: 4px;">
            {{ $order->customer_name }}
        </div>

        <div style="color: #777; margin-bottom: 4px;">
            {{ $order->phone }}
        </div>

        <div style="color: #777; line-height: 1.6;">
            {{ $order->address }}, {{ $order->district }}, {{ $order->city }}, {{ $order->province }}
        </div>

        @if ($order->notes)
            <div style="color: #777; margin-top: 10px; font-size: 14px;">
                Catatan: {{ $order->notes }}
            </div>
        @endif

    </div>

    <a
        href="{{ $whatsappUrl }}"
        target="_blank"
        rel="noopener"
        style="
            display: block;
            text-align: center;
            text-decoration: none;
            background: #25d366;
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
        "
    >
        Konfirmasi via WhatsApp
    </a>

</section>

@endsection