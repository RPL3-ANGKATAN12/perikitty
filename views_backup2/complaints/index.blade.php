@extends('layouts.app')

@section('title', 'Pengaduan - Perikitty Olshop')

@section('content')

@php
    $fieldStyle = 'width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #ddd; border-radius: 10px; font-size: 15px; font-family: inherit;';
    $labelStyle = 'display: block; margin: 0 0 7px; color: #2b2a26; font-weight: bold; font-size: 14px;';
@endphp

<section style="
    max-width: 800px;
    margin: auto;
    padding: 50px 6%;
">

    <div style="
        text-align: center;
        margin-bottom: 35px;
    ">
        <h1 style="
            margin: 0 0 10px;
            color: #2b2a26;
            font-size: 36px;
        ">
            Pengaduan
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Ada masalah dengan pesanan atau layanan kami? Ceritakan di sini.
        </p>
    </div>

    @if ($errors->any())
        <div style="
            background: #f3ece0;
            border: 1px solid #e6c3b5;
            border-radius: 12px;
            color: #a6402a;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-size: 14px;
        ">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('complaints.store') }}"
        method="POST"
        style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 35px;
        "
    >
        @csrf

        <div style="margin-bottom: 16px;">
            <label for="subject" style="{{ $labelStyle }}">Judul</label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="Contoh: Pesanan belum sampai"
                required
                style="{{ $fieldStyle }}"
            >
        </div>

        <div style="margin-bottom: 22px;">
            <label for="message" style="{{ $labelStyle }}">Isi Pengaduan</label>
            <textarea
                id="message"
                name="message"
                rows="5"
                placeholder="Ceritakan masalahnya sejelas mungkin"
                required
                style="{{ $fieldStyle }}"
            >{{ old('message') }}</textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary"
            style="
                width: 100%;
                border: 0;
                cursor: pointer;
                font-size: 16px;
            "
        >
            Kirim Pengaduan
        </button>
    </form>

    <h2 style="margin: 0 0 18px; color: #2b2a26; font-size: 22px;">
        Pengaduan Saya
    </h2>

    @forelse ($complaints as $complaint)

        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 20px 25px;
            margin-bottom: 16px;
        ">

            <div style="
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            ">
                <div style="color: #2b2a26; font-weight: bold; font-size: 17px;">
                    {{ $complaint->subject }}
                </div>

                @if ($complaint->admin_reply)
                    <span style="background: #e8f8ee; color: #198754; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: bold;">
                        Sudah dibalas
                    </span>
                @else
                    <span style="background: #e3eee8; color: #1f3d36; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: bold;">
                        Menunggu balasan
                    </span>
                @endif
            </div>

            <div style="color: #777; font-size: 13px; margin-bottom: 12px;">
                {{ $complaint->created_at->format('d M Y, H:i') }}
            </div>

            <p style="margin: 0; color: #555; line-height: 1.7; white-space: pre-line;">{{ $complaint->message }}</p>

            @if ($complaint->admin_reply)
                <div style="
                    margin-top: 16px;
                    padding: 14px 16px;
                    background: #f3ece0;
                    border-radius: 12px;
                ">
                    <div style="color: #c4592f; font-weight: bold; font-size: 14px; margin-bottom: 6px;">
                        Balasan dari Perikitty Olshop
                    </div>
                    <p style="margin: 0; color: #2b2a26; line-height: 1.7; white-space: pre-line;">{{ $complaint->admin_reply }}</p>
                </div>
            @endif

        </div>

    @empty

        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 35px 25px;
            text-align: center;
            color: #777;
        ">
            Kamu belum pernah mengirim pengaduan.
        </div>

    @endforelse

</section>

@endsection