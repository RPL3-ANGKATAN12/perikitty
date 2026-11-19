@extends('layouts.app')
@section('title', 'Kisah Kami - Perikitty Olshop')
@section('content')
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        
        {{-- TOMBOL KEMBALI --}}
        <div style="margin-bottom: 30px;">
            <a href="{{ route('home') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 14px; font-weight: 600; text-decoration: none;">
                &larr; Kembali ke Beranda
            </a>
        </div>

        {{-- HEADER --}}
        <div style="text-align: center; margin-bottom: 40px;">
            <p style="color: var(--accent); font-size: 13px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 12px;">Kisah Kami</p>
            <h1 style="font-size: clamp(32px, 4vw, 42px); font-family: 'Playfair Display', serif; color: var(--text); margin: 0;">Perjalanan Perikitty Olshop</h1>
        </div>

        {{-- KONTEN UTAMA --}}
        <div style="display: grid; grid-template-columns: 350px 1fr; gap: 40px; align-items: start;">
            
            {{-- FOTO OWNER --}}
            <div style="position: sticky; top: 100px;">
                <div style="width: 100%; height: 400px; border-radius: 16px; overflow: hidden; border: 4px solid #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <img src="{{ asset('images/owner.jpeg') }}" alt="Petty Fariana" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            {{-- TEKS CERITA --}}
            <div>
                <h2 style="font-size: 28px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 4px;">Petty Fariana</h2>
                <p style="color: var(--accent); font-weight: 700; font-size: 14px; margin-bottom: 24px; letter-spacing: 1px;">Founder Perikitty Olshop</p>
                
                <div style="color: var(--text-muted); font-size: 15px; line-height: 1.8;">
                    <p style="margin-bottom: 16px;">
                        Semua dimulai pada tahun <strong>2020</strong>. Petty Fariana merintis Perikitty Olshop dari rumah, menjual berbagai peralatan rumah tangga seperti kipas, baskom, kuali, spatula set, hingga kotak bekal.
                    </p>
                    <p style="margin-bottom: 16px;">
                        Dulu, setiap hari hanya bisa mengirim sekitar <strong>20 paket</strong>. Namun dengan kerja keras, ketekunan, dan pelayanan yang tulus, usaha ini terus berkembang pesat.
                    </p>
                    <p style="margin-bottom: 24px;">
                        Kini, Perikitty Olshop telah memiliki toko sendiri dan pernah mencapai rekor pengiriman hingga <strong>700 paket dalam sehari!</strong> Sebuah pencapaian luar biasa yang berkat dukungan pelanggan setia.
                    </p>

                    {{-- KOTAK MEDIA SOSIAL --}}
                    <div style="background: #faf7f9; padding: 20px; border-radius: 12px; border-left: 4px solid var(--accent); margin-bottom: 24px;">
                        <h3 style="font-size: 16px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 6px;">Live Facebook & Instagram Setiap Hari!</h3>
                        <p style="font-size: 14px; margin: 0 0 16px 0;">Pantau terus promo dan produk terbaru dengan follow dan saksikan Live harian dari Petty Fariana.</p>
                        
                        {{-- TOMBOL FACEBOOK --}}
                        <a href="https://www.facebook.com/share/1A7vtzVGeD/" target="_blank" style="display: inline-block; padding: 10px 20px; background: #1877F2; color: #ffffff; font-weight: 700; text-decoration: none; border-radius: 8px; font-size: 14px; margin-right: 10px; margin-bottom: 10px;">Facebook</a>
                        
                        {{-- TOMBOL INSTAGRAM --}}
                        <a href="https://www.instagram.com/pettyfariana?lqvp=MXZ4M3lzbGpoMmd6NA==" target="_blank" style="display: inline-block; padding: 10px 20px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: #ffffff; font-weight: 700; text-decoration: none; border-radius: 8px; font-size: 14px; margin-bottom: 10px;">Instagram</a>
                    </div>
                </div>

                {{-- STATISTIK --}}
                <div style="display: flex; gap: 30px; border-top: 1px solid var(--border); padding-top: 20px;">
                    <div>
                        <p style="font-size: 28px; font-weight: 800; color: var(--accent); margin: 0; font-family: 'Playfair Display', serif;">2020</p>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 0; font-weight: 600;">Tahun Berdiri</p>
                    </div>
                    <div>
                        <p style="font-size: 28px; font-weight: 800; color: var(--accent); margin: 0; font-family: 'Playfair Display', serif;">700+</p>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 0; font-weight: 600;">Rekor Paket / Hari</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection