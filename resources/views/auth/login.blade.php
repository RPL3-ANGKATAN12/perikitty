@extends('layouts.auth')
@section('title', 'Login - Perikitty')
@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Selamat Datang Kembali</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Silakan masuk ke akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
            @error('email') <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password">
        </div>
        <button type="submit" class="btn">Masuk</button>
        
        <div class="bottom-link">
            Belum punya akun pembeli? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </form>
@endsection