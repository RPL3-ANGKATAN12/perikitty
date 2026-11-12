@extends("layouts.app")

@section("title", "Pesanan " . $order->order_number . " - Perikitty Olshop")

@section("content")
@php
    $rekening = config("shop.rekening", []);
    $qris = config("shop.qris", []);
@endphp

<section style="max-width:800px;margin:auto;padding:40px 6%;">
    <a href="{{ route("orders.index") }}" style="display:inline-block;margin-bottom:20px;color:#0a7d9c;font-weight:bold;">&larr; Kembali ke Pesanan Saya</a>

    <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:25px;margin-bottom:20px;">
        <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;margin-bottom:6px;">
            <h1 style="margin:0;color:#12303b;font-size:26px;">{{ $order->order_number }}</h1>
            <div>@include("orders._status", ["order" => $order])</div>
        </div>
        <div style="color:#777;font-size:14px;margin-bottom:14px;">{{ $order->created_at->format("d M Y, H:i") }}</div>
        @include("orders._steps", ["order" => $order])
    </div>

    @if ($order->status === "pending")
        <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:16px;padding:25px;margin-bottom:20px;">
            <h2 style="margin:0 0 10px;color:#9a3412;font-size:18px;">Selesaikan Pembayaran</h2>
            <p style="margin:0 0 14px;color:#7c2d12;font-size:14px;">Total yang harus dibayar: <strong>Rp {{ number_format($order->total, 0, ",", ".") }}</strong></p>

            @foreach ($rekening as $r)
                <div style="background:#fff;border:1px solid #fed7aa;border-radius:10px;padding:10px 14px;margin-bottom:8px;">
                    <div style="font-weight:700;color:#9a3412;">{{ $r["bank"] ?? "-" }}</div>
                    <div style="font-size:15px;">{{ $r["nomor"] ?? "-" }}</div>
                    <div style="font-size:13px;color:#777;">a.n. {{ $r["atas_nama"] ?? "-" }}</div>
                </div>
            @endforeach

            @if (!empty($qris["gambar"]))
                <div style="text-align:center;margin-top:12px;">
                    <img src="{{ asset($qris["gambar"]) }}" alt="QRIS" style="width:160px;height:160px;object-fit:contain;display:block;margin:auto;">
                    <div style="font-size:12px;color:#777;margin-top:4px;">a.n. {{ $qris["atas_nama"] ?? "Perikitty Olshop" }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route("orders.cancel", $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');" style="margin-top:16px;">
                @csrf
                <button type="submit" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:10px 18px;border-radius:10px;font-weight:700;cursor:pointer;font-size:14px;">Batalkan Pesanan</button>
            </form>
        </div>
    @endif

    <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:25px;margin-bottom:20px;">
        <h2 style="margin:0 0 18px;color:#12303b;font-size:20px;">Produk</h2>

        @foreach ($order->items as $item)
            <div style="display:flex;justify-content:space-between;gap:12px;padding-bottom:12px;margin-bottom:12px;border-bottom:1px solid #d8e9ee;">
                <div>
                    <div style="color:#12303b;font-weight:bold;">{{ $item->product_name }}</div>
                    <div style="color:#777;font-size:14px;">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ",", ".") }}</div>
                </div>
                <div style="color:#12303b;font-weight:bold;">Rp {{ number_format($item->subtotal, 0, ",", ".") }}</div>
            </div>
        @endforeach

        <div style="display:flex;justify-content:space-between;margin-bottom:10px;color:#777;">
            <span>Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ",", ".") }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:14px;color:#777;">
            <span>Ongkir</span><span>Rp {{ number_format($order->shipping, 0, ",", ".") }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;padding-top:14px;border-top:1px solid #d8e9ee;color:#0a7d9c;font-size:20px;font-weight:bold;">
            <span>Total</span><span>Rp {{ number_format($order->total, 0, ",", ".") }}</span>
        </div>
    </div>

    <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:25px;margin-bottom:25px;">
        <h2 style="margin:0 0 18px;color:#12303b;font-size:20px;">Pengiriman</h2>
        <div style="color:#12303b;font-weight:bold;margin-bottom:4px;">{{ $order->customer_name }}</div>
        <div style="color:#777;margin-bottom:4px;">{{ $order->phone }}</div>
        <div style="color:#777;line-height:1.6;">{{ $order->address }}, {{ $order->district }}, {{ $order->city }}, {{ $order->province }}</div>
        @if ($order->notes)
            <div style="color:#777;margin-top:10px;font-size:14px;">Catatan: {{ $order->notes }}</div>
        @endif
    </div>

    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" style="display:block;text-align:center;text-decoration:none;background:#25d366;color:#fff;padding:14px;border-radius:12px;font-size:16px;font-weight:bold;">
        Konfirmasi via WhatsApp
    </a>
</section>
@endsection
