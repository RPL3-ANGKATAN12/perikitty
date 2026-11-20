@extends('layouts.admin')
@section('content')
<style>
    .ord-page {
        display: flex;
        flex-direction: column;
        gap: 20px;
        color: #2d2429;
    }
    .ord-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        background: linear-gradient(120deg, #fff5f9 0%, #fffaf7 60%, #ffffff 100%);
        border: 1px solid #f7d8e8;
        padding: 24px 28px;
        border-radius: 20px;
        box-shadow: 0 10px 28px rgba(224, 98, 160, 0.08);
    }
    .ord-title { margin: 0; font-size: 25px; font-weight: 800; color: #261c22; }
    .ord-sub { margin: 4px 0 0; font-size: 13.5px; color: #6b5b63; }
    .ord-summary-box {
        background: #ffffff;
        border: 1.5px solid #f3d5e4;
        padding: 12px 18px;
        border-radius: 14px;
        font-size: 13.5px;
    }
    .ord-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        background: #ffffff;
        border: 1px solid #f5e1ec;
        padding: 14px 18px;
        border-radius: 16px;
    }
    .ord-search {
        flex: 1;
        min-width: 220px;
        padding: 11px 16px;
        border-radius: 11px;
        border: 1.5px solid #f0d7e5;
        background: #fffcfd;
        font-size: 14px;
        color: #261c22;
        outline: none;
    }
    .ord-filter-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }
    .ord-chip {
        border: 1px solid #f0d7e5;
        background: #fff9fc;
        color: #5c4d55;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .ord-chip.active {
        background: #ffe0ef;
        color: #a82b6a;
        border-color: #f2b4d3;
    }
    .ord-btn-csv {
        background: #fff5f9;
        color: #9e2f68;
        border: 1.5px solid #f2c4db;
        padding: 9px 15px;
        border-radius: 11px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
    }
    .ord-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #f5e1ec;
        box-shadow: 0 10px 26px rgba(224, 98, 160, 0.06);
        overflow-x: auto;
    }
    table.ord-tbl { width: 100%; border-collapse: collapse; text-align: left; }
    table.ord-tbl thead th {
        background: #fff2f8;
        color: #8c2d5e;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 20px;
        border-bottom: 1px solid #f5d6e6;
    }
    table.ord-tbl tbody tr { border-bottom: 1px solid #fdf2f7; }
    table.ord-tbl tbody tr:hover { background: #fff9fc; }
    table.ord-tbl tbody td { padding: 15px 20px; font-size: 14px; color: #3b3036; }
    .ord-badge {
        background: #dcfce7;
        color: #166534;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }
    .ord-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }
</style>

<div class="ord-page">
    <div class="ord-hero">
        <div>
            <h1 class="ord-title">Data Transaksi &amp; Pesanan</h1>
            <p class="ord-sub">Catatan pesanan yang masuk; penanganan lanjutan dilakukan melalui WhatsApp</p>
        </div>
        <div class="ord-summary-box">
            Total Tercatat: <strong>{{ $orders->count() }}</strong> &bull;
            Total Nilai: <strong style="color: #d44b8d;">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</strong>
        </div>
    </div>

    <div class="ord-toolbar">
        <input type="text" id="orderSearch" class="ord-search" placeholder="Cari no. pesanan, nama pemesan, atau alamat..." oninput="filterOrders()">
        <div class="ord-filter-group">
            <button type="button" class="ord-chip active" onclick="setOrderFilter('all', this)">Semua</button>
            <button type="button" class="ord-chip" onclick="setOrderFilter('pending', this)">Menunggu Kirim WA</button>
            <button type="button" class="ord-chip" onclick="setOrderFilter('wa', this)">Dialihkan ke WA</button>
            <button type="button" onclick="exportOrdersCsv()" class="ord-btn-csv">Unduh CSV</button>
        </div>
    </div>

    <div class="ord-card">
        <table class="ord-tbl" id="ordersTable">
            <thead>
                <tr>
                    <th>No. Pesanan</th>
                    <th>Pemesan</th>
                    <th>Tujuan Pengiriman</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    $buyerName = trim((string) (
                        $order->name
                        ?? $order->customer_name
                        ?? $order->recipient_name
                        ?? optional($order->user)->name
                        ?? ''
                    ));
                    $buyerNameDisplay = $buyerName !== '' ? $buyerName : 'Tanpa Nama';

                    $rawStatus = trim((string) ($order->status ?? ''));
                    $stLower = strtolower($rawStatus);
                    $isDraft = $rawStatus === '' || str_contains($stLower, 'draft') || str_contains($stLower, 'draf') || str_contains($stLower, 'belum') || str_contains($stLower, 'menunggu') || str_contains($stLower, 'pending');
                    $displayStatus = (str_contains($stLower, 'proses') || $rawStatus === '')
                        ? ($isDraft ? 'Menunggu Kirim WA' : 'Terkirim ke WA')
                        : $rawStatus;

                    $wilayahParts = array_values(array_filter([
                        trim((string) ($order->village ?? '')),
                        trim((string) ($order->district ?? '')),
                    ]));
                    $wilayahText = implode(', ', $wilayahParts);
                @endphp
                <tr class="order-row"
                    data-group="{{ $isDraft ? 'pending' : 'wa' }}"
                    data-search="{{ strtolower(($order->order_number ?? '') . ' ' . $buyerNameDisplay . ' ' . ($order->address ?? '') . ' ' . $wilayahText . ' ' . $displayStatus) }}"
                    data-order="{{ $order->order_number }}"
                    data-name="{{ $buyerNameDisplay }}"
                    data-total="{{ $order->total }}"
                    data-status="{{ $displayStatus }}">
                    <td style="font-weight: 700; color: #261c22;">{{ $order->order_number }}</td>
                    <td>
                        <strong>{{ $buyerNameDisplay }}</strong><br>
                        <span style="font-size: 12px; color: #7c6b73;">{{ $order->phone ?? '-' }}</span>
                    </td>
                    <td style="font-size: 13px;">
                        @if($wilayahText !== '')
                            <strong>{{ $wilayahText }}</strong><br>
                        @endif
                        <span style="color: #6b5b63;">{{ $order->address }}</span>
                    </td>
                    <td style="color: #d44b8d; font-weight: 800; white-space: nowrap;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td><span class="ord-badge {{ $isDraft ? 'pending' : '' }}">{{ $displayStatus }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding: 36px; text-align: center; color: #8c7b84;">Belum ada pesanan tercatat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    let orderGroupFilter = 'all';
    function setOrderFilter(group, btn) {
        orderGroupFilter = group;
        document.querySelectorAll('.ord-chip').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');
        filterOrders();
    }
    function filterOrders() {
        const q = (document.getElementById('orderSearch').value || '').toLowerCase().trim();
        document.querySelectorAll('.order-row').forEach(row => {
            const hay = row.dataset.search || '';
            const grp = row.dataset.group || 'wa';
            const matchSearch = !q || hay.includes(q);
            const matchGroup = orderGroupFilter === 'all' || grp === orderGroupFilter;
            row.style.display = (matchSearch && matchGroup) ? '' : 'none';
        });
    }
    function exportOrdersCsv() {
        const rows = [['No Pesanan', 'Pemesan', 'Total', 'Status']];
        document.querySelectorAll('.order-row').forEach(row => {
            if (row.style.display === 'none') return;
            rows.push([row.dataset.order, row.dataset.name, row.dataset.total, row.dataset.status]);
        });
        const csv = rows.map(r => r.map(v => '"' + String(v).replaceAll('"', '""') + '"').join(',')).join('\n');
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'data-transaksi-perikitty.csv';
        a.click();
        URL.revokeObjectURL(url);
    }
</script>
@endsection
