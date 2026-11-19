@extends('layouts.app')
@section('title', $product->name)
@section('content')
<section style="padding: 60px 8%; min-height: 80vh; background: #ffffff;">
    <div style="max-width: 1100px; margin: 0 auto 30px auto;">
        <a href="{{ route('products.index') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 14px; font-weight: 600; text-decoration: none;">&larr; Kembali ke Koleksi</a>
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1100px; margin: auto; align-items: start;">
        <div>
            <div style="width: 100%; height: 450px; background: #faf7f9; border-radius: 20px; overflow: hidden; margin-bottom: 20px; border: 1px solid var(--border);">
                <img id="mainImage" src="{{ $product->images ? asset('storage/' . json_decode($product->images)[0]) : asset('images/produk1.jpg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            
            {{-- Thumbnail Foto --}}
            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                @if($product->images)
                    @foreach(json_decode($product->images) as $img)
                        <img src="{{ asset('storage/' . $img) }}" onclick="changeImage(this.src, this)" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 2px solid transparent;" class="thumbnail">
                    @endforeach
                @else
                    <img src="{{ asset('images/produk1.jpg') }}" onclick="changeImage(this.src, this)" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 2px solid var(--accent);" class="thumbnail">
                @endif
            </div>

            {{-- Video (Kalau Ada) --}}
            @if($product->video)
                <div style="margin-top: 20px;">
                    <h4 style="margin-bottom: 10px; color: var(--text);">Video Produk</h4>
                    <video controls style="width: 100%; border-radius: 12px;">
                        <source src="{{ asset('storage/' . $product->video) }}" type="video/mp4">
                        Browser kamu tidak mendukung tag video.
                    </video>
                </div>
            @endif
        </div>
        <div style="padding-top: 10px;">
            <h1 style="font-size: 42px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 16px; line-height: 1.2;">{{ $product->name }}</h1>
            <p style="font-size: 32px; color: var(--accent); font-weight: 700; margin-bottom: 30px;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <div style="border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 24px 0; margin-bottom: 30px;">
                <p style="color: var(--text-muted); line-height: 1.8; font-size: 16px;">{!! nl2br(e($product->description)) !!}</p>
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-primary" style="width: 100%; padding: 18px; font-size: 16px; border-radius: 10px;">Tambah ke Keranjang</button>
            </form>
            <div style="margin-top: 24px; display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 14px;">
                <span style="font-weight: 600; color: var(--text);">Stok:</span> {{ $product->stock }} tersedia
            </div>
        </div>
    </div>
</section>
<script>
    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(img => { img.style.borderColor = 'transparent'; });
        element.style.borderColor = 'var(--accent)';
    }
</script>
@endsection