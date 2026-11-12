@extends("layouts.app")

@section("title", "Pesanan Berhasil - Perikitty Olshop")

@section("content")
@php
    $rekening = config("shop.rekening", []);
    $qris = config("shop.qris", []);
    $wa = config("shop.whatsapp");
    $waText = rawurlencode("Halo Perikitty, saya mau konfirmasi pembayaran pesanan " . $order->order_number . " dengan total Rp " . number_format($order->total, 0, ",", ".") . ".");
@endphp

<section style="max-width:720px;margin:auto;padding:40px 6%;">

    <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:16px;padding:28px;text-align:center;margin-bottom:22px;">
        <div style="width:56px;height:56px;margin:0 auto 12px;background:#047857;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:800;">&#10003;</div>
        <h1 style="margin:0 0 6px;color:#065f46;font-size:26px;">Pesanan Berhasil!</h1>
        <p style="margin:0;color:#047857;font-size:14px;">Terima kasih sudah berbelanja di Perikitty Olshop.</p>
    </div>

    <div style="background:#fff;border:1px solid #d8e9ee;border-radius:16px;padding:25px;margin-bottom:20px;">
        <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:14px;">
            <div>
                <div style="font-size:12px;color:#777;text-transform:uppercase;">Nomor Pesanan</div>
                <div style="font-size:18px;font-weight:800;color:#12303b;">{{ $order->order_number }}</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:12px;color:#777;text-transform:uppercase;">Total Bayar</div>
                <div style="font-size:20px;font-weight:800;color:#0a7d9c;">Rp {{ number_format($order->total, 0, ",", ".") }}</div>
            </div>
        </div>

        <hr style="border:none;border-top:1px solid #eef4f6;margin:18px 0;">

        <h2 style="margin:0 0 12px;color:#12303b;font-size:17px;">Rekening Toko</h2>
        @foreach ($rekening as $r)
            <div style="background:#f4fafb;border:1px solid #d8e9ee;border-radius:10px;padding:12px 14px;margin-bottom:8px;">
                <div style="font-weight:700;color:#0a3d4c;">{{ $r["bank"] ?? "-" }}</div>
                <div style="font-size:15px;color:#12303b;">{{ $r["nomor"] ?? "-" }}</div>
                <div style="font-size:13px;color:#777;">a.n. {{ $r["atas_nama"] ?? "-" }}</div>
            </div>
        @endforeach

        @if (!empty($qris["gambar"]))
            <h2 style="margin:18px 0 8px;color:#12303b;font-size:17px;">QRIS</h2>
            <div style="background:#f4fafb;border:1px solid #d8e9ee;border-radius:10px;padding:14px;text-align:center;">
                <img src="{{ asset($qris["gambar"]) }}" alt="QRIS" style="width:180px;height:180px;object-fit:contain;margin:auto;display:block;">
                <div style="font-size:13px;color:#777;margin-top:6px;">a.n. {{ $qris["atas_nama"] ?? "Perikitty Olshop" }}</div>
            </div>
        @endif

        <h2 style="margin:18px 0 8px;color:#12303b;font-size:17px;">Langkah Pembayaran</h2>
        <ol style="margin:0;padding-left:20px;color:#555;font-size:14px;line-height:1.8;">
            <li>Transfer sesuai total bayar ke rekening atau scan QRIS di atas.</li>
            <li>Simpan bukti pembayaran.</li>
            <li>Klik tombol konfirmasi WhatsApp dan kirim bukti transfer.</li>
            <li>Pesanan akan diproses setelah pembayaran dikonfirmasi admin.</li>
        </ol>
    </div>

    <a href="https://wa.me/{{ $wa }}?text={{ $waText }}" target="_blank" rel="noopener" style="display:block;text-align:center;text-decoration:none;background:#25d366;color:#fff;padding:15px;border-radius:12px;font-size:16px;font-weight:800;margin-bottom:10px;">
        Konfirmasi via WhatsApp
    </a>

    <a href="{{ route("orders.show", $order) }}" style="display:block;text-align:center;text-decoration:none;border:1.5px solid #0a3d4c;color:#0a3d4c;padding:13px;border-radius:12px;font-size:15px;font-weight:700;">
        Lihat Detail Pesanan
    </a>

</section>
@endsection
