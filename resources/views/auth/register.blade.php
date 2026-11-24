@extends('layouts.auth')
@section('title', 'Daftar Pembeli - Perikitty')
@section('content')
    <style>
        .input-invalid {
            border: 2px solid #e11d48 !important;
            background-color: #ffe4e6 !important;
            color: #881337 !important;
            box-shadow: 0 0 0 4px rgba(225, 29, 72, 0.18) !important;
        }
        .field-error-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #ffe4e6;
            border: 1px solid #fda4af;
            color: #9f1239;
            font-size: 12px;
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 8px;
            margin-top: 6px;
        }
        .err-tag {
            display: inline-block;
            background: #e11d48;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 2px 7px;
            border-radius: 6px;
            margin-right: 6px;
            text-transform: uppercase;
        }
        #fail-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.58);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 9999;
        }
        #fail-modal-box {
            width: 100%;
            max-width: 440px;
            background: #fff1f2;
            border: 2px solid #e11d48;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 24px 54px rgba(136, 19, 55, 0.35);
            animation: popFail 0.18s ease-out;
        }
        @keyframes popFail {
            from { transform: scale(0.94); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>

    @php
        $fieldLabels = [
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'password' => 'Password / Konfirmasi',
            'password_confirmation' => 'Konfirmasi Password',
        ];
    @endphp

    @if($errors->any())
        <div id="fail-modal-backdrop" onclick="if(event.target===this) this.style.display='none';">
            <div id="fail-modal-box">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="width: 40px; height: 40px; border-radius: 50%; background: #e11d48; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 900; flex-shrink: 0;">!</span>
                    <div>
                        <div style="font-size: 17px; font-weight: 900; color: #9f1239; line-height: 1.2;">PENDAFTARAN GAGAL</div>
                        <div style="font-size: 12px; color: #881337; font-weight: 700; margin-top: 2px;">Data belum tersimpan karena ada bagian yang tidak sesuai:</div>
                    </div>
                </div>

                <div style="background: #ffffff; border: 1.5px solid #fda4af; border-radius: 12px; padding: 12px; margin-bottom: 16px;">
                    @foreach($errors->messages() as $errField => $msgs)
                        @php $label = $fieldLabels[$errField] ?? strtoupper($errField); @endphp
                        @foreach($msgs as $m)
                            <div style="margin-bottom: {{ $loop->last && $loop->parent->last ? '0' : '8px' }}; font-size: 12.5px; color: #881337; font-weight: 700; line-height: 1.45;">
                                <span class="err-tag">{{ $label }}</span>
                                <span>{{ $m }}</span>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <button type="button" onclick="document.getElementById('fail-modal-backdrop').style.display='none'" style="width: 100%; padding: 12px 16px; border: none; border-radius: 11px; background: #e11d48; color: #ffffff; font-size: 13px; font-weight: 800; cursor: pointer; letter-spacing: 0.3px;">
                    Tutup &amp; Lihat Bagian yang Salah di Form
                </button>
            </div>
        </div>
    @endif

    <div style="text-align: center; margin-bottom: 22px;">
        <h2 style="font-size: 24px; font-family: 'Playfair Display', serif; color: var(--text); margin-bottom: 6px;">Daftar Akun Pembeli</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Buat akun untuk mulai berbelanja di Perikitty.</p>
    </div>

    @if($errors->any())
        <div id="register-error-alert" style="background: #ffe4e6; border: 2px solid #e11d48; color: #881337; padding: 14px; border-radius: 12px; font-size: 12.5px; line-height: 1.5; margin-bottom: 18px;">
            <div style="font-weight: 900; font-size: 13px; color: #9f1239; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.4px;">
                &#10005; Konfirmasi Gagal — Salah di Bagian:
            </div>
            @foreach($errors->messages() as $errField => $msgs)
                @php $label = $fieldLabels[$errField] ?? strtoupper($errField); @endphp
                @foreach($msgs as $m)
                    <div style="margin-bottom: {{ $loop->last && $loop->parent->last ? '0' : '6px' }}; font-weight: 700;">
                        <span class="err-tag">{{ $label }}</span>
                        <span>{{ $m }}</span>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda" class="@error('name') input-invalid @enderror">
            @error('name')
                <div class="field-error-badge"><span class="err-tag">SALAH</span><span>{{ $message }}</span></div>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" class="@error('email') input-invalid @enderror">
            @error('email')
                <div class="field-error-badge"><span class="err-tag">SALAH</span><span>{{ $message }}</span></div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <div style="position: relative; display: flex; align-items: center;">
                <input type="password" name="password" required placeholder="Minimal 6 karakter" style="padding-right: 46px;" class="@error('password') input-invalid @enderror">
                <button type="button" onclick="togglePass(this)" aria-label="Lihat atau sembunyikan password" style="position: absolute; right: 12px; background: transparent; border: none; padding: 4px; cursor: pointer; color: #7a7a7a; display: inline-flex; align-items: center; justify-content: center;">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                </button>
            </div>
            @error('password')
                <div class="field-error-badge"><span class="err-tag">SALAH</span><span>{{ $message }}</span></div>
            @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div style="position: relative; display: flex; align-items: center;">
                <input type="password" name="password_confirmation" required placeholder="Ulangi password" style="padding-right: 46px;" class="@error('password') input-invalid @enderror">
                <button type="button" onclick="togglePass(this)" aria-label="Lihat atau sembunyikan konfirmasi password" style="position: absolute; right: 12px; background: transparent; border: none; padding: 4px; cursor: pointer; color: #7a7a7a; display: inline-flex; align-items: center; justify-content: center;">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                </button>
            </div>
        </div>

        <button type="submit" class="btn">Daftar Sekarang</button>

        <div class="bottom-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </form>

    <script>
        if (!window.togglePass) {
            window.togglePass = function(btn) {
                var box = btn.parentElement;
                var inp = box ? box.querySelector('input') : null;
                if (!inp) return;
                var show = inp.type === 'password';
                inp.type = show ? 'text' : 'password';
                var openIcon = btn.querySelector('.eye-open');
                var offIcon = btn.querySelector('.eye-off');
                if (openIcon && offIcon) {
                    openIcon.style.display = show ? 'none' : 'inline-flex';
                    offIcon.style.display = show ? 'inline-flex' : 'none';
                }
            };
        }
    </script>
@endsection