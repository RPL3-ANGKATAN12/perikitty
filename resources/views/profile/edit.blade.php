@extends('layouts.app')

@section('title', 'Profil - Perikitty Olshop')

@section('content')

@php
    $fieldStyle = 'width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #ddd; border-radius: 10px; font-size: 15px; font-family: inherit;';
    $labelStyle = 'display: block; margin: 0 0 7px; color: #12303b; font-weight: bold; font-size: 14px;';
@endphp

<section style="
    max-width: 700px;
    margin: auto;
    padding: 50px 6%;
">

    <div style="
        text-align: center;
        margin-bottom: 35px;
    ">
        <h1 style="
            margin: 0 0 10px;
            color: #12303b;
            font-size: 36px;
        ">
            Profil Saya
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Data ini dipakai otomatis saat checkout.
        </p>
    </div>

    @if ($errors->any())
        <div style="
            background: #eaf5f6;
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
        action="{{ route('profile.update') }}"
        method="POST"
        style="
            background: white;
            border: 1px solid #d8e9ee;
            border-radius: 16px;
            padding: 25px;
        "
    >
        @csrf
        @method('PATCH')

        <div style="margin-bottom: 16px;">
            <label style="{{ $labelStyle }}">Email</label>
            <input
                type="text"
                value="{{ $user->email }}"
                disabled
                style="{{ $fieldStyle }} background: #f0f7f8; color: #777;"
            >
        </div>

        <div style="margin-bottom: 16px;">
            <label for="name" style="{{ $labelStyle }}">Nama</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                style="{{ $fieldStyle }}"
            >
        </div>

        <div style="margin-bottom: 16px;">
            <label for="phone" style="{{ $labelStyle }}">Nomor HP / WhatsApp</label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $user->phone) }}"
                placeholder="081234567890"
                required
                style="{{ $fieldStyle }}"
            >
        </div>

        <div style="margin-bottom: 16px;">
            <label for="address" style="{{ $labelStyle }}">Alamat</label>
            <textarea
                id="address"
                name="address"
                rows="3"
                required
                style="{{ $fieldStyle }}"
            >{{ old('address', $user->address) }}</textarea>
        </div>

        <div style="margin-bottom: 22px;">
            <label style="{{ $labelStyle }}">Kota</label>
            <input
                type="text"
                value="Batam, Kepulauan Riau"
                disabled
                style="{{ $fieldStyle }} background: #f0f7f8; color: #777;"
            >
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
            Simpan Profil
        </button>
    </form>

</section>

@endsection