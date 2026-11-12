@extends('layouts.app')

@section('title', 'Perikitty Olshop - Peralatan Rumah Tangga')

@section('content')

@php
    $categories = \App\Models\Category::query()->orderBy('name')->take(6)->get();

    $latestProducts = \App\Models\Product::query()
        ->with('category')
        ->where('is_active', true)
        ->latest()
        ->take(8)
        ->get();

    $heroPhoto = file_exists(public_path('images/hero.jpg'));

    $iconStyle = 'width: 24px; height: 24px; fill: none; stroke: #1f3d36; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;';

    $reasons = [
        [
            'title' => 'Pilihan lengkap',
            'desc' => 'Perlengkapan untuk kebutuhan rumah sehari-hari, dari dapur sampai sudut ruangan.',
            'icon' => '<path d="M3 11l9-8 9 8v10H3z"/><path d="M9 21v-6h6v6"/>',
        ],
        [
            'title' => 'Stok terpantau',
            'desc' => 'Stok tiap produk ditampilkan, jadi kamu tahu mana yang masih tersedia.',
            'icon' => '<path d="M21 8l-9-5-9 5v8l9 5 9-5z"/><path d="M3 8l9 5 9-5"/><path d="M12 13v8"/>',
        ],
        [
            'title' => 'Antar di Batam',
            'desc' => 'Ongkir jelas per kecamatan, dan pesanan dikonfirmasi lewat WhatsApp.',
            'icon' => '<path d="M1 6h13v10H1z"/><path d="M14 9h4l3 3v4h-7z"/><circle cx="5.5" cy="18.5" r="2"/><circle cx="17.5" cy="18.5" r="2"/>',
        ],
    ];
@endphp

