@extends('layouts.app')
@section('title', 'Pesanan Berhasil - Perikitty')
@section('content')
<section style="padding: 90px 8%; min-height: 75vh; display: flex; justify-content: center; align-items: center; background: #fff;">
    <div style="background: #faf7f9; border: 1px solid var(--border); padding: 52px 38px; border-radius: 24px; text-align: center; max-width: 520px; width: 100%; box-shadow: 0 12px 30px rgba(0,0,0,0.04);">
        <div style="width: 76px; height: 76px; margin: 0 auto 22px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 38px; font-weight: 800;">&#10003;</div>
        <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 14px;">KONFIRMASI BERHASIL</span>
        <h1 style="font-size: 30px; color: var(--text); margin-bottom: 12px;">Pesanan Berhasil!</h1>
        <p style="color: var(--text-muted); margin-bottom: 30px; line-height: 1.6;">Terima kasih sudah berbelanja di Perikitty. Pesanan kamu sudah tercatat dan sedang kami proses.</p>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="{{ route('profile.index') }}" class="btn btn-primary" style="width: 100%; display: block; padding: 15px; text-decoration: none; border-radius: 12px;">Lihat Pesanan Saya</a>
            <a href="{{ route('home') }}" style="width: 100%; display: block; padding: 13px; text-decoration: none; border-radius: 12px; border: 1px solid var(--border); color: var(--text); font-weight: 600; background: #fff;">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@if(session('wa_url'))
<div style="max-width:560px; margin:0 auto 40px; padding:0 20px;">
    <a href="{{ session('wa_url') }}" style="display:block; text-align:center; padding:16px; border-radius:12px; background:#25D366; color:#fff; font-weight:700; text-decoration:none;">Lanjut Kirim Pesanan ke WhatsApp</a>
</div>
@endif
@endsection
