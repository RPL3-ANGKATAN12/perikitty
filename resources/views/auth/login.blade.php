@extends('layouts.auth')

@section('title', 'Login - Perikitty')

@section('content')

<div class="brand">
    <h1>Perikitty</h1>
    <p>Login ke akun kamu</p>
</div>

@if (session('success'))
    <div class="error-box" style="background: #effaf1; color: #287a35;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login.store') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
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

    <button type="submit" class="btn">
        Login
    </button>
</form>

<div class="auth-link">
    Belum punya akun?
    <a href="{{ route('register') }}">Daftar</a>
</div>

@endsection