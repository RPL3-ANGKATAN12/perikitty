@extends('layouts.app')
@section('title', 'Beranda - Perikitty')
@section('content')
{{-- Hero Section --}}
<section style="padding: 100px 8%; background: linear-gradient(180deg, #fdf2f8 0%, #ffffff 100%); text-align: center;">
    <p style="color: var(--accent); font-size: 13px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 20px;">Koleksi Terbaru 2026</p>
    <h1 style="font-size: clamp(40px, 6vw, 64px); line-height: 1.1; margin-bottom: 24px;">Sentuhan Elegan untuk <br><span style="font-style: italic; color: var(--accent);">Ruang Favoritmu</span></h1>
    <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto 40px; font-size: 16px;">Temukan peralatan rumah tangga dengan desain memukau yang membuat harimu lebih berwarna.</p>
    <div style="display: flex; justify-content: center; gap: 16px;">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Belanja Sekarang</a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline">Lihat Kategori</a>
    </div>
</section>

{{-- Produk --}}
<section style="padding: 80px 8%;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
        <div>
            <h2 style="font-size: 32px;">Pilihan Terbaik</h2>
            <p style="color: var(--text-muted);">Produk paling dicari minggu ini.</p>
        </div>
        <a href="{{ route('products.index') }}" style="color: var(--accent); font-weight: 700; font-size: 14px;">Lihat Semua &rarr;</a>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px;">
        @foreach(\App\Models\Product::latest()->take(4)->get() as $product)
        <div style="background: var(--bg); border: 1px solid var(--border); padding: 20px; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: 0.3s;">
            <div style="height: 220px; background: var(--surface); margin-bottom: 20px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 60px;">🛍️</div>
            <h3 style="font-size: 18px; font-family: 'Plus Jakarta Sans'; font-weight: 700; margin-bottom: 8px;">{{ $product->name }}</h3>
            <p style="color: var(--accent); font-weight: 800; margin-bottom: 20px; font-size: 18px;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline" style="width: 100%; display: block; padding: 12px;">Lihat Detail</a>
        </div>
        @endforeach
    </div>
</section>
@endsection