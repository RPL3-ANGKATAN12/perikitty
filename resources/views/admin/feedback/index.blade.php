@extends('layouts.app')

@section('title', 'Saran - Admin Perikitty')

@section('content')

<div style="max-width:1200px;margin:40px auto;padding:0 20px;">

    <div style="margin-bottom:25px;">
        <h1 style="margin:0 0 6px;">Saran</h1>
        <p style="margin:0;color:#777;">
            Saran yang dikirim pembeli.
        </p>
    </div>

    @if ($feedbacks->isEmpty())

        <div style="background:white;padding:35px;border-radius:14px;text-align:center;">
            <p style="margin:0;color:#777;">Belum ada saran.</p>
        </div>

    @else

        <div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05);">
            <div style="overflow-x:auto;">

                <table style="width:100%;border-collapse:collapse;">

                    <thead>
                        <tr style="background:#eaf5f6;">
                            <th style="padding:15px;text-align:left;">Tanggal</th>
                            <th style="padding:15px;text-align:left;">Nama</th>
                            <th style="padding:15px;text-align:left;">Email</th>
                            <th style="padding:15px;text-align:left;">Saran</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($feedbacks as $feedback)

                            <tr style="border-top:1px solid #eee;vertical-align:top;">

                                <td style="padding:15px;color:#777;white-space:nowrap;">
                                    {{ $feedback->created_at->format('d M Y, H:i') }}
                                </td>

                                <td style="padding:15px;font-weight:bold;">
                                    {{ $feedback->name }}
                                </td>

                                <td style="padding:15px;color:#777;">
                                    {{ $feedback->user?->email ?? '-' }}
                                </td>

                                <td style="padding:15px;line-height:1.6;white-space:pre-line;">{{ $feedback->message }}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

    @endif

</div>

@endsection