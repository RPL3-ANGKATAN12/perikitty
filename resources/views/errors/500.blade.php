@extends("layouts.app")

@section("title", "Terjadi Kesalahan - Perikitty Olshop")

@section("content")
<section style="max-width:560px;margin:auto;padding:80px 6%;text-align:center;">
    <div style="font-size:72px;font-weight:800;color:#0a7d9c;line-height:1;">500</div>
    <h1 style="margin:12px 0 8px;color:#12303b;font-size:24px;">Terjadi Kesalahan</h1>
    <p style="margin:0 0 24px;color:#777;">Maaf, sedang ada gangguan di server. Coba lagi beberapa saat lagi.</p>
    <a href="{{ route("home") }}" class="btn btn-primary">Kembali ke Beranda</a>
</section>
@endsection
