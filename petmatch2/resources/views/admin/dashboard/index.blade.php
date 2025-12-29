@extends('admin.layouts.app')

@section('content')

<style>
    /* Title */
    .page-title {
        font-size: 34px;
        font-weight: 800;
        color: #8a6d3b;
        margin-bottom: 28px;
        letter-spacing: .5px;
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
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 25px rgba(0,0,0,0.18);
    }

    .stat-icon {
        font-size: 48px;
        color: #6c4c28;
        margin-bottom: 12px;
    }

    .stat-title {
        font-size: 18px;
        font-weight: 600;
        color: #6c4c28;
    }

    .stat-value {
        font-size: 36px;
        font-weight: 700;
        color: #8a6d3b;
        margin-top: 6px;
    }

    /* Section Title */
    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #6c4c28;
        margin-bottom: 18px;
        margin-top: 30px;
    }

    /* Menu Card */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
    }

    .menu-card {
        background: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.12);
        text-align: center;
        cursor: pointer;
        transition: .3s;
        border: 2px solid transparent;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        border-color: #c8a079;
    }

    .menu-icon {
        font-size: 50px;
        color: #6c4c28;
        margin-bottom: 12px;
        transition: .3s;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.15);
    }

    .menu-title {
        font-size: 20px;
        font-weight: 700;
        color: #6c4c28;
    }

    /* Activity table */
    .dash-table {
        width: 100%;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    .dash-table thead {
        background: #f0e6d8;
    }

    .dash-table th, .dash-table td {
        padding: 14px 18px;
        font-size: 15px;
    }

    .dash-table tbody tr:hover {
        background: #fdf7ef;
    }

    /* Notification cards */
    .notif-box {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        margin-top: 25px;
    }

    .notif-item {
        display: flex;
        gap: 15px;
        margin-bottom: 14px;
        align-items: center;
    }

    .notif-item:last-child { margin-bottom: 0; }

    .notif-icon {
        font-size: 28px;
        color: #8a6d3b;
    }

    .notif-text {
        font-size: 15px;
    }

</style>

<div class="container-fluid">

    <!-- PAGE TITLE -->
    <div class="page-title">Dashboard Admin</div>

    <!-- STATISTICS -->
    <div class="stats-container">

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-hash"></i></div>
            <div class="stat-title">Total Hewan</div>
            <div class="stat-value">54</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-title">Total Pengguna</div>
            <div class="stat-value">212</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-envelope-paper"></i></div>
            <div class="stat-title">Permintaan Adopsi</div>
            <div class="stat-value">18</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-chat-dots"></i></div>
            <div class="stat-title">Pesan Masuk</div>
            <div class="stat-value">7</div>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="section-title">Aksi Cepat</div>
    <div class="menu-grid">

        <a href="{{ route('admin.hewan.index') }}" class="menu-card text-decoration-none">
            <i class="bi bi-hash menu-icon"></i>
            <div class="menu-title">Kelola Hewan</div>
        </a>

        <a href="{{ route('admin.permintaan.index') }}" class="menu-card text-decoration-none">
            <i class="bi bi-envelope menu-icon"></i>
            <div class="menu-title">Permintaan Adopsi</div>
        </a>

        <a href="#" class="menu-card text-decoration-none">
            <i class="bi bi-chat-dots menu-icon"></i>
            <div class="menu-title">Pesan Masuk</div>
        </a>

        <a href="#" class="menu-card text-decoration-none">
            <i class="bi bi-gear menu-icon"></i>
            <div class="menu-title">Pengaturan</div>
        </a>

    </div>

    <!-- RECENT ACTIVITIES -->
    <div class="section-title">Aktivitas Terbaru</div>

    <table class="dash-table">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Aktivitas</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hari ini</td>
                <td>Pengguna baru mendaftar</td>
                <td>Nama: Rina Andini</td>
            </tr>
            <tr>
                <td>2 jam lalu</td>
                <td>Permintaan adopsi baru</td>
                <td>Kucing Persia #21</td>
            </tr>
            <tr>
                <td>Yesterday</td>
                <td>Hewan baru ditambahkan</td>
                <td>Anjing Golden Retriever</td>
            </tr>
            <tr>
                <td>Yesterday</td>
                <td>Admin memperbarui data hewan</td>
                <td>Kelinci Anggora</td>
            </tr>
        </tbody>
    </table>

    <!-- NOTIFICATIONS -->
    <div class="section-title">Notifikasi</div>
    <div class="notif-box">
        <div class="notif-item">
            <i class="bi bi-bell notif-icon"></i>
            <div class="notif-text">Permintaan adopsi menunggu verifikasi.</div>
        </div>

        <div class="notif-item">
            <i class="bi bi-exclamation-circle notif-icon"></i>
            <div class="notif-text">Pesan pengguna belum dibaca.</div>
        </div>

        <div class="notif-item">
            <i class="bi bi-star notif-icon"></i>
            <div class="notif-text">Hewan dengan rating tertinggi telah diperbarui.</div>
        </div>
    </div>

</div>

@endsection