@extends('layouts.auth')
@section('title', 'Daftar - Perikitty')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama kamu...">
            @error('name') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
            @error('email') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Minimal 8 karakter...">
            @error('password') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password...">
        </div>
        <button type="submit" class="btn">Buat Akun Baru</button>
        <div class="bottom-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </form>
@endsection
