<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perikitty')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f7f3ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-box {
            width: 100%;
            max-width: 460px;
            background: white;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand h1 {
            margin: 0;
            color: #7c4dff;
            font-size: 30px;
        }

        .brand p {
            margin: 8px 0 0;
            color: #777;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #7c4dff;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 13px;
            background: #7c4dff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #6938e8;
        }

        .error-box {
            background: #fff0f0;
            color: #c62828;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .auth-link a {
            color: #7c4dff;
            font-weight: bold;
            text-decoration: none;
        }

        @media (max-width: 500px) {
            .auth-box {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <main class="auth-box">
        @yield('content')
    </main>
</body>
</html>