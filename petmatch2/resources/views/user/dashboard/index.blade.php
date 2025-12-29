@extends('user.layouts.side')

@section('content')
<style>
    body {
        background: #f6f8f5;
    }

    /* ===== GENERAL ===== */
    .card-rounded {
        border-radius: 18px;
    }

    .avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        border: 3px solid #3ddc84;
        object-fit: cover;
    }

    /* ===== SEARCH ===== */
    .search-box {
        background: #fff;
        border-radius: 16px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,.05);
    }

    .search-box input {
        border: none;
        outline: none;
        flex: 1;
    }

    /* ===== CATEGORY BULAT ===== */
    .category-wrapper {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 25px;
    }

    .category-card {
        width: 110px;
        height: 110px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 15px rgba(0,0,0,.06);
        transition: .25s ease;
        cursor: pointer;
    }

    .category-card:hover {
        background: #eafff3;
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,.12);
    }

    .category-card img {
        width: 45px;
        margin-bottom: 8px;
    }

    .category-card span {
        font-weight: 600;
        font-size: 14px;
        color: #2f4f3a;
    }

    /* ===== PET CARD ===== */
    .pet-card {
        border-radius: 18px;
        overflow: hidden;
        border: none;
    }

    .pet-card img {
        height: 200px;
        object-fit: cover;
    }

    .location-badge {
        background: rgba(255,255,255,.9);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 13px;
    }
</style>

<div class="container">

    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar">
            <div>
                <h5 class="mb-0 fw-bold">Selamat Datang, Sarah!</h5>
                <small class="text-muted">Siap bertemu teman baru?</small>
            </div>
        </div>
        <i class="bi bi-bell fs-4"></i>
    </div>

    <!-- ===== SEARCH ===== -->
    <div class="search-box mb-4">
        <i class="bi bi-search text-muted"></i>
        <input type="text" placeholder="Cari anjing, kucing...">
        <i class="bi bi-sliders text-success"></i>
    </div>

    <!-- ===== KATEGORI ===== -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Kategori Hewan</h5>
        <a href="#" class="text-success fw-semibold">Lihat Semua</a>
    </div>

    <div class="category-wrapper">
        <div class="category-card">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png">
            <span>Kucing</span>
        </div>

        <div class="category-card">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616554.png">
            <span>Anjing</span>
        </div>

        <div class="category-card">
            <img src="https://cdn-icons-png.flaticon.com/512/3069/3069172.png">
            <span>Burung</span>
        </div>
    </div>

    <!-- ===== HEWAN PILIHAN ===== -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Hewan Pilihan</h5>
        <div>
            <i class="bi bi-chevron-left me-2"></i>
            <i class="bi bi-chevron-right"></i>
        </div>
    </div>

    <div class="row g-3">

        <!-- PET 1 -->
        <div class="col-md-6">
            <div class="card pet-card shadow-sm">
                <img src="https://placedog.net/600/400?id=12">
                <div class="card-body">
                    <span class="location-badge mb-2 d-inline-block">
                        <i class="bi bi-geo-alt"></i> Jakarta Selatan
                    </span>
                    <h6 class="fw-bold mb-0">Budi</h6>
                    <small class="text-muted">Golden Retriever • 2 Thn</small>
                    <span class="badge bg-success float-end">Jantan</span>
                </div>
            </div>
        </div>

        <!-- PET 2 -->
        <div class="col-md-6">
            <div class="card pet-card shadow-sm">
                <img src="https://placekitten.com/600/400">
                <div class="card-body">
                    <span class="location-badge mb-2 d-inline-block">
                        <i class="bi bi-geo-alt"></i> Bandung
                    </span>
                    <h6 class="fw-bold mb-0">Mochi</h6>
                    <small class="text-muted">Siamese • 1 Thn</small>
                    <span class="badge bg-info float-end">Betina</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
