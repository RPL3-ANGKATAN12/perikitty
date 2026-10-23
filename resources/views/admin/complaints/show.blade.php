@extends('layouts.app')

@section('title', 'Detail Pengaduan - Admin Perikitty')

@section('content')

<div style="max-width:800px;margin:40px auto;padding:0 20px;">

    <a
        href="{{ route('admin.complaints.index') }}"
        style="display:inline-block;margin-bottom:20px;color:#c4592f;text-decoration:none;font-weight:bold;"
    >
        ← Kembali ke Pengaduan
    </a>

    @if ($errors->any())
        <div style="background:#f3ece0;border:1px solid #e6c3b5;border-radius:12px;color:#a6402a;padding:14px 20px;margin-bottom:20px;font-size:14px;">
            @foreach ($errors->all() as $message)
                <div>{{ $message }}</div>
            @endforeach
        </div>
    @endif

    <div style="background:white;border-radius:14px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,.05);margin-bottom:20px;">

        <h1 style="margin:0 0 8px;font-size:26px;">{{ $complaint->subject }}</h1>

        <div style="color:#777;font-size:14px;margin-bottom:16px;">
            Dari {{ $complaint->user?->name ?? '-' }}
            ({{ $complaint->user?->email ?? '-' }})
            , {{ $complaint->created_at->format('d M Y, H:i') }}
        </div>

        <p style="margin:0;color:#555;line-height:1.7;white-space:pre-line;">{{ $complaint->message }}</p>

    </div>

    <form
        action="{{ route('admin.complaints.update', $complaint) }}"
        method="POST"
        style="background:white;border-radius:14px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,.05);"
    >
        @csrf
        @method('PATCH')

        <h2 style="margin:0 0 14px;font-size:20px;">Balasan</h2>

        <textarea
            name="admin_reply"
            rows="5"
            required
            style="width:100%;box-sizing:border-box;padding:13px 15px;border:1px solid #ddd;border-radius:10px;font-size:15px;font-family:inherit;margin-bottom:16px;"
        >{{ old('admin_reply', $complaint->admin_reply) }}</textarea>

        @if ($complaint->replied_at)
            <div style="color:#777;font-size:13px;margin-bottom:14px;">
                Terakhir dibalas {{ $complaint->replied_at->format('d M Y, H:i') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary" style="border:0;cursor:pointer;">
            Kirim Balasan
        </button>
    </form>

</div>

@endsection