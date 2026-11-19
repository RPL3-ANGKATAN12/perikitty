@extends('layouts.app')
@section('title', 'Checkout - Perikitty')
@section('content')
<section style="padding: 80px 8%; background: #fff9fc; min-height: 80vh; display: flex; justify-content: center;">
    <div style="max-width: 800px; width: 100%;">

        <div style="text-align: center; margin-bottom: 40px;">
            <span style="display: inline-block; background: #ffe3f0; color: #b83778; font-size: 11.5px; font-weight: 800; padding: 5px 14px; border-radius: 999px; margin-bottom: 10px;">KONFIRMASI VIA WHATSAPP</span>
            <h1 style="font-size: 34px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 10px;">Checkout Pesanan</h1>
            <p style="color: var(--text-muted); font-size: 15px;">Kamu bebas mengedit data kapan saja sebelum menekan tombol kirim ke WhatsApp. Proses lanjutan ditangani langsung lewat chat WA.</p>
        </div>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #fecaca;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf

            <div style="background: #ffffff; border: 1px solid #f5d8e7; border-radius: 20px; padding: 36px; margin-bottom: 26px; box-shadow: 0 8px 24px rgba(224, 98, 160, 0.05);">
                <h2 style="font-size: 21px; color: var(--text); margin-bottom: 24px; font-family: 'Playfair Display', serif;">1. Data Pengiriman (Bisa Diedit Sebelum Kirim WA)</h2>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Nama Penerima</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required style="width: 100%; padding: 14px 16px; border: 1.5px solid #f0d7e5; border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fffcfd;" placeholder="Masukkan nama lengkap">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Kecamatan (Batam)</label>
                        <select name="kecamatan" id="kecamatan" required style="width: 100%; padding: 14px 16px; border: 1.5px solid #f0d7e5; border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fff;">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach(config('batam.kecamatan') as $kec => $kelurahan)
                                <option value="{{ $kec }}" {{ old('kecamatan') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Kelurahan</label>
                        <select name="kelurahan" id="kelurahan" required style="width: 100%; padding: 14px 16px; border: 1.5px solid #f0d7e5; border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fff;">
                            <option value="">-- Pilih Kecamatan Dulu --</option>
                        </select>
                    </div>
                </div>
                <p style="color: #be123c; font-size: 13px; margin-top: -6px; margin-bottom: 20px; font-weight: 600;">*Pengiriman hanya untuk wilayah Batam daratan.</p>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW..." style="width: 100%; padding: 14px 16px; border: 1.5px solid #f0d7e5; border-radius: 12px; font-family: inherit; font-size: 15px; outline: none; background: #fffcfd;">{{ old('address') }}</textarea>
                </div>
            </div>

            <div style="background: #ffffff; border: 2px solid #f0b6d3; border-radius: 20px; padding: 36px; margin-bottom: 24px; box-shadow: 0 8px 24px rgba(224, 98, 160, 0.06);">
                <h2 style="font-size: 21px; color: var(--text); margin-bottom: 24px; font-family: 'Playfair Display', serif;">2. Ringkasan Pesanan</h2>

                @foreach($cart as $item)
                <div style="display: flex; justify-content: space-between; margin-bottom: 14px; font-size: 15px;">
                    <span style="color: var(--text-muted);">{{ $item['name'] }} <strong style="color: var(--text);">x{{ $item['qty'] }}</strong></span>
                    <span style="font-weight: 700;">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                </div>
                @endforeach

                <hr style="border: none; border-top: 1px dashed #ebd2df; margin: 20px 0;">

                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 15px;">
                    <span style="color: var(--text-muted);">Subtotal Produk</span>
                    <span style="font-weight: 600;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 15px;">
                    <span style="color: var(--text-muted);">Ongkos Kirim</span>
                    <span style="font-weight: 600;">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; background: #fff2f8; padding: 18px 20px; border-radius: 14px; margin-bottom: 20px;">
                    <span style="font-weight: 700; font-size: 16px;">Total Akhir</span>
                    <span style="color: #c93b82; font-size: 26px; font-weight: 800;">Rp {{ number_format($total + $shipping, 0, ',', '.') }}</span>
                </div>

                <label style="display: flex; align-items: flex-start; gap: 10px; font-size: 13.5px; color: #5c4d55; cursor: pointer; background: #fff9fc; padding: 14px; border-radius: 12px; border: 1px solid #f5d8e7;">
                    <input type="checkbox" id="confirmCheck" required style="margin-top: 3px; width: 16px; height: 16px; accent-color: #d44b8d;">
                    <span>Saya sudah yakin dengan data yang diisi dan siap mengirim detail pesanan ke <strong>WhatsApp</strong>.</span>
                </label>
            </div>

            <button type="submit" id="submitOrderBtn" class="btn btn-primary" style="width: 100%; padding: 18px; font-size: 17px; font-weight: 700; border-radius: 14px; box-shadow: 0 10px 22px rgba(212, 75, 141, 0.25); cursor: pointer;">
                Kirim Pesanan ke WhatsApp
            </button>
        </form>
    </div>
</section>

<script>
    const dataWilayah = @json(config('batam.kecamatan'));
    const kecSelect = document.getElementById('kecamatan');
    const kelSelect = document.getElementById('kelurahan');
    const oldKel = @json(old('kelurahan'));

    function populateKelurahan(kec, selectedKel = '') {
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (dataWilayah[kec]) {
            dataWilayah[kec].forEach(function(kel) {
                let opt = document.createElement('option');
                opt.value = kel;
                opt.textContent = kel;
                if (selectedKel && selectedKel === kel) opt.selected = true;
                kelSelect.appendChild(opt);
            });
        }
    }

    kecSelect.addEventListener('change', function() {
        populateKelurahan(this.value);
    });

    if (kecSelect.value) {
        populateKelurahan(kecSelect.value, oldKel);
    }

    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitOrderBtn');
        if (!document.getElementById('confirmCheck').checked) {
            e.preventDefault();
            return;
        }
        btn.disabled = true;
        btn.textContent = 'Menyiapkan Pesan WhatsApp...';
    });
</script>
@endsection
