@extends('layouts.app')
@section('title', 'Admin - Perikitty')
@section('content')
<section style="padding: 60px 8%; min-height: 80vh;">
    <h1 style="font-size: 36px; margin-bottom: 40px;">Dashboard Admin</h1>
    
    {{-- DATA MASTER (PRODUK) --}}
    <div style="margin-bottom: 60px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 24px;">Data Master (Produk)</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Tambah Produk</a>
        </div>
        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: var(--surface); color: var(--text-muted); font-size: 13px;">
                    <tr><th style="padding: 16px 24px;">Nama Produk</th><th style="padding: 16px 24px;">Harga</th><th style="padding: 16px 24px;">Stok</th><th style="padding: 16px 24px;">Aksi</th></tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @forelse($products as $p)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px 24px; font-weight: 600;">{{ $p->name }}</td>
                        <td style="padding: 16px 24px; color: var(--accent); font-weight: 700;">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td style="padding: 16px 24px;">{{ $p->stock }}</td>
                        <td style="padding: 16px 24px;">
                            <form action="{{ route('admin.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 12px; border-color: #ef4444; color: #ef4444;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="padding: 24px; text-align: center;">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- DATA TRANSAKSI (PESANAN) --}}
    <div>
        <h2 style="font-size: 24px; margin-bottom: 20px;">Data Transaksi (Pesanan Masuk)</h2>
        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: var(--surface); color: var(--text-muted); font-size: 13px;">
                    <tr><th style="padding: 16px 24px;">No. Pesanan</th><th style="padding: 16px 24px;">Nama</th><th style="padding: 16px 24px;">Total</th><th style="padding: 16px 24px;">Status</th></tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @forelse($orders as $o)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px 24px; font-weight: 600;">{{ $o->order_number }}</td>
                        <td style="padding: 16px 24px;">{{ $o->name }}</td>
                        <td style="padding: 16px 24px; color: var(--accent); font-weight: 700;">Rp {{ number_format($o->total, 0, ',', '.') }}</td>
                        <td style="padding: 16px 24px;"><span style="background: rgba(216, 91, 155, 0.1); color: var(--accent); padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 700;">{{ $o->status }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="padding: 24px; text-align: center;">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection