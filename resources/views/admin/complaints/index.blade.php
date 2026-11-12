@extends('layouts.app')

@section('title', 'Pengaduan - Admin Perikitty')

@section('content')

<div style="max-width:1200px;margin:40px auto;padding:0 20px;">

    <div style="margin-bottom:25px;">
        <h1 style="margin:0 0 6px;">Pengaduan</h1>
        <p style="margin:0;color:#777;">
            Pengaduan yang dikirim pembeli.
        </p>
    </div>

    @if ($complaints->isEmpty())

        <div style="background:white;padding:35px;border-radius:14px;text-align:center;">
            <p style="margin:0;color:#777;">Belum ada pengaduan.</p>
        </div>

    @else

        <div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05);">
            <div style="overflow-x:auto;">

                <table style="width:100%;border-collapse:collapse;">

                    <thead>
                        <tr style="background:#eaf5f6;">
                            <th style="padding:15px;text-align:left;">Tanggal</th>
                            <th style="padding:15px;text-align:left;">Pengirim</th>
                            <th style="padding:15px;text-align:left;">Judul</th>
                            <th style="padding:15px;text-align:left;">Status</th>
                            <th style="padding:15px;text-align:left;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($complaints as $complaint)

                            <tr style="border-top:1px solid #eee;">

                                <td style="padding:15px;color:#777;">
                                    {{ $complaint->created_at->format('d M Y, H:i') }}
                                </td>

                                <td style="padding:15px;">
                                    {{ $complaint->user?->name ?? '-' }}
                                </td>

                                <td style="padding:15px;font-weight:bold;">
                                    {{ $complaint->subject }}
                                </td>

                                <td style="padding:15px;">
                                    @if ($complaint->admin_reply)
                                        <span style="background:#e8f8ee;color:#198754;padding:6px 10px;border-radius:20px;font-size:13px;font-weight:bold;">
                                            Sudah dibalas
                                        </span>
                                    @else
                                        <span style="background:#dff3ee;color:#0a3d4c;padding:6px 10px;border-radius:20px;font-size:13px;font-weight:bold;">
                                            Belum dibalas
                                        </span>
                                    @endif
                                </td>

                                <td style="padding:15px;">
                                    <a
                                        href="{{ route('admin.complaints.show', $complaint) }}"
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