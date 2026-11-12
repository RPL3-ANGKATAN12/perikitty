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

            <form method="POST" action="{{ route("orders.cancel", $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');" style="margin
@'
@extends("layouts.app")

@section("title", "Pesanan Saya - Perikitty Olshop")

@section("content")
<section style="max-width:900px;margin:auto;padding:50px 6%;">
    <div style="text-align:center;margin-bottom:35px;">
        <h1 style="margin:0 0 10px;color:#12303b;font-size:36px;">Pesanan Saya</h1>
        <p style="margin:0;color:#777;">Riwayat belanjamu di Perikitty Olshop.</p>
    </div>

    @if ($orders->count())
        @foreach ($orders as $order)
            <a href="{{ route("orders.show", $order) }}" style="text-decoration:none;color:inherit;display:block;margin-bottom:16px;">
                <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:20px 25px;display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;">
                    <div>
                        <div style="color:#12303b;font-weight:bold;font-size:17px;margin-bottom:4px;">{{ $order->order_number }}</div>
                        <div style="color:#777;font-size:14px;">{{ $order->created_at->format("d M Y, H:i") }}</div>
                    </div>
                    <div>@include("orders._status", ["order" => $order])</div>
                    <div style="color:#0a7d9c;font-size:18px;font-weight:bold;">Rp {{ number_format($order->total, 0, ",", ".") }}</div>
                </div>
            </a>
        @endforeach
    @else
        <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:50px 25px;text-align:center;">
            <div style="font-size:48px;margin-bottom:8px;">&#128717;</div>
            <h2 style="color:#12303b;margin:0 0 10px;">Belum ada pesanan</h2>
            <p style="color:#777;margin:0 0 20px;">Yuk mulai belanja dulu.</p>
            <a href="{{ route("products.index") }}" class="btn btn-primary">Belanja dulu</a>
        </div>
    @endif
</section>
@endsection
