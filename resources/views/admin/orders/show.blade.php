@extends('layouts.app')

@section('title', 'Detail Pesanan - Admin Perikitty')

@section('content')

@php
    $waNumber = preg_replace('/\D/', '', $order->phone);

    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }

    $waText = 'Halo ' . $order->customer_name . ', pesananmu ' . $order->order_number
        . ' di ' . config('shop.name') . ' sedang kami proses.';
@endphp

<div style="max-width:800px;margin:40px auto;padding:0 20px;">

    <a
        href="{{ route('admin.orders.index') }}"
        style="display:inline-block;margin-bottom:20px;color:#0a7d9c;text-decoration:none;font-weight:bold;"
    >
        ← Kembali ke Pesanan
    </a>

    @if (session('error'))
        <div style="background:#fff0f0;border:1px solid #f0c4c4;border-radius:12px;color:#b03030;padding:14px 20px;margin-bottom:20px;font-size:14px;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#eaf5f6;border:1px solid #e6c3b5;border-radius:12px;color:#a6402a;padding:14px 20px;margin-bottom:20px;font-size:14px;">
            @foreach ($errors->all() as $message)
                <div>{{ $message }}</div>
            @endforeach
        </div>
    @endif

    <div style="background:white;border-radius:14px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,.05);margin-bottom:20px;">

        <h1 style="margin:0 0 6px;font-size:26px;">{{ $order->order_number }}</h1>

        <div style="color:#777;font-size:14px;margin-bottom:18px;">
            {{ $order->created_at->format('d M Y, H:i') }}
        </div>

        <h2 style="margin:0 0 14px;font-size:20px;">Produk</h2>

        @foreach ($order->items as $item)
            <div style="display:flex;justify-content:space-between;gap:12px;padding-bottom:10px;margin-bottom:10px;border-bottom:1px solid #eee;">
                <div>
                    <div style="font-weight:bold;">{{ $item->product_name }}</div>
                    <div style="color:#777;font-size:14px;">
                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                    </div>
                </div>
                <div style="font-weight:bold;">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </div>
            </div>
        @endforeach

        <div style="display:flex;justify-content:space-between;color:#777;margin-bottom:8px;">
            <span>Subtotal</span>
            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
        </div>

        <div style="display:flex;justify-content:space-between;color:#777;margin-bottom:12px;">
            <span>Ongkir</span>
            <span>Rp {{ number_format($order->shipping, 0, ',', '.') }}</span>
        </div>

        <div style="display:flex;justify-content:space-between;padding-top:12px;border-top:1px solid #eee;color:#0a7d9c;font-size:20px;font-weight:bold;">
            <span>Total</span>
            <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>

    </div>

    <div style="background:white;border-radius:14px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,.05);margin-bottom:20px;">

        <h2 style="margin:0 0 14px;font-size:20px;">Pembeli dan Pengiriman</h2>

        <div style="font-weight:bold;margin-bottom:4px;">{{ $order->customer_name }}</div>
        <div style="color:#777;margin-bottom:4px;">{{ $order->phone }}</div>
        <div style="color:#777;line-height:1.6;">
            {{ $order->address }}, {{ $order->district }}, {{ $order->city }}, {{ $order->province }}
        </div>

        @if ($order->notes)
            <div style="color:#777;margin-top:10px;font-size:14px;">
                Catatan: {{ $order->notes }}
            </div>
        @endif

        <a
            href="https://wa.me/{{ $waNumber }}?text={{ rawurlencode($waText) }}"
            target="_blank"
            rel="noopener"
            style="display:inline-block;margin-top:16px;background:#25d366;color:white;padding:10px 16px;border-radius:10px;font-weight:bold;font-size:14px;text-decoration:none;"
        >
            Hubungi pembeli via WhatsApp
        </a>

    </div>

    <form
        action="{{ route('admin.orders.update', $order) }}"
        method="POST"
        style="background:white;border-radius:14px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,.05);"
    >
        @csrf
        @method('PATCH')

        <h2 style="margin:0 0 14px;font-size:20px;">Status Pesanan</h2>

        @if ($order->status === 'cancelled')

            <p style="margin:0;color:#777;">
                Pesanan ini sudah dibatalkan dan tidak bisa diubah lagi.
            </p>

        @else

            <select
                name="status"
                style="width:100%;padding:13px 15px;border:1px solid #ddd;border-radius:10px;font-size:15px;font-family:inherit;margin-bottom:16px;background:white;"
            >
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected($order->status === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary" style="border:0;cursor:pointer;">
                Simpan Status
            </button>

        @endif
    </form>

</div>

@endsection