@extends('admin.layouts.app')

@section('content')
<style>
    .chat-card {
        transition: all 0.3s ease;
        border: 1px solid #eee;
        border-radius: 12px;
        overflow: hidden;
    }
    .chat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #634832;
    }
    .user-avatar {
        width: 50px;
        height: 50px;
        background: #fdf8f5;
        color: #634832;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
    }
    .badge-unread {
        background-color: #ff6b6b;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(255, 107, 107, 0.4);
    }
    .badge-read {
        background-color: #2ecc71;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .search-box {
        position: relative;
    }
    .search-box input {
        padding-left: 40px;
        border-radius: 25px;
        border: 1px solid #ddd;
    }
    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark">Daftar Pesan Masuk</h4>
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari user..." onkeyup="filterUsers()">
        </div>
    </div>

    <div class="row" id="userList">
        @forelse($users as $user)
            <div class="col-md-6 col-lg-4 mb-4 user-item">
                <div class="card chat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="user-avatar me-3">
                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="card-title fw-bold mb-1 text-truncate user-name">{{ $user->nama }}</h5>
                                <p class="text-muted mb-0 small text-truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                @if($user->unread_count > 0)
                                    <span class="badge-unread">
                                        {{ $user->unread_count }} Pesan Baru
                                    </span>
                                @else
                                    <span class="badge-read">
                                        <i class="bi bi-check-all"></i> Terbaca
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('admin.chat.show', $user->id) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                                Balas Chat <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/1076/1076335.png" alt="Empty" width="100" class="mb-3 opacity-50">
                <h5 class="text-muted">Belum ada pesan masuk</h5>
            </div>
        @endforelse
    </div>
</div>

<script>
    function filterUsers() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let nodes = document.getElementsByClassName('user-item');

        for (let i = 0; i < nodes.length; i++) {
            let name = nodes[i].querySelector('.user-name').innerText.toLowerCase();
            if (name.includes(filter)) {
                nodes[i].style.display = "block";
            } else {
                nodes[i].style.display = "none";
            }
        }
    }
</script>
@endsection
