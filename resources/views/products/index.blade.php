@extends('layouts.app')
@section('title', 'Semua Koleksi - Perikitty')
@section('content')

@php
    $allCategories = $categories ?? \App\Models\Category::all();
    $selectedCatId = request('category');
    $listProducts = $products ?? \App\Models\Product::when($selectedCatId, fn($q) => $q->where('category_id', $selectedCatId))->when(request('q'), fn($q) => $q->where('name', 'like', '%' . request('q') . '%'))->latest()->get();
@endphp

<section style="padding: 52px 8% 72px; min-height: 75vh; background: linear-gradient(180deg, #fff4f8 0%, #fff9fb 45%, #fff3f8 100%);">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px; margin-bottom: 28px;">
        <div>
            <p style="color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin: 0 0 6px;">Katalog Perikitty</p>
            <h1 style="font-size: clamp(30px, 3.6vw, 40px); font-family: 'Playfair Display', serif; color: var(--text); margin: 0 0 6px; font-weight: 600;">Semua Koleksi</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Temukan perabot impianmu di sini.</p>
        </div>

        <form action="{{ route('products.index') }}" method="GET" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
            @if($selectedCatId)
                <input type="hidden" name="category" value="{{ $selectedCatId }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari barang..." style="padding: 10px 16px; border-radius: 999px; border: 1px solid #f0c9dc; background: #fffdfd; color: var(--text); font-size: 13px; min-width: 210px; outline: none;" data-pk-search="1">
            <button type="submit" style="padding: 10px 20px; border-radius: 999px; border: none; background: var(--accent); color: #fff; font-size: 12px; font-weight: 700; cursor: pointer; letter-spacing: 0.5px;">Cari</button>
        </form>
    </div>

    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 34px; padding-bottom: 16px; border-bottom: 1px solid #f4cfe0;">
        <a href="{{ route('products.index') }}" style="text-decoration: none; padding: 8px 16px; border-radius: 999px; font-size: 12px; font-weight: 700; border: 1px solid {{ empty($selectedCatId) ? 'var(--accent)' : '#f2cde0' }}; background: {{ empty($selectedCatId) ? 'var(--accent)' : '#fff6fa' }}; color: {{ empty($selectedCatId) ? '#fff' : '#7c3a56' }};">
            Semua
        </a>
        @foreach($allCategories as $cat)
            @php $isActive = (string)$selectedCatId === (string)$cat->id; @endphp
            <a href="{{ route('products.index') }}?category={{ $cat->id }}" style="text-decoration: none; padding: 8px 16px; border-radius: 999px; font-size: 12px; font-weight: 700; border: 1px solid {{ $isActive ? 'var(--accent)' : '#f2cde0' }}; background: {{ $isActive ? 'var(--accent)' : '#fff6fa' }}; color: {{ $isActive ? '#fff' : '#7c3a56' }};">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    @if(count($listProducts) > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 22px;" data-pk-grid="1">
            @foreach($listProducts as $product)
            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; display: block;">
                <div style="background: linear-gradient(180deg, #fffdfd 0%, #ffeaf2 100%); border: 1px solid #f2cde0; border-radius: 16px; padding: 12px; height: 100%; transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; box-shadow: 0 6px 18px rgba(219, 39, 119, 0.05);"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'; this.style.boxShadow='0 12px 24px rgba(219, 39, 119, 0.12)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f2cde0'; this.style.boxShadow='0 6px 18px rgba(219, 39, 119, 0.05)';">
                    <div style="height: 205px; background: #fce2ed; border-radius: 11px; overflow: hidden; margin-bottom: 12px; display: flex; align-items: center; justify-content: center;">
                        @if($product->images)
                            @php $imgs = json_decode($product->images, true) ?? []; @endphp
                            @if(count($imgs) > 0)
                                <img src="{{ asset('storage/' . $imgs[0]) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        @else
                            <img src="{{ asset('images/produk' . (($loop->iteration % 3) + 1) . '.jpg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <p style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #9d4b6c; margin: 0 0 4px;">Perikitty Collection</p>
                    <h2 style="font-size: 15px; font-family: 'Playfair Display', serif; font-weight: 600; color: var(--text); margin: 0 0 8px; line-height: 1.35;">{{ $product->name }}</h2>
                    <p style="color: var(--accent); font-weight: 700; font-size: 14px; margin: 0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 56px 24px; background: #fff7fa; border: 1px solid #f2cde0; border-radius: 18px; max-width: 520px; margin: 24px auto 0;">
            <p style="font-family: 'Playfair Display', serif; font-size: 20px; color: var(--text); margin: 0 0 8px;">Belum ada produk di kategori ini</p>
            <p style="color: var(--text-muted); font-size: 13px; margin: 0 0 18px;">Coba pilih kategori lain atau reset filter pencarian.</p>
            <a href="{{ route('products.index') }}" style="display: inline-block; padding: 10px 22px; background: var(--accent); color: #fff; text-decoration: none; border-radius: 999px; font-size: 12px; font-weight: 700;">Lihat Semua Koleksi</a>
        </div>
    @endif
</section>


<!-- PERIKITTY_LIVE_SEARCH -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('[data-pk-search="1"]') || document.querySelector('input[name="q"]');
    if (!input) return;

    const form = input.closest('form');
    const grid = document.querySelector('[data-pk-grid="1"]') || Array.from(document.querySelectorAll('div')).find(function (el) {
        return el.style && el.style.display === 'grid' && el.children.length > 0;
    });

    if (!grid) return;

    const cards = Array.from(grid.children);

    let emptyBox = document.querySelector('[data-pk-empty="1"]');
    if (!emptyBox) {
        emptyBox = document.createElement('div');
        emptyBox.setAttribute('data-pk-empty', '1');
        emptyBox.style.cssText = 'display:none;text-align:center;padding:56px 24px;background:#fff7fa;border:1px solid #f2cde0;border-radius:18px;max-width:520px;margin:24px auto 0;';
        emptyBox.innerHTML = '<p style="font-family:\'Playfair Display\',serif;font-size:20px;color:var(--text,#1f2937);margin:0 0 8px;">Produk tidak ditemukan</p><p style="color:var(--text-muted,#6b7280);font-size:13px;margin:0 0 18px;">Coba kata kunci lain atau kosongkan kolom pencarian.</p><button type="button" data-pk-reset style="padding:10px 22px;background:var(--accent,#db2777);color:#fff;border:none;border-radius:999px;font-size:12px;font-weight:700;cursor:pointer;">Reset Pencarian</button>';
        grid.parentNode.insertBefore(emptyBox, grid.nextSibling);

        const resetBtn = emptyBox.querySelector('[data-pk-reset]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                input.value = '';
                runFilter('');
                input.focus();
            });
        }
    }

    function runFilter(val) {
        const q = (val || '').trim().toLowerCase();
        let shown = 0;

        cards.forEach(function (card) {
            const heading = card.querySelector('h2, h3');
            const haystack = ((heading ? heading.textContent : '') + ' ' + (card.textContent || '')).toLowerCase();
            const isMatch = !q || haystack.indexOf(q) !== -1;
            card.style.display = isMatch ? '' : 'none';
            if (isMatch) shown++;
        });

        grid.style.display = shown > 0 ? 'grid' : 'none';
        emptyBox.style.display = shown === 0 ? 'block' : 'none';

        try {
            const url = new URL(window.location.href);
            if (q) {
                url.searchParams.set('q', val.trim());
            } else {
                url.searchParams.delete('q');
            }
            window.history.replaceState({}, '', url.toString());
        } catch (e) {}
    }

    let debounceTimer = null;
    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const current = input.value;
        debounceTimer = setTimeout(function () {
            runFilter(current);
        }, 150);
    });

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            clearTimeout(debounceTimer);
            runFilter(input.value);
        });
    }

    if (input.value && input.value.trim() !== '') {
        runFilter(input.value);
    }
});
</script>
<!-- END_PERIKITTY_LIVE_SEARCH -->

@endsection

