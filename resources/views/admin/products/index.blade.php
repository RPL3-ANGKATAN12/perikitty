@extends('layouts.app')

@section('title', 'Produk - Admin Perikitty')

@section('content')

<div style="max-width:1200px;margin:40px auto;padding:0 20px;">

    <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;margin-bottom:25px;flex-wrap:wrap;">
        <div>
            <h1 style="margin:0 0 6px;">Produk</h1>
            <p style="margin:0;color:#777;">
                Kelola produk Perikitty Olshop.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($products->isEmpty())

        <div style="background:white;padding:35px;border-radius:14px;text-align:center;">
            <p style="margin:0;color:#777;">Belum ada produk.</p>
        </div>

    @else

        <div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05);">
            <div style="overflow-x:auto;">

                <table style="width:100%;border-collapse:collapse;">

                    <thead>
                        <tr style="background:#f3ece0;">
                            <th style="padding:15px;text-align:left;">No</th>
                            <th style="padding:15px;text-align:left;">Foto</th>
                            <th style="padding:15px;text-align:left;">Produk</th>
                            <th style="padding:15px;text-align:left;">Kategori</th>
                            <th style="padding:15px;text-align:left;">Harga</th>
                            <th style="padding:15px;text-align:left;">Stok</th>
                            <th style="padding:15px;text-align:left;">Status</th>
                            <th style="padding:15px;text-align:left;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($products as $product)

                            <tr style="border-top:1px solid #eee;">

                                <td style="padding:15px;">
                                    {{ $loop->iteration }}
                                </td>

                                <td style="padding:15px;">

                                    @if ($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            style="width:70px;height:70px;object-fit:cover;border-radius:10px;"
                                        >
                                    @else
                                        <div style="width:70px;height:70px;background:#f5f5f5;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">
                                            No Foto
                                        </div>
                                    @endif

                                </td>

                                <td style="padding:15px;font-weight:bold;">
                                    {{ $product->name }}
                                </td>

                                <td style="padding:15px;color:#777;">
                                    {{ $product->category?->name ?? '-' }}
                                </td>

                                <td style="padding:15px;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td style="padding:15px;">
                                    {{ $product->stock }}
                                </td>

                                <td style="padding:15px;">

                                    @if ($product->is_active)
                                        <span style="background:#e8f8ee;color:#198754;padding:6px 10px;border-radius:20px;font-size:13px;font-weight:bold;">
                                            Aktif
                                        </span>
                                    @else
                                        <span style="background:#f1f1f1;color:#777;padding:6px 10px;border-radius:20px;font-size:13px;font-weight:bold;">
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>

                                <td style="padding:15px;">

                                    <div style="display:flex;gap:8px;flex-wrap:wrap;">

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-outline"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                style="border:1px solid #dc3545;color:#dc3545;background:white;padding:10px 17px;border-radius:10px;font-weight:bold;cursor:pointer;"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

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