@extends('layouts.app')
@section('title', 'Detail Pesanan - Perikitty')
@section('content')
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 800px; margin: auto;">
        <a href="{{ route('profile.index') }}" style="color: var(--accent); text-decoration: none; font-weight: 600; margin-bottom: 20px; display: inline-block;">&larr; Kembali ke Pesanan</a>
        <h1 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 10px;">Detail Pesanan</h1>
        <p style="color: var(--text-muted); margin-bottom: 30px;">No. Pesanan: <strong>{{ $order->order_number }}</strong></p>

        <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 24px; margin-bottom: 24px;">
            <h2 style="font-size: 18px; margin-bottom: 16px; color: var(--text);">Informasi Pengiriman</h2>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>No. HP:</strong> {{ $order->phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Status:</strong> <span style="background: var(--accent); color: #fff; padding: 4px 12px; border-radius: 100px; font-size: 12px;">{{ $order->status }}</span></p>
        </div>

        <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 24px;">
            <h2 style="font-size: 18px; margin-bottom: 16px; color: var(--text);">Barang yang Dibeli</h2>
            @foreach($order->items as $item)
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border); padding-bottom: 12px; margin-bottom: 12px;">
                <div>
                    <p style="font-weight: 600;">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                    <p style="color: var(--text-muted); font-size: 14px;">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
                <p style="font-weight: 700;">Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</p>
            </div>
            @endforeach
            <div style="text-align: right; margin-top: 16px;">
                <p style="font-size: 14px; color: var(--text-muted);">Total Belanja</p>
                <p style="font-size: 24px; font-weight: 800; color: var(--accent);">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection