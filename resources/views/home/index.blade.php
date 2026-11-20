@extends('layouts.app')
@section('title', 'Beranda - Perikitty')
@section('content')

{{-- 1. HERO SECTION --}}
<section style="position: relative; padding: 52px 8%; background: #fff4f8; display: flex; align-items: center; justify-content: space-between; gap: 32px; min-height: calc(100vh - 78px); overflow: hidden;">
    <img src="{{ asset('images/hero-pajangan.png') }}" alt="Pajangan Olshop Bernuansa Merah Muda Perikitty" style="position: absolute; top: 0; right: 0; width: 65%; height: 100%; object-fit: cover; object-position: center; pointer-events: none; z-index: 0;">
    <div style="position: absolute; inset: 0; background: linear-gradient(90deg, #fff5f9 0%, #fff2f7 40%, rgba(255, 236, 244, 0.72) 58%, rgba(255, 236, 244, 0.08) 84%, rgba(255, 236, 244, 0) 100%); pointer-events: none; z-index: 1;"></div>

    <div style="position: relative; z-index: 2; flex: 1; max-width: 500px;">
        <p style="color: var(--accent); font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 16px;">Perikitty Olshop 2026</p>
        <h1 style="font-size: clamp(36px, 4vw, 56px); line-height: 1.1; margin-bottom: 20px; font-family: 'Playfair Display', serif; color: var(--text); font-weight: 600;">Sentuhan Elegan <br><span style="font-style: italic; color: var(--accent);">untuk Rumahmu</span></h1>
        <p style="color: var(--text-muted); margin-bottom: 30px; font-size: 15px; line-height: 1.7;">Peralatan rumah tangga pilihan dengan desain abadi yang memadukan fungsi dan estetika.</p>
        <a href="{{ route('products.index') }}" style="display: inline-block; padding: 14px 32px; background: var(--text); color: #fff; text-decoration: none; font-size: 12px; letter-spacing: 2px; text-transform: uppercase;">Belanja Sekarang</a>
    </div>
    <div style="position: relative; z-index: 2; flex: 1; min-width: 220px;"></div>
</section>

{{-- 2. TEKS BERJALAN (MARQUEE) --}}
<div style="background: #fdebf2; padding: 16px 0; border-top: 1px solid #f4cfe0; border-bottom: 1px solid #f4cfe0; overflow: hidden; white-space: nowrap;">
    <div style="display: inline-block; animation: marquee 25s linear infinite; font-family: 'Playfair Display', serif; font-size: 20px; color: #7c3a56; font-style: italic;">
        @foreach(\App\Models\Category::all() as $cat)<span style="margin: 0 30px;">✦ {{ $cat->name }}</span>@endforeach
        @foreach(\App\Models\Category::all() as $cat)<span style="margin: 0 30px;">✦ {{ $cat->name }}</span>@endforeach
    </div>
</div>
<style>@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }</style>

