<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PetMatch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: #fdf0df;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            text-align: center;
            width: 100%;
            max-width: 420px;
        }

        .logo {
            font-size: 40px;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 0 #f4b6a8;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #8d6e63;
            margin-bottom: 28px;
        }

        .card {
            background: #fff;
            padding: 35px;
            border-radius: 26px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .card h2 {
            margin-bottom: 25px;
            font-weight: 700;
            color: #333;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: none;
            background: #fdf0df;
            margin-bottom: 18px;
            font-size: 14px;
        }

        input:focus {
            outline: 2px solid #f4b6a8;
        }

        .error {
            background: #ffe4e6;
            color: #b91c1c;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #f4b6a8;
            border: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            color: #5d4037;
        }

        button:hover {
            background: #f1a89a;
        }

        .footer-text {
            margin-top: 20px;
            color: #8d6e63;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="logo">🐾 PetMatch</div>
    <div class="subtitle">Welcome back! Please sign in to your account.</div>

    <div class="card">
        <h2>LOGIN DULU YA!</h2>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.process') }}" method="POST">
            @csrf

            <label>EMAIL</label>
            <input type="text" name="email" placeholder="Masukkan Email Anda">

            <label>PASSWORD</label>
            <input type="password" name="password" placeholder="Masukkan Password Anda">

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="footer-text">Isi terlebih dahulu!</div>
</div>

</body>
</html>
