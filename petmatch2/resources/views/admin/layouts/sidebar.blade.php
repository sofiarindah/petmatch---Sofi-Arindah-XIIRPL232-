<!DOCTYPE html>
<html>
<head>
    <title>PetMatch User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f7e9d8;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            padding: 25px 20px;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            border-right: 3px solid #f0d4b4;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .sidebar-logo img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .sidebar h3 {
            font-weight: 700;
            color: #6e4c2e;
            margin: 0;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 12px;
            font-size: 17px;
            color: #4a3b2b;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #f4d9bd;
        }

        .sidebar a.active {
            background: #e2b889;
            font-weight: 700;
            color: white !important;
        }

        /* CONTENT */
        .content {
            margin-left: 280px;
            padding: 30px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR USER -->
<div class="sidebar">

    <div class="sidebar-logo">
        <img src="https://cdn-icons-png.flaticon.com/512/194/194279.png" alt="logo">
        <h3>PetMatch</h3>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-heart me-2"></i> Beranda
    </a>

    <a href="{{ route('admin.hewan.index') }}"
       class="{{ Request::is('user/hewan*') ? 'active' : '' }}">
        <i class="bi bi-search-heart me-2"></i> Cari Hewan
    </a>

    <a href="{{ route('admin.permintaan.index') }}"
       class="{{ Request::is('user/permintaan*') ? 'active' : '' }}">
        <i class="bi bi-send-heart me-2"></i> Permintaan Saya
    </a>

    <hr>

    <a href="{{ route('admin.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
