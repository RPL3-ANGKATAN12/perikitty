@extends('layouts.app')
@section('title', 'Koleksi - Perikitty Olshop')
@section('content')
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    
    {{-- HEADER & SEARCH BAR --}}
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 style="font-size: 36px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Semua Koleksi</h1>
            <p style="color: var(--text-muted); font-size: 14px;">Temukan perabot impianmu di sini.</p>
        </div>
        
        {{-- Fitur Pencarian --}}
        <form action="{{ route('products.index') }}" method="GET" style="display: flex; gap: 10px; width: 100%; max-width: 300px;">
            <input type="text" name="search" placeholder="Cari barang..." value="{{ request('search') }}" style="flex: 1; padding: 12px 16px; border: 1px solid var(--border); border-radius: 100px; font-family: inherit; outline: none; font-size: 14px; background: #faf7f9;">
            <button type="submit" style="padding: 12px 20px; background: var(--text); color: #fff; border: none; border-radius: 100px; font-weight: 600; cursor: pointer; font-size: 13px;">Cari</button>
        </form>
    </div>

    {{-- FILTER KATEGORI (Elegan, Teks Doang) --}}
    <div style="display: flex; gap: 20px; margin-bottom: 40px; border-bottom: 1px solid var(--border); padding-bottom: 16px; overflow-x: auto; white-space: nowrap;">
        <a href="{{ route('products.index') }}" style="color: {{ !request('category') ? 'var(--accent)' : 'var(--text-muted)' }}; font-size: 14px; font-weight: 600; text-decoration: none;">Semua</a>
        @foreach(\App\Models\Category::all() as $cat)
            <a href="{{ route('products.index') }}?category={{ $cat->id }}" style="color: {{ request('category') == $cat->id ? 'var(--accent)' : 'var(--text-muted)' }}; font-size: 14px; font-weight: 500; text-decoration: none;">{{ $cat->name }}</a>
        @endforeach
    </div>

    {{-- GRID PRODUK (4 Kolom, Ringkes) --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 24px;">
        @forelse($products as $product)
        <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; display: block; group">
            <div style="position: relative; overflow: hidden; border-radius: 12px; margin-bottom: 16px; background: #faf7f9; aspect-ratio: 1/1;">
                <img src="{{ asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            
            <p style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Perikitty Collection</p>
            <h3 style="font-size: 16px; font-family: 'Playfair Display', serif; font-weight: 600; color: var(--text); margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->name }}</h3>
            <p style="color: var(--accent); font-weight: 700; font-size: 14px; margin: 0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: var(--text-muted);">Produk tidak ditemukan.</div>
        @endforelse
    </div>
</section>
@endsection