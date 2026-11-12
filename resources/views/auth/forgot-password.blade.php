@extends("layouts.auth")

@section("title", "Lupa Password - Perikitty Olshop")

@section("content")
<div style="max-width:420px;margin:auto;padding:60px 6%;">
    <h1 style="margin:0 0 8px;color:#12303b;font-size:28px;">Lupa Password</h1>
    <p style="margin:0 0 22px;color:#777;font-size:14px;">Masukkan email akunmu, kami akan kirim tautan reset.</p>

    @if (session("success"))
        <div style="background:#ecfdf5;color:#047857;border:1px solid #a7f3d0;border-radius:12px;padding:12px 16px;margin-bottom:16px;font-size:14px;">{{ session("success") }}</div>
    @endif
    @if (session("error"))
        <div style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:12px;padding:12px 16px;margin-bottom:16px;font-size:14px;">{{ session("error") }}</div>
    @endif

    <form method="POST" action="{{ route("password.email") }}">
        @csrf
        <label style="display:block;font-size:13px;font-weight:600;color:#12303b;margin-bottom:6px;">Email</label>
        <input type="email" name="email" value="{{ old("email") }}" required
               style="width:100%;padding:12px 14px;border:1px solid #cbdde3;border-radius:10px;font-size:15px;margin-bottom:16px;">
        @error("email") <div style="color:#b91c1c;font-size:13px;margin-top:-10px;margin-bottom:12px;">{{ $message }}</div> @enderror

        <button type="submit" class="btn btn-primary" style="width:100%;">Kirim Tautan Reset</button>
    </form>

    <p style="margin-top:18px;font-size:14px;color:#777;text-align:center;">
        Ingat password? <a href="{{ route("login") }}" style="color:#0a7d9c;font-weight:700;">Login</a>
    </p>
</div>
@endsection
