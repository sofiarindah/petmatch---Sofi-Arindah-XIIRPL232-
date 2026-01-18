<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergabung dengan PetMatch</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fdf8f5;
            font-family: 'Poppins', sans-serif;
            color: #5d4037;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(139, 115, 85, 0.1);
            border: 2px solid #f3e9e2;
        }

        /* Bagian Samping (Visual) */
        .register-visual {
            background: #fffaf7;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-right: 2px solid #f3e9e2;
        }

        .visual-circle {
            width: 250px;
            height: 250px;
            background: #f3e9e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            overflow: hidden;
            border: 8px solid white;
        }

        .visual-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Bagian Form */
        .register-form-section {
            padding: 50px;
        }

        .brand-title {
            font-weight: 800;
            font-size: 28px;
            color: #634832;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            color: #a68b7c;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-label {
            font-weight: 700;
            font-size: 13px;
            color: #7d5a50;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 5px;
        }

        .custom-input {
            background: #fdf8f5 !important;
            border: 2px solid #f3e9e2 !important;
            border-radius: 15px !important;
            padding: 12px 20px !important;
            color: #5d4037 !important;
            transition: 0.3s;
        }

        .custom-input:focus {
            border-color: #dbc1ac !important;
            box-shadow: 0 0 0 4px rgba(219, 193, 172, 0.15) !important;
            background: #ffffff !important;
        }

        .btn-register {
            background: #967e76 !important;
            color: white !important;
            border: none !important;
            border-radius: 15px !important;
            padding: 14px !important;
            font-weight: 800 !important;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-register:hover {
            background: #634832 !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(99, 72, 50, 0.2) !important;
        }

        .login-link {
            text-decoration: none;
            color: #967e76;
            font-weight: 700;
        }

        .login-link:hover {
            color: #634832;
        }

        /* Animasi masuk */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .register-visual { display: none; }
            .register-form-section { padding: 35px; }
        }
    </style>
</head>
<body>

<div class="container fade-in">
    <div class="register-container row g-0">
        
        {{-- Sisi Kiri: Visual --}}
        <div class="col-md-5 register-visual text-center">
            <div class="visual-circle">
                <img src="{{ asset('photos/kumpulan.jpeg') }}" alt="PetMatch Group">
            </div>
            <h5 class="fw-bold mt-2" style="color: #634832;">Bergabunglah</h5>
            <p class="small text-muted px-4">Bantu kami mencarikan rumah terbaik untuk teman-teman kecil kita.</p>
        </div>

        {{-- Sisi Kanan: Form --}}
        <div class="col-md-7 register-form-section">
            <div class="text-center text-md-start">
                <h2 class="brand-title">Daftar Akun</h2>
                <p class="brand-subtitle">Mulailah perjalanan adopsi Anda hari ini.</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control custom-input" placeholder="Nama" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control custom-input" placeholder="Pilih username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control custom-input" placeholder="contoh@email.com" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    Buat Akun Sekarang
                </button>

                <div class="text-center mt-4">
                    <span class="text-muted small">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="login-link small ms-1">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>