{{-- 3. PILIHAN TERBAIK --}}
<section style="padding: 64px 8%; background: linear-gradient(180deg, #fff6fa 0%, #ffeef5 100%); border-top: 1px solid #f4cfe0;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; gap: 16px; flex-wrap: wrap;">
        <div>
            <p style="color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 6px;">Kurasi Pilihan</p>
            <h2 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin: 0;">Pilihan Terbaik</h2>
        </div>
        <a href="{{ route('products.index') }}" style="color: var(--accent); font-size: 13px; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--accent); padding-bottom: 2px;">Lihat Semua →</a>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(225px, 1fr)); gap: 22px;">
        @foreach(\App\Models\Product::latest()->take(4)->get() as $product)
        <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; display: block;">
            <div style="text-align: left; background: linear-gradient(180deg, #fffdfd 0%, #ffeaf2 100%); border: 1px solid #f2cde0; border-radius: 14px; padding: 12px; transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; box-shadow: 0 6px 18px rgba(219, 39, 119, 0.05);"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 12px 24px rgba(219, 39, 119, 0.12)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f2cde0'; this.style.boxShadow='0 6px 18px rgba(219, 39, 119, 0.05)';">
                <div style="position: relative; height: 210px; background: #fce2ed; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; font-size: 60px; border-radius: 10px; overflow: hidden;">
                    <span style="position: absolute; top: 10px; left: 10px; z-index: 2; background: rgba(255, 250, 252, 0.92); color: var(--accent); border: 1px solid #f5c2d9; font-size: 10px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; padding: 4px 9px; border-radius: 999px;">Pilihan</span>
                    @if($product->images)
                        <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                </div>
                <h3 style="font-size: 16px; font-family: 'Playfair Display', serif; font-weight: 600; margin: 0 0 6px; color: var(--text);">{{ $product->name }}</h3>
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                    <p style="color: var(--accent); font-weight: 700; font-size: 14px; margin: 0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <span style="font-size: 11px; font-weight: 600; color: #8a3b5c;">Detail →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- 4. JELAJAHI KATEGORI --}}
<section style="padding: 64px 8%; background: #fff1f6; border-top: 1px solid #f4cfe0;">
    <div style="text-align: center; margin-bottom: 40px;">
        <p style="color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 6px;">Kategori Produk</p>
        <h2 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Jelajahi Kategori</h2>
        <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Temukan perabot yang tepat untuk setiap sudut rumah.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 18px; max-width: 1060px; margin: auto;">
        @foreach(\App\Models\Category::all() as $cat)
        @php
            $nameLower = strtolower($cat->name);
            $badgeIcon = '✦';
            if (str_contains($nameLower, 'dapur')) { $badgeIcon = '🍽️'; }
            elseif (str_contains($nameLower, 'rumah') || str_contains($nameLower, 'perabot')) { $badgeIcon = '🏡'; }
            elseif (str_contains($nameLower, 'fashion') || str_contains($nameLower, 'pakaian')) { $badgeIcon = '👗'; }
            elseif (str_contains($nameLower, 'perawatan') || str_contains($nameLower, 'diri')) { $badgeIcon = '🌸'; }
            elseif (str_contains($nameLower, 'sendal') || str_contains($nameLower, 'aksesoris')) { $badgeIcon = '👜'; }
            elseif (str_contains($nameLower, 'tumbler') || str_contains($nameLower, 'botol') || str_contains($nameLower, 'minum')) { $badgeIcon = '🥤'; }
            elseif (str_contains($nameLower, 'timbangan') || str_contains($nameLower, 'kesehatan')) { $badgeIcon = '⚖️'; }
        @endphp
        <a href="{{ route('products.index') }}?category={{ $cat->id }}" style="text-decoration: none; display: block;">
            <div style="background: linear-gradient(180deg, #fffdfd 0%, #ffeaf2 100%); border: 1px solid #f2cde0; padding: 22px 16px; border-radius: 16px; text-align: center; transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; box-shadow: 0 4px 14px rgba(219, 39, 119, 0.04);"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 12px 24px rgba(219, 39, 119, 0.12)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f2cde0'; this.style.boxShadow='0 4px 14px rgba(219, 39, 119, 0.04)';">
                <div style="width: 54px; height: 54px; margin: 0 auto 14px; border-radius: 50%; background: #fce2ed; border: 1px solid #f7c2da; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    {{ $badgeIcon }}
                </div>
                <h3 style="font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--text); margin: 0 0 6px; line-height: 1.35;">{{ $cat->name }}</h3>
                <span style="display: inline-block; font-size: 11px; font-weight: 600; color: var(--accent); letter-spacing: 0.4px;">Lihat Koleksi →</span>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- 5. PROFIL OWNER (PALING BAWAH) --}}
<section style="padding: 64px 8%; background: linear-gradient(180deg, #fff6fa 0%, #ffe8f1 100%); border-top: 1px solid #f4cfe0;">
    <div style="max-width: 860px; margin: 0 auto; background: #fffafd; border: 1px solid #f2cde0; border-radius: 20px; padding: 32px 36px; display: flex; flex-wrap: wrap; align-items: center; gap: 32px; box-shadow: 0 12px 30px rgba(219, 39, 119, 0.07);">
        <div style="flex: 0 0 auto;">
            <div style="width: 132px; height: 132px; border-radius: 50%; padding: 4px; background: linear-gradient(135deg, #f9c5dc 0%, #ec4899 60%, #fde68a 100%); box-shadow: 0 10px 24px rgba(219, 39, 119, 0.14);">
                <img src="{{ asset('images/owner.jpeg') }}" alt="Petty Fariana - Founder Perikitty Olshop" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; object-position: 50% 20%; background: #261922; display: block;">
            </div>
        </div>
        <div style="flex: 1; min-width: 240px; text-align: left;">
            <p style="color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin: 0 0 6px;">Di Balik Perikitty</p>
            <h2 style="font-size: 26px; font-family: 'Playfair Display', serif; color: var(--text); margin: 0 0 4px; font-weight: 600;">Petty Fariana</h2>
            <p style="color: var(--text-muted); font-size: 13px; margin: 0 0 12px;">Founder Perikitty Olshop</p>
            <p style="color: var(--text-muted); font-size: 14px; line-height: 1.65; margin: 0 0 18px; font-style: italic;">"Menghadirkan perlengkapan rumah yang hangat, rapi, dan bikin betah setiap hari."</p>
            <a href="{{ route('about') }}" style="display: inline-block; padding: 10px 22px; background: var(--accent); color: #fff; text-decoration: none; font-size: 12px; font-weight: 600; border-radius: 999px; letter-spacing: 0.5px;">Kenali Kisah Kami →</a>
        </div>
    </div>
</section>

@endsection