@extends('layouts.auth')
@section('title', 'Daftar Pembeli - Perikitty')
@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 8px;">Daftar Akun Pembeli</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Buat akun untuk mulai berbelanja di Perikitty.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda">
            @error('name') <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
            @error('email') <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Minimal 6 karakter">
            @error('password') <div class="error-msg" style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password">
        </div>
        <button type="submit" class="btn">Daftar Sekarang</button>
        
        <div class="bottom-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </form>
@endsection