{{-- Banner utama --}}
<section style="
    background: linear-gradient(135deg, #1f3d36 0%, #2b5047 55%, #3a6659 100%);
    color: #faf6ef;
    position: relative;
    overflow: hidden;
">
    <div style="position: absolute; width: 380px; height: 380px; border-radius: 50%; background: rgba(196, 89, 47, 0.2); top: -140px; right: -100px;"></div>
    <div style="position: absolute; width: 240px; height: 240px; border-radius: 50%; background: rgba(250, 246, 239, 0.06); bottom: -90px; left: -60px;"></div>

    <div style="
        position: relative;
        max-width: 1100px;
        margin: auto;
        padding: 70px 6% 80px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
        gap: 40px;
        align-items: center;
    ">

        <div>
            <div style="
                display: inline-block;
                background: rgba(250, 246, 239, 0.12);
                padding: 7px 16px;
                border-radius: 999px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 22px;
            ">
                Pengiriman khusus Batam
            </div>

            <h1 style="
                font-size: clamp(32px, 5.5vw, 54px);
                line-height: 1.1;
                margin: 0 0 18px;
            ">
                Rumah yang nyaman, mulai dari perlengkapan yang tepat.
            </h1>

            <p style="
                font-size: 17px;
                color: #c8d6cf;
                max-width: 520px;
                margin: 0 0 32px;
            ">
                Peralatan dapur, kebersihan, sampai penataan ruangan. Pilih, pesan, dan konfirmasi lewat WhatsApp.
            </p>

            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                <a href="{{ route('products.index') }}" class="btn btn-primary" style="padding: 16px 30px; font-size: 15px;">
                    Belanja Sekarang
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="btn"
                    style="padding: 16px 30px; font-size: 15px; background: transparent; border: 1.5px solid rgba(250, 246, 239, 0.4); color: #faf6ef;"
                >
                    Lihat Kategori
                </a>
            </div>
        </div>

        <div>
            @if ($heroPhoto)

                <img
                    src="{{ asset('images/hero.jpg') }}"
                    alt="Peralatan rumah tangga"
                    style="
                        width: 100%;
                        height: 400px;
                        object-fit: cover;
                        border-radius: 28px;
                        box-shadow: 0 24px 50px rgba(0, 0, 0, 0.25);
                        display: block;
                    "
                >

            @else

                <svg
                    viewBox="0 0 520 440"
                    xmlns="http://www.w3.org/2000/svg"
                    role="img"
                    aria-label="Ilustrasi peralatan rumah tangga"
                    style="width: 100%; max-width: 480px; height: auto; display: block; margin: auto;"
                >
                    <circle cx="260" cy="215" r="195" fill="rgba(250,246,239,0.08)"/>

                    <rect x="120" y="70" width="280" height="8" rx="4" fill="#f1e9da"/>
                    <circle cx="170" cy="82" r="5" fill="#c4592f"/>
                    <circle cx="254" cy="82" r="5" fill="#c4592f"/>
                    <circle cx="352" cy="82" r="5" fill="#c4592f"/>

                    <rect x="166" y="82" width="8" height="68" rx="4" fill="#faf6ef"/>
                    <ellipse cx="170" cy="166" rx="22" ry="18" fill="#faf6ef"/>

                    <rect x="250" y="82" width="8" height="78" rx="4" fill="#d9794f"/>
                    <rect x="240" y="158" width="28" height="42" rx="9" fill="#d9794f"/>

                    <rect x="330" y="82" width="44" height="76" rx="7" fill="#faf6ef"/>
                    <rect x="330" y="112" width="44" height="10" fill="#c4592f"/>
                    <rect x="330" y="128" width="44" height="5" fill="#c4592f" opacity="0.6"/>

                    <path d="M440 105 L444 116 L455 120 L444 124 L440 135 L436 124 L425 120 L436 116 Z" fill="#d9794f"/>
                    <path d="M92 168 L95 176 L103 179 L95 182 L92 190 L89 182 L81 179 L89 176 Z" fill="#faf6ef" opacity="0.7"/>

                    <path d="M110 352 L110 394 L152 352 Z" fill="#f1e9da" opacity="0.85"/>
                    <path d="M410 352 L410 394 L368 352 Z" fill="#f1e9da" opacity="0.85"/>
                    <rect x="40" y="330" width="440" height="22" rx="11" fill="#f1e9da"/>
                    <rect x="60" y="352" width="400" height="8" rx="4" fill="rgba(0,0,0,0.14)"/>

                    <rect x="48" y="268" width="26" height="13" rx="6.5" fill="#a94a25"/>
                    <rect x="196" y="268" width="26" height="13" rx="6.5" fill="#a94a25"/>
                    <rect x="70" y="246" width="130" height="84" rx="18" fill="#c4592f"/>
                    <rect x="62" y="232" width="146" height="18" rx="9" fill="#d9794f"/>
                    <circle cx="135" cy="224" r="9" fill="#faf6ef"/>
                    <circle cx="112" cy="284" r="4" fill="#faf6ef"/>
                    <circle cx="158" cy="284" r="4" fill="#faf6ef"/>
                    <path d="M122 298 Q135 310 148 298" stroke="#faf6ef" stroke-width="3" fill="none" stroke-linecap="round"/>

                    <path d="M258 258 q-8 -13 0 -26" stroke="rgba(250,246,239,0.5)" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <path d="M282 258 q-8 -13 0 -26" stroke="rgba(250,246,239,0.5)" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <path d="M305 288 C335 288 335 322 305 322" stroke="#faf6ef" stroke-width="9" fill="none" stroke-linecap="round"/>
                    <rect x="235" y="272" width="70" height="58" rx="14" fill="#faf6ef"/>
                    <rect x="235" y="296" width="70" height="12" fill="#3a6659"/>

                    <ellipse cx="378" cy="282" rx="10" ry="24" transform="rotate(-35 378 282)" fill="#8fb7a3"/>
                    <ellipse cx="422" cy="282" rx="10" ry="24" transform="rotate(35 422 282)" fill="#8fb7a3"/>
                    <ellipse cx="400" cy="262" rx="11" ry="34" fill="#a9cbb9"/>
                    <path d="M370 300 H430 L422 330 H378 Z" fill="#d9794f"/>
                </svg>

            @endif
        </div>

    </div>
</section>

{{-- Kategori --}}
@if ($categories->count())

    <section style="max-width: 1100px; margin: auto; padding: 70px 6% 20px;">

        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 10px; margin-bottom: 26px;">
            <div>
                <h2 style="margin: 0 0 6px; color: #2b2a26; font-size: 30px;">Belanja per kategori</h2>
                <p style="margin: 0; color: #6f6b61;">Temukan yang kamu butuhkan lebih cepat.</p>
            </div>

            <a href="{{ route('categories.index') }}" style="color: #c4592f; font-weight: 700;">
                Semua kategori
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(170px, 100%), 1fr)); gap: 16px;">

            @foreach ($categories as $category)
                <a
                    href="{{ route('products.index', ['kategori' => $category->id]) }}"
                    style="
                        background: #ffffff;
                        border: 1px solid #e8e0d2;
                        border-radius: 18px;
                        padding: 26px 18px;
                        text-align: center;
                        font-weight: 700;
                        color: #2b2a26;
                    "
                >
                    {{ $category->name }}
                </a>
            @endforeach

        </div>

    </section>

