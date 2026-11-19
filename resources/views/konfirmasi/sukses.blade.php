@extends('layouts.app')
@section('title', 'Pesanan Berhasil')
@section('content')
<section style="padding: 100px 8%; min-height: 80vh; display: flex; justify-content: center; align-items: center; background: #fff;">
    <div style="background: #faf7f9; border: 1px solid var(--border); padding: 60px 40px; border-radius: 24px; text-align: center; max-width: 500px; width: 100%;">
        <div style="font-size: 80px; margin-bottom: 24px;">✅</div>
        <h1 style="font-size: 32px; color: var(--text); margin-bottom: 16px;">Pesanan Berhasil!</h1>
        <p style="color: var(--text-muted); margin-bottom: 32px;">Terima kasih sudah berbelanja di Perikitty. Pesanan kamu sedang kami proses.</p>
        <a href="{{ route('profile.index') }}" class="btn btn-primary" style="width: 100%; display: block; padding: 16px; text-decoration: none;">Lihat Pesanan Saya</a>
    </div>
</section>
@endsection