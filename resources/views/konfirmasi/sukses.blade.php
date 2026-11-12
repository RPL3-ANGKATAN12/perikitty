@extends('layouts.app')
@section('title', 'Pesanan Berhasil - Perikitty')
@section('content')
<section style="padding: 100px 8%; min-height: 80vh; display: flex; justify-content: center; align-items: center; background: var(--bg);">
    <div style="background: var(--surface); border: 1px solid var(--border); padding: 60px 40px; border-radius: 24px; text-align: center; max-width: 500px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <div style="font-size: 80px; margin-bottom: 24px;">✅</div>
        <h1 style="font-size: 32px; color: var(--text); margin-bottom: 16px;">Pesanan Berhasil!</h1>
        <p style="color: var(--text-muted); margin-bottom: 32px; line-height: 1.8;">Terima kasih sudah berbelanja di Perikitty. Pesanan kamu sedang kami proses.</p>
        <a href="{{ route('home') }}" class="btn btn-primary" style="width: 100%; display: block; padding: 16px;">Kembali ke Beranda</a>
    </div>
</section>
@endsection