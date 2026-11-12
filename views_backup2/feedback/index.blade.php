@extends('layouts.app')

@section('title', 'Saran - Perikitty Olshop')

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
            Saran
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Punya ide agar Perikitty Olshop lebih baik? Kami senang mendengarnya.
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
        action="{{ route('feedback.store') }}"
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
            <label for="name" style="{{ $labelStyle }}">Nama</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
                required
                style="{{ $fieldStyle }}"
            >
        </div>

        <div style="margin-bottom: 22px;">
            <label for="message" style="{{ $labelStyle }}">Saran</label>
            <textarea
                id="message"
                name="message"
                rows="5"
                placeholder="Tulis saranmu di sini"
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
            Kirim Saran
        </button>
    </form>

    <h2 style="margin: 0 0 18px; color: #2b2a26; font-size: 22px;">
        Saran Saya
    </h2>

    @forelse ($feedbacks as $feedback)

        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 20px 25px;
            margin-bottom: 16px;
        ">

            <div style="color: #777; font-size: 13px; margin-bottom: 10px;">
                {{ $feedback->created_at->format('d M Y, H:i') }}
            </div>

            <p style="margin: 0; color: #555; line-height: 1.7; white-space: pre-line;">{{ $feedback->message }}</p>

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
            Kamu belum pernah mengirim saran.
        </div>

    @endforelse

</section>

@endsection