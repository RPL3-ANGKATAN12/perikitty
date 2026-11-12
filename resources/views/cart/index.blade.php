@extends('layouts.app')
@section('title', 'Keranjang - Perikitty')

@section('content')
<section style="padding: 60px 5%; background: var(--bg); min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; color: var(--text); margin-bottom: 32px;">Keranjang Belanja</h1>
        <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px;">
            <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 80px; height: 80px; background: var(--bg-soft); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 30px;">☕</div>
                <div style="flex: 1;"><h3 style="font-size: 18px; color: var(--text); margin: 0 0 6px;">Tumbler Perikitty Premium</h3><p style="color: var(--text-muted); margin: 0;">2 x Rp 85.000</p></div>
                <div style="font-size: 18px; font-weight: 800; color: var(--accent);">Rp 170.000</div>
            </div>
            <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 80px; height: 80px; background: var(--bg-soft); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 30px;">🍳</div>
                <div style="flex: 1;"><h3 style="font-size: 18px; color: var(--text); margin: 0 0 6px;">Wajan Anti Lengket</h3><p style="color: var(--text-muted); margin: 0;">1 x Rp 120.000</p></div>
                <div style="font-size: 18px; font-weight: 800; color: var(--accent);">Rp 120.000</div>
            </div>
        </div>
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center;">
            <div><p style="color: var(--text-muted); margin: 0 0 4px;">Total Pembayaran</p><div style="font-size: 28px; font-weight: 800; color: var(--text);">Rp 290.000</div></div>
            <a href="#" class="btn btn-primary" style="padding: 16px 32px; font-size: 16px;">Lanjut ke Checkout →</a>
        </div>
    </div>
</section>
@endsection
