@extends('layouts.admin')
@section('content')
    <div class="header">
        <h1>Data Produk (Tabel Master)</h1>
        <a href="{{ route('admin.create') }}" style="background: var(--accent); color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 14px;">+ Tambah Produk</a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">{{ session('success') }}</div>
    @endif

    <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--border);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc; color: #64748b; font-size: 13px; border-bottom: 1px solid var(--border);">
                <tr><th style="padding: 16px 24px;">Foto</th><th style="padding: 16px 24px;">Nama Produk</th><th style="padding: 16px 24px;">Harga</th><th style="padding: 16px 24px;">Stok</th><th style="padding: 16px 24px;">Aksi</th></tr>
            </thead>
            <tbody style="font-size: 14px;">
                @forelse($products as $p)
                @php $imgs = json_decode($p->images ?? '[]', true) ?: []; @endphp
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 16px 24px;"><div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden;"><img src="{{ isset($imgs[0]) ? asset('storage/' . $imgs[0]) : asset('images/produk1.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;"></div></td>
                    <td style="padding: 16px 24px; font-weight: 600; color: #0f172a;">{{ $p->name }}</td>
                    <td style="padding: 16px 24px; font-weight: 700;">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td style="padding: 16px 24px;">{{ $p->stock }}</td>
                    <td style="padding: 16px 24px; display: flex; gap: 8px;">
                        <a href="{{ route('admin.edit', $p->id) }}" style="background: #eab308; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px;">Edit</a>
                        <form action="{{ route('admin.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">@csrf @method('DELETE') <button type="submit" style="background: #ef4444; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 12px;">Hapus</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding: 24px; text-align: center; color: #888;">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection