@extends('layouts.admin')
@section('content')
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Data Pesanan (Tabel Transaksi)</h1>
            <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Rekap transaksi masuk pelanggan Perikitty</p>
        </div>
        <div style="background: #fdf2f8; border: 1px solid var(--border); padding: 12px 18px; border-radius: 10px; font-size: 14px;">
            Total Transaksi: <strong>{{ $orders->count() }}</strong> | Total Nilai: <strong style="color: var(--accent);">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</strong>
        </div>
    </div>

    <div style="background: #fff; border-radius: 12px; overflow-x: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--border);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #fdf2f8; color: #64748b; font-size: 13px; border-bottom: 1px solid var(--border);">
                <tr>
                    <th style="padding: 16px 24px;">No. Pesanan</th>
                    <th style="padding: 16px 24px;">Pemesan</th>
                    <th style="padding: 16px 24px;">Tujuan</th>
                    <th style="padding: 16px 24px;">Total</th>
                    <th style="padding: 16px 24px;">Status</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                @forelse($orders as $order)
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 16px 24px; font-weight: 600; color: #0f172a;">{{ $order->order_number }}</td>
                    <td style="padding: 16px 24px;">{{ $order->name }}<br><span style="font-size: 12px; color: #64748b;">{{ $order->phone ?? '-' }}</span></td>
                    <td style="padding: 16px 24px; font-size: 13px;">
                        @if(!empty($order->district))
                            {{ $order->village }}, {{ $order->district }}<br>
                        @endif
                        <span style="color: #64748b;">{{ $order->address }}</span>
                    </td>
                    <td style="padding: 16px 24px; color: var(--accent); font-weight: 700;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td style="padding: 16px 24px;"><span style="background: #e0f2fe; color: #0284c7; padding: 5px 12px; border-radius: 100px; font-size: 12px; font-weight: 700;">{{ $order->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding: 28px; text-align: center; color: #888;">Belum ada pesanan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
