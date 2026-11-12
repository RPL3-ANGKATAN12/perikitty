@extends("layouts.auth")

@section("title", "Reset Password - Perikitty Olshop")

@section("content")
<div style="max-width:420px;margin:auto;padding:60px 6%;">
    <h1 style="margin:0 0 8px;color:#12303b;font-size:28px;">Reset Password</h1>
    <p style="margin:0 0 22px;color:#777;font-size:14px;">Masukkan password baru untuk akunmu.</p>

    @if (session("error"))
        <div style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:12px;padding:12px 16px;margin-bottom:16px;font-size:14px;">{{ session("error") }}</div>
    @endif

    <form method="POST" action="{{ route("password.update") }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label style="display:block;font-size:13px;font-weight:600;color:#12303b;margin-bottom:6px;">Email</label>
        <input type="email" name="email" value="{{ old("email", $email) }}" required
               style="width:100%;padding:12px 14px;border:1px solid #cbdde3;border-radius:10px;font-size:15px;margin-bottom:14px;">
        @error("email") <div style="color:#b91c1c;font-size:13px;margin-top:-10px;margin-bottom:10px;">{{ $message }}</div> @enderror

        <label style="display:block;font-size:13px;font-weight:600;color:#12303b;margin-bottom:6px;">Password Baru</label>
        <input type="password" name="password" required
               style="width:100%;padding:12px 14px;border:1px solid #cbdde3;border-radius:10px;font-size:15px;margin-bottom:14px;">
        @error("password") <div style="color:#b91c1c;font-size:13px;margin-top:-10px;margin-bottom:10px;">{{ $message }}</div> @enderror

        <label style="display:block;font-size:13px;font-weight:600;color:#12303b;margin-bottom:6px;">Ulangi Password</label>
        <input type="password" name="password_confirmation" required
               style="width:100%;padding:12px 14px;border:1px solid #cbdde3;border-radius:10px;font-size:15px;margin-bottom:18px;">

        <button type="submit" class="btn btn-primary" style="width:100%;">Simpan Password Baru</button>
    </form>
</div>
@endsection
