@extends('layouts.app')

@section('title', 'Pesanan - Admin Perikitty')

@section('content')

<div style="max-width:1200px;margin:40px auto;padding:0 20px;">

    <div style="margin-bottom:25px;">
        <h1 style="margin:0 0 6px;">Pesanan</h1>
        <p style="margin:0;color:#777;">
            Pesanan yang masuk dari pembeli.
        </p>
    </div>

    @if ($orders->isEmpty())

        <div style="background:white;padding:35px;border-radius:14px;text-align:center;">
            <p style="margin:0;color:#777;">Belum ada pesanan.</p>
        </div>

    @else

        <div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05);">
            <div style="overflow-x:auto;">

                <table style="width:100%;border-collapse:collapse;">

                    <thead>
                        <tr style="background:#eaf5f6;">
                            <th style="padding:15px;text-align:left;">No. Pesanan</th>
                            <th style="padding:15px;text-align:left;">Tanggal</th>
                            <th style="padding:15px;text-align:left;">Pembeli</th>
                            <th style="padding:15px;text-align:left;">Kecamatan</th>
                            <th style="padding:15px;text-align:left;">Total</th>
                            <th style="padding:15px;text-align:left;">Status</th>
                            <th style="padding:15px;text-align:left;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($orders as $order)

                            <tr style="border-top:1px solid #eee;">

                                <td style="padding:15px;font-weight:bold;">
                                    {{ $order->order_number }}
                                </td>

                                <td style="padding:15px;color:#777;">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>

                                <td style="padding:15px;">
                                    {{ $order->customer_name }}
                                </td>

                                <td style="padding:15px;color:#777;">
                                    {{ $order->district ?? '-' }}
                                </td>

                                <td style="padding:15px;">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>

                                <td style="padding:15px;">
                                    <span style="background:#dff3ee;color:#0a3d4c;padding:6px 10px;border-radius:20px;font-size:13px;font-weight:bold;">
                                        {{ $statuses[$order->status] ?? $order->status }}
                                    </span>
                                </td>

                                <td style="padding:15px;">
                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="btn btn-outline"
                                    >
                                        Buka
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

    @endif

</div>

@endsection