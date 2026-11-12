@extends('layouts.app')
@section('title', 'Kategori - Perikitty')
@section('content')
<section style="padding: 60px 5%; background: var(--bg); min-height: 80vh;">
    <div style="max-width: 1100px; margin: auto; text-align: center;">
        <h1 style="font-size: 36px; font-weight: 800; color: var(--text); margin-bottom: 40px;">Semua Kategori</h1>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @foreach(\App\Models\Category::all() as $cat)
            <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 30px; font-size: 18px; font-weight: 600; color: var(--text);">
                {{ $cat->name }}
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
