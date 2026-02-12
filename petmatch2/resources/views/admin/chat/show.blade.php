@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --chat-primary: #634832;
        --chat-secondary: #fdf8f5;
        --chat-bg: #f5f7fb;
    }
    
    .chat-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        height: 75vh;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    /* Header Styling */
    .chat-header {
        padding: 15px 25px;
        background: #fff;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 10;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .user-avatar {
        width: 45px;
        height: 45px;
        background: var(--chat-secondary);
        color: var(--chat-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        border: 2px solid #eee;
    }
    
    .user-details h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #333;
    }
    
    .user-details p {
        margin: 0;
        font-size: 12px;
        color: #777;
    }

    /* Chat Body Styling */
    .chat-body {
        flex: 1;
        padding: 25px;
        overflow-y: auto;
        background-color: var(--chat-bg);
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23634832' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Bubble Styling */
    .chat-bubble {
        max-width: 70%;
        padding: 12px 18px;
        border-radius: 18px;
        position: relative;
        font-size: 14px;
        line-height: 1.5;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .bubble-user {
        align-self: flex-start;
        background: #fff;
        color: #444;
        border-bottom-left-radius: 4px;
        border: 1px solid #eee;
    }
    
    .bubble-user .sender-name {
        font-size: 11px;
        font-weight: 700;
        color: var(--chat-primary);
        margin-bottom: 4px;
        display: block;
    }

    .bubble-admin {
        align-self: flex-end;
        background: var(--chat-primary);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .chat-time {
        font-size: 10px;
        margin-top: 5px;
        text-align: right;
        opacity: 0.8;
    }

    /* Footer Styling */
    .chat-footer {
        padding: 15px 25px;
        background: #fff;
        border-top: 1px solid #eee;
    }
    
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border-radius: 30px;
        padding: 5px 10px;
        border: 1px solid #eee;
        transition: all 0.3s;
    }
    
    .input-wrapper:focus-within {
        border-color: var(--chat-primary);
        box-shadow: 0 0 0 3px rgba(99, 72, 50, 0.1);
    }
    
    .chat-input {
        border: none;
        background: transparent;
        padding: 10px 15px;
        flex: 1;
        outline: none;
        font-size: 14px;
    }
    
    .btn-send {
        background: var(--chat-primary);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        margin-left: 5px;
    }
    
    .btn-send:hover {
        transform: scale(1.05);
        background: #4a3625;
    }

    /* Scrollbar */
    .chat-body::-webkit-scrollbar {
        width: 6px;
    }
    .chat-body::-webkit-scrollbar-track {
        background: transparent;
    }
    .chat-body::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 10px;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Header Nav for Mobile/Breadcrumb -->
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('admin.chat.index') }}" class="text-decoration-none text-muted me-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="chat-card">
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <h5>{{ $user->nama }}</h5>
                            <p>
                                <i class="bi bi-envelope"></i> {{ $user->email }}
                                <span class="mx-1">•</span>
                                <i class="bi bi-person"></i> {{ $user->username }}
                            </p>
                        </div>
                    </div>
                    <div class="actions">
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                            {{ $messages->count() }} Pesan
                        </span>
                    </div>
                </div>
                
                <!-- Chat Body -->
                <div class="chat-body" id="chatBody">
                    @forelse($messages as $msg)
                        <div class="chat-bubble {{ $msg->is_admin ? 'bubble-admin' : 'bubble-user' }}">
                            {{ $msg->chat }}
                            
                            <div class="chat-time">
                                @if($msg->is_admin)
                                    <i class="bi bi-check-all"></i>
                                @endif
                                {{ $msg->created_at->format('H:i') }}
                                <small class="ms-1" style="font-size: 9px;">{{ $msg->created_at->format('d M') }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center my-auto">
                            <div class="mb-3">
                                <i class="bi bi-chat-dots" style="font-size: 3rem; color: #ddd;"></i>
                            </div>
                            <h6 class="text-muted fw-bold">Belum ada percakapan</h6>
                            <p class="text-muted small">Mulai kirim pesan sekarang.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Footer -->
                <div class="chat-footer">
                    <form action="{{ route('admin.chat.store', $user->id) }}" method="POST">
                        @csrf
                        <div class="input-wrapper">
                            <input type="text" name="chat" class="chat-input" placeholder="Tulis pesan balasan..." required autocomplete="off" autofocus>
                            <button class="btn-send" type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto scroll to bottom
    const chatBody = document.getElementById('chatBody');
    if(chatBody) {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>
@endsection