@endif

{{-- Produk terbaru --}}
@if ($latestProducts->count())

    <section style="max-width: 1100px; margin: auto; padding: 60px 6% 20px;">

        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 10px; margin-bottom: 26px;">
            <div>
                <h2 style="margin: 0 0 6px; color: #2b2a26; font-size: 30px;">Produk terbaru</h2>
                <p style="margin: 0; color: #6f6b61;">Baru masuk dan siap dikirim.</p>
            </div>

            <a href="{{ route('products.index') }}" style="color: #c4592f; font-weight: 700;">
                Lihat semua produk
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(220px, 100%), 1fr)); gap: 22px;">

            @foreach ($latestProducts as $product)

                <a
                    href="{{ route('products.show', $product) }}"
                    style="text-decoration: none; color: inherit; display: block;"
                >
                    <div style="
                        background: #ffffff;
                        border: 1px solid #e8e0d2;
                        border-radius: 18px;
                        overflow: hidden;
                    ">

                        @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                style="width: 100%; height: 200px; object-fit: cover; display: block;"
                            >
                        @else
                            <div style="
                                height: 200px;
                                background: #f3ece0;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: #9a8f7c;
                            ">
                                Tidak ada foto
                            </div>
                        @endif

                        <div style="padding: 16px 18px 20px;">

                            @if ($product->category)
                                <div style="font-size: 12px; color: #6f6b61; margin-bottom: 6px; font-weight: 600;">
                                    {{ $product->category->name }}
                                </div>
                            @endif

                            <h3 style="margin: 0 0 8px; color: #2b2a26; font-size: 17px;">
                                {{ $product->name }}
                            </h3>

                            <div style="color: #c4592f; font-size: 18px; font-weight: 700;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                        </div>
                    </div>
                </a>

            @endforeach

        </div>

    </section>

@endif

{{-- Alasan belanja --}}
<section style="max-width: 1100px; margin: auto; padding: 60px 6% 80px;">

    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="margin: 0 0 8px; color: #2b2a26; font-size: 30px;">Kenapa belanja di Perikitty?</h2>
        <p style="margin: 0; color: #6f6b61;">Belanja kebutuhan rumah jadi lebih mudah.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(240px, 100%), 1fr)); gap: 18px;">

        @foreach ($reasons as $reason)
            <div style="
                background: #ffffff;
                border: 1px solid #e8e0d2;
                border-radius: 18px;
                padding: 28px 24px;
            ">
                <div style="
                    width: 46px;
                    height: 46px;
                    border-radius: 14px;
                    background: #e3eee8;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                ">
                    <svg viewBox="0 0 24 24" style="{{ $iconStyle }}">{!! $reason['icon'] !!}</svg>
                </div>

                <h3 style="margin: 0 0 8px; color: #2b2a26; font-size: 19px;">
                    {{ $reason['title'] }}
                </h3>

                <p style="margin: 0; color: #6f6b61; line-height: 1.7;">
                    {{ $reason['desc'] }}
                </p>
            </div>
        @endforeach

    </div>

</section>

@endsection