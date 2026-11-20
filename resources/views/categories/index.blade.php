@extends('layouts.app')
@section('title', 'Semua Kategori - Perikitty')
@section('content')

@php
    $allCategories = $categories ?? \App\Models\Category::withCount('products')->get();
@endphp

<section style="padding: 56px 8% 72px; min-height: 75vh; background: linear-gradient(180deg, #fff4f8 0%, #ffeef5 55%, #fff8fb 100%);">
    <div style="text-align: center; max-width: 640px; margin: 0 auto 44px;">
        <span style="display: inline-block; background: #fce2ed; color: var(--accent); border: 1px solid #f5c2d9; font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; padding: 6px 14px; border-radius: 999px; margin-bottom: 14px;">Eksplorasi Katalog</span>
        <h1 style="font-size: clamp(30px, 3.8vw, 42px); font-family: 'Playfair Display', serif; color: var(--text); margin: 0 0 10px; font-weight: 600;">Semua Kategori</h1>
        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.65; margin: 0;">Pilih kategori favoritmu untuk melihat koleksi peralatan dan kebutuhan rumah pilihan.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; max-width: 1100px; margin: 0 auto;">
        @foreach($allCategories as $cat)
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
            $count = $cat->products_count ?? ($cat->products->count() ?? 0);
        @endphp
        <a href="{{ route('products.index') }}?category={{ $cat->id }}" style="text-decoration: none; display: block;">
            <div style="background: linear-gradient(180deg, #fffdfd 0%, #ffe8f1 100%); border: 1px solid #f2cde0; border-radius: 18px; padding: 24px 20px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; gap: 18px; transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; box-shadow: 0 8px 20px rgba(219, 39, 119, 0.05);"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 14px 28px rgba(219, 39, 119, 0.13)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f2cde0'; this.style.boxShadow='0 8px 20px rgba(219, 39, 119, 0.05)';">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                    <div style="width: 54px; height: 54px; border-radius: 16px; background: #fce2ed; border: 1px solid #f5c2d9; display: flex; align-items: center; justify-content: center; font-size: 25px; flex-shrink: 0;">
                        {{ $badgeIcon }}
                    </div>
                    <span style="background: #fff6fa; color: var(--accent); border: 1px solid #f4cfe0; font-size: 11px; font-weight: 700; padding: 5px 11px; border-radius: 999px; white-space: nowrap;">
                        {{ $count }} Produk
                    </span>
                </div>
                <div>
                    <h2 style="font-size: 17px; font-family: 'Playfair Display', serif; font-weight: 600; color: var(--text); margin: 0 0 8px; line-height: 1.35;">{{ $cat->name }}</h2>
                    <span style="display: inline-block; font-size: 12px; font-weight: 700; color: var(--accent);">Lihat Koleksi →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection