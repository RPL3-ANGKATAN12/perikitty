@extends('layouts.app')
@section('title', 'Keranjang - Perikitty')
@section('content')
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 30px;">Keranjang Belanja</h1>
        @if(session('success')) <div style="background:#d4edda; color:#155724; padding:16px; border-radius:8px; margin-bottom:20px;">{{ session('success') }}</div> @endif

        @if(empty($cart))
            <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 60px; text-align: center;">
                <h2 style="color: var(--text);">Keranjang masih kosong.</h2>
                <a href="{{ route('products.index') }}" class="btn btn-primary" style="margin-top: 20px; display: inline-block;">Mulai Belanja</a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 30px;">
                @foreach($cart as $id => $item)
                <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                    <div style="width: 80px; height: 80px; background: #fff; border-radius: 10px; overflow: hidden;">
                        <img src="{{ asset('storage/products/' . $item['image']) }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/produk1.jpg') }}'">
                    </div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 18px; color: var(--text); margin-bottom: 6px;">{{ $item['name'] }}</h3>
                        <p style="color: var(--accent); font-weight: 700;">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; background: #fff; padding: 6px 12px; border-radius: 100px; border: 1px solid var(--border);">
                        <form action="{{ route('cart.update', $id) }}" method="POST">@csrf <input type="hidden" name="action" value="decrease"><button type="submit" style="background:none; border:none; cursor:pointer; font-size:16px;">-</button></form>
                        <span style="font-weight:600;">{{ $item['qty'] }}</span>
                        <form action="{{ route('cart.update', $id) }}" method="POST">@csrf <input type="hidden" name="action" value="increase"><button type="submit" style="background:none; border:none; cursor:pointer; font-size:16px;">+</button></form>
                    </div>
                    <div style="font-weight: 800; color: var(--text); min-width: 100px; text-align: right;">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">@csrf @method('DELETE') <button type="submit" style="background:none; border:none; cursor:pointer; font-size:20px;">🗑️</button></form>
                </div>
                @endforeach
            </div>
            <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: var(--text-muted); margin-bottom: 4px;">Total Pembayaran</p>
                    <div style="font-size: 28px; font-weight: 800; color: var(--text);">Rp {{ number_format($total, 0, ',', '.') }}</div>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="padding: 16px 32px; text-decoration: none;">Lanjut ke Checkout &rarr;</a>
            </div>
        @endif
    </div>
</section>
@endsection