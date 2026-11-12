@extends("layouts.app")

@section("title", "Halaman Tidak Ditemukan - Perikitty Olshop")

@section("content")
<section style="max-width:560px;margin:auto;padding:80px 6%;text-align:center;">
    <div style="font-size:72px;font-weight:800;color:#0a7d9c;line-height:1;">404</div>
    <h1 style="margin:12px 0 8px;color:#12303b;font-size:24px;">Halaman Tidak Ditemukan</h1>
    <p style="margin:0 0 24px;color:#777;">Sepertinya halaman yang kamu cari sudah hilang atau dipindahkan.</p>
    <a href="{{ route("products.index") }}" class="btn btn-primary">Belanja dulu</a>
</section>
@endsection
