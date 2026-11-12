@extends('layouts.app')
@section('title', 'Checkout - Perikitty')

@section('content')
<section style="padding: 60px 5%; background: var(--bg); min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; color: var(--text); margin-bottom: 32px;">Checkout Pesanan</h1>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
            <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 32px;">
                <h2 style="font-size: 20px; color: var(--text); margin-bottom: 24px;">Detail Pengiriman</h2>
                <div style="margin-bottom: 20px;"><label style="color: var(--text-muted); font-size: 14px;">Nama Penerima</label><input type="text" value="Zaskia Ananda" style="width: 100%; padding: 14px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></div>
                <div style="margin-bottom: 20px;"><label style="color: var(--text-muted); font-size: 14px;">No. WhatsApp</label><input type="text" value="081234567890" style="width: 100%; padding: 14px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);"></div>
                <div style="margin-bottom: 24px;"><label style="color: var(--text-muted); font-size: 14px;">Alamat Lengkap</label><textarea rows="3" style="width: 100%; padding: 14px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text);">Jl. Merdeka No. 10, Jakarta</textarea></div>
                <button class="btn btn-primary" style="width: 100%; padding: 16px;">Buat Pesanan Sekarang</button>
            </div>
            <div style="background: var(--bg-soft); border: 1px solid var(--border); border-radius: 16px; padding: 32px;">
                <h2 style="font-size: 20px; color: var(--text); margin-bottom: 24px;">Ringkasan Pesanan</h2>
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px;"><span style="color: var(--text-muted);">Wajan Anti Lengket (x1)</span><span style="color: var(--text); font-weight: 600;">Rp 150.000</span></div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px;"><span style="color: var(--text-muted);">Tumbler Premium (x2)</span><span style="color: var(--text); font-weight: 600;">Rp 170.000</span></div>
                <hr style="border: none; border-top: 1px dashed var(--border); margin: 20px 0;">
                <div style="display: flex; justify-content: space-between; align-items: center;"><span style="color: var(--text-muted); font-weight: 600;">Total</span><span style="color: var(--accent); font-size: 24px; font-weight: 800;">Rp 320.000</span></div>
            </div>
        </div>
    </div>
</section>
@endsection
