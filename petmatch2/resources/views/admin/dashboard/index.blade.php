@extends('admin.layouts.app')

@section('content')

<style>
    body {
        background: #fdf8f5 !important;
        font-family: 'Poppins', sans-serif;
    }

    /* Title */
    .page-title {
        font-size: 30px;
        font-weight: 800;
        color: #634832; /* Coklat Tua Pastel */
        margin-bottom: 28px;
        letter-spacing: .5px;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 5px;
        background: #dbc1ac;
        border-radius: 10px;
    }

    /* Statistic Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 25px;
        box-shadow: 0 10px 25px rgba(139, 115, 85, 0.08);
        border: 2px solid #f3e9e2;
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(139, 115, 85, 0.15);
        border-color: #dbc1ac;
    }

    .stat-icon {
        font-size: 40px;
        color: #967e76;
        margin-bottom: 12px;
        background: #fdf8f5;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
    }

    .stat-title {
        font-size: 16px;
        font-weight: 600;
        color: #7d5a50;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-value {
        font-size: 34px;
        font-weight: 800;
        color: #634832;
        margin-top: 5px;
    }

    /* Section Title */
    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #634832;
        margin-bottom: 20px;
        margin-top: 10px;
    }

    /* Menu Card / Quick Actions */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
    }

    .menu-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 25px;
        box-shadow: 0 8px 20px rgba(139, 115, 85, 0.06);
        text-align: center;
        cursor: pointer;
        transition: .3s;
        border: 2px solid #f3e9e2;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        background: #fffaf7;
        border-color: #dbc1ac;
    }

    .menu-icon {
        font-size: 45px;
        color: #967e76;
        margin-bottom: 15px;
        transition: .3s;
    }

    .menu-title {
        font-size: 18px;
        font-weight: 700;
        color: #634832;
    }

    /* Notification cards */
    .notif-box {
        background: white;
        padding: 25px;
        border-radius: 25px;
        box-shadow: 0 10px 25px rgba(139, 115, 85, 0.05);
        border: 2px solid #f3e9e2;
        margin-top: 5px;
        margin-bottom: 30px;
    }

    .notif-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 10px;
        align-items: center;
        transition: .2s;
        background: #fdf8f5;
    }

    .notif-item:hover {
        background: #f3e9e2;
    }

    .notif-item:last-child { margin-bottom: 0; }

    .notif-icon {
        font-size: 24px;
        color: #967e76;
    }

    .notif-text {
        font-size: 14px;
        color: #5d4037;
        font-weight: 500;
    }

</style>

<div class="container-fluid py-4">

    <div class="page-title">Dashboard Admin</div>

    <div class="stats-container">

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-grid-3x3-gap"></i></div>
            <div class="stat-title">Total Hewan</div>
            <div class="stat-value">{{ $totalHewan }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-envelope-heart"></i></div>
            <div class="stat-title">Permintaan Adopsi</div>
            <div class="stat-value">{{ $totalPermintaan }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-chat-left-dots"></i></div>
            <div class="stat-title">Pesan Masuk</div>
            <div class="stat-value">{{ $totalPesan }}</div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="section-title">Aksi Cepat</div>
            <div class="menu-grid">
                <a href="{{ route('admin.hewan.index') }}" class="menu-card text-decoration-none">
                    <i class="bi bi-plus-circle menu-icon"></i>
                    <div class="menu-title">Kelola Hewan</div>
                </a>

                <a href="{{ route('admin.permintaan.index') }}" class="menu-card text-decoration-none">
                    <i class="bi bi-file-earmark-check menu-icon"></i>
                    <div class="menu-title">Cek Permintaan</div>
                </a>

                <a href="{{ route('messages.index') }}" class="menu-card text-decoration-none">
                    <i class="bi bi-chat-quote menu-icon"></i>
                    <div class="menu-title">Lihat Pesan</div>
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="section-title">Notifikasi Terkini</div>
            <div class="notif-box">
                <div class="notif-item">
                    <i class="bi bi-info-circle notif-icon"></i>
                    <div class="notif-text">Permintaan adopsi menunggu verifikasi admin.</div>
                </div>

                <div class="notif-item">
                    <i class="bi bi-chat-left-text notif-icon"></i>
                    <div class="notif-text">Terdapat pesan pengguna yang belum dibaca.</div>
                </div>

                <div class="notif-item">
                    <i class="bi bi-clock-history notif-icon"></i>
                    <div class="notif-text">Pembaruan data hewan berhasil dilakukan.</div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection