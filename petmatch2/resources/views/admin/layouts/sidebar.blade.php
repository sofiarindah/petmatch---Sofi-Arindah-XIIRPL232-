<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetMatch User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background: #fdf8f5;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR CUSTOM */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            padding: 35px 20px;
            box-shadow: 5px 0 25px rgba(139, 115, 85, 0.05);
            border-right: 2px solid #f3e9e2;
            z-index: 1000;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 50px;
            padding-left: 10px;
        }

        .sidebar-logo img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            filter: sepia(0.3);
        }

        .sidebar h3 {
            font-weight: 800;
            color: #634832;
            margin: 0;
            font-size: 22px;
            letter-spacing: -0.5px;
        }

        /* MENU LINKS */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            margin-bottom: 8px;
            font-size: 15px;
            color: #967e76;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .sidebar a i {
            font-size: 1.2rem;
            margin-right: 15px;
        }

        .sidebar a:hover {
            background: #fffaf7;
            color: #634832;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: #967e76;
            color: #ffffff !important;
            box-shadow: 0 8px 15px rgba(150, 126, 118, 0.25);
        }

        .sidebar hr {
            border-top: 2px solid #f3e9e2;
            margin: 25px 0;
            opacity: 1;
        }

        .logout-link {
            color: #d63384 !important; /* Warna pink kecokelatan untuk logout */
        }

        .logout-link:hover {
            background: #fff0f3 !important;
        }

        /* CONTENT AREA */
        .content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }

        /* Scrollbar Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #f3e9e2;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="sidebar-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/194/194279.png" alt="logo">
            <h3>PetMatch</h3>
        </div>

        <nav>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ Request::is('admin/dashboard') || Request::is('user/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Beranda
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="{{ Request::is('admin/categories*') || Request::is('user/categories*') ? 'active' : '' }}">
                <i class="bi bi-collection-fill"></i> Kategori
            </a>

            <a href="{{ route('admin.hewan.index') }}"
                class="{{ Request::is('admin/hewan*') || Request::is('user/hewan*') ? 'active' : '' }}">
                <i class="bi bi-heart-pulse-fill"></i> Hewan
            </a>

            <a href="{{ route('admin.permintaan.index') }}"
                class="{{ Request::is('admin/permintaan*') || Request::is('user/permintaan*') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper-heart-fill"></i> Permintaan
            </a>

            <a href="{{ route('messages.index') }}"
                class="{{ Request::is('messages*') || Request::is('user/messages*') ? 'active' : '' }}">
                <i class="bi bi-chat-right-text-fill"></i> Chat
            </a>

            <a href="{{ route('admin.pembayaran.index') }}"
                class="{{ Request::is('admin/pembayaran*') || Request::is('user/pembayaran*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-2-back-fill"></i> Pembayaran
            </a>

            <hr>

            <a href="{{ route('logout') }}" class="logout-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>