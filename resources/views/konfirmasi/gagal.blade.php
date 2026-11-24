@extends('layouts.app')
@section('title', 'Pesanan Gagal - Perikitty')
@section('content')
<section style="padding: 90px 8%; min-height: 75vh; display: flex; justify-content: center; align-items: center; background: #fff;">
    <div style="background: #fff8f8; border: 1px solid #fecaca; padding: 52px 38px; border-radius: 24px; text-align: center; max-width: 520px; width: 100%; box-shadow: 0 12px 30px rgba(0,0,0,0.04);">
        <div style="width: 76px; height: 76px; margin: 0 auto 22px; border-radius: 50%; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 800;">&#10005;</div>
        <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 14px;">KONFIRMASI GAGAL</span>
        <h1 style="font-size: 30px; color: var(--text); margin-bottom: 12px;">Pesanan Gagal</h1>
        <p style="color: var(--text-muted); margin-bottom: 30px; line-height: 1.6;">Maaf, terjadi kendala saat memproses pesanan kamu. Silakan periksa kembali data lalu coba lagi.</p>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="width: 100%; display: block; padding: 15px; text-decoration: none; border-radius: 12px;">Kembali ke Checkout</a>
            <a href="{{ route('cart.index') }}" style="width: 100%; display: block; padding: 13px; text-decoration: none; border-radius: 12px; border: 1px solid var(--border); color: var(--text); font-weight: 600; background: #fff;">Cek Keranjang Belanja</a>
        </div>
    </div>
</section>
@endsection
