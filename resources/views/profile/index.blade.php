@extends('layouts.app')
@section('title', 'Pesanan Saya - Perikitty')
@section('content')
<section style="padding: 60px 8%; background: #ffffff; min-height: 80vh;">
    <div style="max-width: 1000px; margin: auto;">
        <h1 style="font-size: 32px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 30px;">Halo, {{ auth()->user()->name }}</h1>
        <h2 style="font-size: 24px; margin-bottom: 20px; color: var(--text);">Riwayat Pesanan</h2>
        
        <div style="background: #faf7f9; border-radius: 16px; border: 1px solid var(--border); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #fdf2f8; color: var(--text-muted); font-size: 13px;">
                    <tr>
                        <th style="padding: 16px 24px;">No. Pesanan</th>
                        <th style="padding: 16px 24px;">Total</th>
                        <th style="padding: 16px 24px;">Status</th>
                        <th style="padding: 16px 24px;">Tanggal</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px 24px; font-weight: 600;">{{ $order->order_number }}</td>
                        <td style="padding: 16px 24px; color: var(--accent); font-weight: 700;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td style="padding: 16px 24px;"><span style="background: rgba(216,91,155,0.1); color: var(--accent); padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 700;">{{ $order->status }}</span></td>
                        <td style="padding: 16px 24px;">{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="padding: 24px; text-align: center; color: var(--text-muted);">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection