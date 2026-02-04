<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetMatch User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #fdf8f5; /* Warna dasar krem susu */
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #5d4037;
        }

        /* SIDEBAR ADMIN STYLE */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            box-shadow: 4px 0 20px rgba(139, 115, 85, 0.05);
            border-right: 1px solid #f3e9e2;
            z-index: 1000;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 0 10px;
            margin-bottom: 50px;
        }

        .sidebar-logo img {
            width: 40px;
            height: 40px;
        }

        .sidebar-logo h3 {
            font-weight: 800;
            font-size: 22px;
            color: #634832;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* MENU NAVIGATION */
        .nav-menu {
            flex-grow: 1;
        }

        .nav-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #a68b7c;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
            padding-left: 10px;
            display: block;
        }

        .sidebar a, .logout-btn {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            margin-bottom: 8px;
            font-size: 15px;
            color: #8a6d5d;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .sidebar i {
            font-size: 20px;
            margin-right: 12px;
        }

        .sidebar a:hover, .logout-btn:hover {
            background: #fffaf7;
            color: #634832;
            transform: translateX(5px);
        }

        /* ACTIVE STATE */
        .sidebar a.active {
            background: #967e76;
            color: #ffffff !important;
            box-shadow: 0 8px 15px rgba(150, 126, 118, 0.25);
        }

        /* FOOTER SIDEBAR (LOGOUT) */
        .sidebar-footer {
            border-top: 1px solid #f3e9e2;
            padding-top: 20px;
        }

        .logout-btn {
            color: #dc3545; /* Warna merah untuk logout */
        }

        .logout-btn:hover {
            background: #fff5f5;
            color: #a71d2a;
        }

        /* CONTENT AREA */
        .content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar { width: 80px; padding: 20px 10px; }
            .sidebar-logo h3, .nav-label, .sidebar span { display: none; }
            .content { margin-left: 80px; }
            .sidebar i { margin-right: 0; }
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="sidebar-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/194/194279.png" alt="logo">
            <h3>PetMatch</h3>
        </div>

        <div class="nav-menu">
            <span class="nav-label">Main Menu</span>
            
            <a href="{{ route('user.index') }}" class="{{ Request::is('user/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
            </a>

            <a href="{{ route('user.permintaan.index') }}" class="{{ Request::is('user/permintaan*') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper-heart-fill"></i> <span>Permintaan</span>

            <a href="{{ route('user-pembayaran.index') }}" class="{{ Request::is('user/pembayaran*') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i> <span>Pembayaran</span>
            </a>

        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> <span>Keluar Akun</span>
                </button>
            </form>
        </div>

    </div>

    <div class="content">
        @yield('content')
    </div>

</body>

</html>