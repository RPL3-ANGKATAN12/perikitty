@extends('layouts.auth')
@section('title', 'Login - Perikitty')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email...">
            @error('email') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password...">
            @error('password') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn">Masuk ke Akun</button>
        <div class="bottom-link">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></div>
    </form>
@endsection
