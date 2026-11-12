@extends('layouts.app')

@section('title', 'Kategori - Admin Perikitty')

@section('content')

<div style="max-width:1100px;margin:40px auto;padding:0 20px;">

    <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;margin-bottom:25px;flex-wrap:wrap;">
        <div>
            <h1 style="margin:0 0 6px;">Kategori</h1>
            <p style="margin:0;color:#777;">
                Kelola kategori produk Perikitty Olshop.
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($categories->isEmpty())

        <div style="background:white;padding:35px;border-radius:14px;text-align:center;">
            <p style="margin:0;color:#777;">Belum ada kategori.</p>
        </div>

    @else

        <div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05);">
            <div style="overflow-x:auto;">

                <table style="width:100%;border-collapse:collapse;">

                    <thead>
                        <tr style="background:#f3ece0;">
                            <th style="padding:15px;text-align:left;">No</th>
                            <th style="padding:15px;text-align:left;">Nama</th>
                            <th style="padding:15px;text-align:left;">Slug</th>
                            <th style="padding:15px;text-align:left;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($categories as $category)

                            <tr style="border-top:1px solid #eee;">

                                <td style="padding:15px;">
                                    {{ $loop->iteration }}
                                </td>

                                <td style="padding:15px;font-weight:bold;">
                                    {{ $category->name }}
                                </td>

                                <td style="padding:15px;color:#777;">
                                    {{ $category->slug }}
                                </td>

                                <td style="padding:15px;">

                                    <div style="display:flex;gap:8px;flex-wrap:wrap;">

                                        <a
                                            href="{{ route('admin.categories.edit', $category) }}"
                                            class="btn btn-outline"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?');"
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
