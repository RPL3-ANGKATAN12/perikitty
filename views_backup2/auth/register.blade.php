@extends('layouts.auth')

@section('title', 'Daftar - Perikitty')

@section('content')

<div class="brand">
    <h1>Perikitty</h1>
    <p>Buat akun pembeli baru</p>
</div>

@if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Nama</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
    </div>

    <div class="form-group">
        <label for="phone">Nomor HP</label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone') }}"
        >
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea
            id="address"
            name="address"
        >{{ old('address') }}</textarea>
    </div>

    <div class="form-group">
        <label for="city">Kota</label>
        <input
            type="text"
            id="city"
            name="city"
            value="{{ old('city') }}"
        >
    </div>

    <div class="form-group">
        <label for="province">Provinsi</label>
        <input
            type="text"
            id="province"
            name="province"
            value="{{ old('province') }}"
        >
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
        >
    </div>

    <button type="submit" class="btn">
        Daftar
    </button>
</form>

<div class="auth-link">
    Sudah punya akun?
    <a href="{{ route('login') }}">Login</a>
</div>

@endsection