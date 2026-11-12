@extends('layouts.app')
@section('title', 'Koleksi - Perikitty')
@section('content')
<section style="padding: 80px 8%; min-height: 80vh;">
    <h1 style="font-size: 40px; text-align: center; margin-bottom: 60px;">Semua Koleksi</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px;">
        @foreach($products as $p)
        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="height: 220px; background: var(--surface); display: flex; align-items: center; justify-content: center; font-size: 60px;">🛍️</div>
            <div style="padding: 24px; text-align: center;">
                <h3 style="font-size: 18px; font-family: 'Plus Jakarta Sans'; font-weight: 700; margin-bottom: 8px;">{{ $p->name }}</h3>
                <p style="color: var(--accent); font-weight: 800; margin-bottom: 20px; font-size: 18px;">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                <a href="{{ route('products.show', $p->id) }}" class="btn btn-outline" style="width: 100%; display: block; padding: 12px;">Lihat Produk</a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection