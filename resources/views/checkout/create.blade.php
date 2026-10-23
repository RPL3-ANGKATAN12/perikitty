@extends('layouts.app')

@section('title', 'Checkout - Perikitty Olshop')

@section('content')

@php
    $fieldStyle = 'width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #ddd; border-radius: 10px; font-size: 15px; font-family: inherit;';
    $labelStyle = 'display: block; margin: 0 0 7px; color: #2b2a26; font-weight: bold; font-size: 14px;';
@endphp

<section style="
    max-width: 1100px;
    margin: auto;
    padding: 50px 6%;
">

    <div style="
        text-align: center;
        margin-bottom: 35px;
    ">
        <h1 style="
            margin: 0 0 10px;
            color: #2b2a26;
            font-size: 36px;
        ">
            Checkout
        </h1>

        <p style="
            margin: 0;
            color: #777;
        ">
            Pengiriman hanya untuk wilayah Batam.
        </p>
    </div>

    @if ($errors->any())

        <div style="
            background: #f3ece0;
            border: 1px solid #e6c3b5;
            border-radius: 12px;
            color: #a6402a;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-size: 14px;
        ">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(320px, 100%), 1fr));
        gap: 25px;
        align-items: start;
    ">

        {{-- Form pengiriman --}}
        <form
            id="checkout-form"
            action="{{ route('checkout.store') }}"
            method="POST"
            style="
                background: white;
                border: 1px solid #e8e0d2;
                border-radius: 16px;
                padding: 25px;
            "
        >
            @csrf

            <h2 style="margin: 0 0 20px; color: #2b2a26; font-size: 20px;">
                Data Pengiriman
            </h2>

            <div style="margin-bottom: 16px;">
                <label for="customer_name" style="{{ $labelStyle }}">Nama Penerima</label>
                <input
                    type="text"
                    id="customer_name"
                    name="customer_name"
                    value="{{ old('customer_name', $user->name) }}"
                    required
                    style="{{ $fieldStyle }}"
                >
            </div>

            <div style="margin-bottom: 16px;">
                <label for="phone" style="{{ $labelStyle }}">Nomor HP / WhatsApp</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="081234567890"
                    required
                    style="{{ $fieldStyle }}"
                >
            </div>

            <div style="margin-bottom: 16px;">
                <label for="address" style="{{ $labelStyle }}">Alamat Lengkap</label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    placeholder="Nama jalan, nomor rumah, perumahan, RT/RW"
                    required
                    style="{{ $fieldStyle }}"
                >{{ old('address', $user->address) }}</textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="{{ $labelStyle }}">Kota</label>
                <input
                    type="text"
                    value="Batam, Kepulauan Riau"
                    disabled
                    style="{{ $fieldStyle }} background: #f6f1e7; color: #777;"
                >
            </div>

            <div style="margin-bottom: 16px;">
                <label for="district" style="{{ $labelStyle }}">Kecamatan</label>
                <select
                    id="district"
                    name="district"
                    required
                    style="{{ $fieldStyle }} background: white;"
                >
                    <option value="">Pilih kecamatan</option>
                    @foreach ($districts as $name => $fee)
                        <option
                            value="{{ $name }}"
                            data-fee="{{ $fee }}"
                            @selected(old('district') === $name)
                        >
                            {{ $name }} (ongkir Rp {{ number_format($fee, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 22px;">
                <label for="notes" style="{{ $labelStyle }}">Catatan (opsional)</label>
                <textarea
                    id="notes"
                    name="notes"
                    rows="2"
                    placeholder="Contoh: titip ke satpam"
                    style="{{ $fieldStyle }}"
                >{{ old('notes') }}</textarea>
            </div>

            <button
                type="submit"
                class="btn btn-primary"
                style="
                    width: 100%;
                    border: 0;
                    cursor: pointer;
                    font-size: 16px;
                "
            >
                Buat Pesanan
            </button>
        </form>

        {{-- Ringkasan pesanan --}}
        <div style="
            background: white;
            border: 1px solid #e8e0d2;
            border-radius: 16px;
            padding: 25px;
        ">

            <h2 style="margin: 0 0 20px; color: #2b2a26; font-size: 20px;">
                Ringkasan Pesanan
            </h2>

            @foreach ($cart as $item)

                <div style="
                    display: flex;
                    gap: 14px;
                    align-items: center;
                    padding-bottom: 14px;
                    margin-bottom: 14px;
                    border-bottom: 1px solid #e8e0d2;
                ">

                    @if ($item['image'])

                        <img
                            src="{{ asset('storage/' . $item['image']) }}"
                            alt="{{ $item['name'] }}"
                            style="
                                width: 60px;
                                height: 60px;
                                object-fit: cover;
                                border-radius: 10px;
                                flex-shrink: 0;
                            "
                        >

                    @else

                        <div style="
                            width: 60px;
                            height: 60px;
                            background: #f3ece0;
                            border-radius: 10px;
                            flex-shrink: 0;
                        "></div>

                    @endif

                    <div style="flex: 1;">
                        <div style="color: #2b2a26; font-weight: bold;">
                            {{ $item['name'] }}
                        </div>
                        <div style="color: #777; font-size: 14px;">
                            {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </div>
                    </div>

                    <div style="color: #2b2a26; font-weight: bold;">
                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    </div>

                </div>

            @endforeach

            <div style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                color: #777;
            ">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 14px;
                color: #777;
            ">
                <span>Ongkir</span>
                <span id="shipping-text">Pilih kecamatan</span>
            </div>

            <div style="
                display: flex;
                justify-content: space-between;
                padding-top: 14px;
                border-top: 1px solid #e8e0d2;
                color: #c4592f;
                font-size: 20px;
                font-weight: bold;
            ">
                <span>Total</span>
                <span id="total-text">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

        </div>

    </div>

</section>

<script>
    (function () {
        var subtotal = {{ (int) $subtotal }};
        var select = document.getElementById('district');
        var shippingText = document.getElementById('shipping-text');
        var totalText = document.getElementById('total-text');
        var formatter = new Intl.NumberFormat('id-ID');

        function refresh() {
            var option = select.options[select.selectedIndex];
            var fee = option && option.dataset.fee ? parseInt(option.dataset.fee, 10) : null;

            if (fee === null) {
                shippingText.textContent = 'Pilih kecamatan';
                totalText.textContent = 'Rp ' + formatter.format(subtotal);
                return;
            }

            shippingText.textContent = 'Rp ' + formatter.format(fee);
            totalText.textContent = 'Rp ' + formatter.format(subtotal + fee);
        }

        select.addEventListener('change', refresh);
        refresh();
    })();
</script>

@endsection