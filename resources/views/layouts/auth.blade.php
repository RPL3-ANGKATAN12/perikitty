<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth - Perikitty')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #0a3d4c; --surface: #0f4a5c; --text: #f0f7f8; --text-muted: #a3c9d1; --accent: #2dd4bf; --border: #156b82; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }
        
        /* Layout Split Screen */
        .auth-container { display: flex; width: 100%; min-height: 100vh; }
        .auth-left { flex: 1; background: linear-gradient(135deg, #0a3d4c 0%, #156b82 100%); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; text-align: center; }
        .auth-left h2 { font-size: 36px; margin-bottom: 16px; color: #fff; }
        .auth-left p { color: #a3c9d1; font-size: 16px; max-width: 400px; }
        
        .auth-right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; background: var(--bg); }
        .auth-box { width: 100%; max-width: 380px; background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        
        .logo { text-align: center; margin-bottom: 24px; font-size: 24px; font-weight: 800; }
        .logo span { color: var(--accent); }
        
        .form-group { margin-bottom: 16px; }
        label { display: block; font-size: 13px; color: var(--text-muted); margin-bottom: 6px; font-weight: 500; }
        input { width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--text); outline: none; font-family: inherit; font-size: 14px; }
        input:focus { border-color: var(--accent); }
        
        .btn { width: 100%; padding: 14px; border-radius: 8px; border: none; background: var(--accent); color: var(--bg); font-weight: 800; font-size: 15px; cursor: pointer; margin-top: 8px; transition: 0.2s; }
        .btn:hover { background: #5eead4; }
        
        .bottom-link { text-align: center; margin-top: 20px; font-size: 13px; color: var(--text-muted); }
        .bottom-link a { color: var(--accent); font-weight: 600; text-decoration: none; }
        .error-msg { color: #f87171; font-size: 12px; margin-top: 4px; }

        /* Responsif untuk HP (Kalau di HP, gambar kiri disembunyiin) */
        @media (max-width: 768px) {
            .auth-left { display: none; }
            .auth-right { background: var(--surface); padding: 16px; }
            .auth-box { box-shadow: none; border: none; background: transparent; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <h2>Perikitty.</h2>
            <p>Peralatan rumah tangga lengkap, elegan, dan terjangkau. Semua ada dalam satu toko.</p>
        </div>
        <div class="auth-right">
            <div class="auth-box">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
