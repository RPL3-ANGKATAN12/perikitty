@extends('layouts.app')
@section('title', $product->name)
@section('content')
<section style="padding: 80px 8%; min-height: 80vh; display: flex; align-items: center; background: var(--bg);">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1100px; margin: auto; align-items: center;">
        <div style="background: var(--surface); height: 450px; display: flex; align-items: center; justify-content: center; font-size: 100px; border-radius: 30px; border: 1px solid var(--border);">🛍️</div>
        <div>
            <p style="color: var(--accent); text-transform: uppercase; font-weight: 700; letter-spacing: 2px; font-size: 12px; margin-bottom: 10px;">Koleksi Premium</p>
            <h1 style="font-size: 44px; margin-bottom: 16px;">{{ $product->name }}</h1>
            <p style="font-size: 28px; color: var(--accent); font-weight: 800; margin-bottom: 24px;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p style="color: var(--text-muted); margin-bottom: 40px; line-height: 1.8; font-size: 16px;">{{ $product->description }}</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-primary" style="width: 100%; padding: 18px;">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</section>
@endsection