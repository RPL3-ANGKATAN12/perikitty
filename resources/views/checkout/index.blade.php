@extends('layouts.app')
@section('title', 'Checkout - Perikitty')
@section('content')
<section style="padding: 80px 8%; background: #ffffff; min-height: 80vh; display: flex; justify-content: center;">
    <div style="max-width: 800px; width: 100%;">
        
        {{-- HEADER --}}
        <div style="text-align: center; margin-bottom: 50px;">
            <h1 style="font-size: 36px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 12px;">Checkout</h1>
            <p style="color: var(--text-muted); font-size: 15px;">Lengkapi data pengiriman untuk menyelesaikan pesanan.</p>
        </div>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 16px; border-radius: 12px; margin-bottom: 30px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            {{-- BAGIAN 1: DATA PENGIRIMAN --}}
            <div style="background: #faf7f9; border: 1px solid var(--border); border-radius: 20px; padding: 40px; margin-bottom: 30px;">
                <h2 style="font-size: 22px; color: var(--text); margin-bottom: 30px; font-family: 'Playfair Display', serif;">1. Data Pengiriman</h2>
                
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 14px;">Nama Penerima</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required style="width: 100%; padding: 16px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; font-size: 15px; outline: none;" placeholder="Masukkan nama lengkap">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                    <div>
                        <label style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 14px;">Kecamatan (Batam)</label>
                        <select name="kecamatan" id="kecamatan" required style="width: 100%; padding: 16px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fff;">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach(config('batam.kecamatan') as $kec => $kelurahan)
                                <option value="{{ $kec }}">{{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 14px;">Kelurahan</label>
                        <select name="kelurahan" id="kelurahan" required style="width: 100%; padding: 16px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fff;">
                            <option value="">-- Pilih Kecamatan Dulu --</option>
                        </select>
                    </div>
                </div>
                <p style="color: #dc2626; font-size: 13px; margin-top: -10px; margin-bottom: 24px; font-weight: 500;">*Pengiriman hanya untuk wilayah Batam daratan.</p>

                <div style="margin-bottom: 10px;">
                    <label style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 14px;">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW..." style="width: 100%; padding: 16px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; font-size: 15px; outline: none;">{{ old('address') }}</textarea>
                </div>
            </div>

            {{-- BAGIAN 2: RINGKASAN PESANAN --}}
            <div style="background: #ffffff; border: 2px solid var(--accent); border-radius: 20px; padding: 40px; margin-bottom: 30px;">
                <h2 style="font-size: 22px; color: var(--text); margin-bottom: 30px; font-family: 'Playfair Display', serif;">2. Ringkasan Pesanan</h2>
                
                @foreach($cart as $item)
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 15px;">
                    <span style="color: var(--text-muted);">{{ $item['name'] }} <strong style="color: var(--text);">x{{ $item['qty'] }}</strong></span>
                    <span style="font-weight: 600;">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                </div>
                @endforeach
                
                <hr style="border: none; border-top: 1px dashed var(--border); margin: 24px 0;">
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 15px;">
                    <span style="color: var(--text-muted);">Subtotal Produk</span>
                    <span style="font-weight: 600;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 24px; font-size: 15px;">
                    <span style="color: var(--text-muted);">Ongkos Kirim</span>
                    <span style="font-weight: 600;">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; background: #fdf2f8; padding: 20px; border-radius: 12px;">
                    <span style="font-weight: 700; font-size: 16px;">Total Akhir</span>
                    <span style="color: var(--accent); font-size: 28px; font-weight: 800;">Rp {{ number_format($total + $shipping, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- TOMBOL CHECKOUT --}}
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 20px; font-size: 18px; border-radius: 12px; box-shadow: 0 10px 20px rgba(216, 91, 155, 0.2);">
                Buat Pesanan via WhatsApp
            </button>
        </form>
    </div>
</section>

<script>
    const dataWilayah = @json(config('batam.kecamatan'));
    const kecSelect = document.getElementById('kecamatan');
    const kelSelect = document.getElementById('kelurahan');

    kecSelect.addEventListener('change', function() {
        const kec = this.value;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (dataWilayah[kec]) {
            dataWilayah[kec].forEach(function(kel) {
                let opt = document.createElement('option');
                opt.value = kel;
                opt.innerHTML = kel;
                kelSelect.appendChild(opt);
            });
        }
    });
</script>
@endsection