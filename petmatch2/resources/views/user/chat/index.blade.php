@extends('user.layouts.side')

@section('content')
<style>
    :root {
        --brown: #634832;
        --tan: #967e76;
        --cream: #fffaf7;
        --line: #f3e9e2;
        --text: #8a6d5d;
        --chat-bg: #fdf8f5;
        --user-bubble: #634832;
        --admin-bubble: #ffffff;
    }

    .chat-wrapper {
        max-width: 900px;
        margin: 0 auto;
        height: calc(100vh - 100px); /* Adjust height based on padding */
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(99, 72, 50, 0.08);
        overflow: hidden;
        border: 1px solid var(--line);
    }

    /* Header */
    .chat-header {
        padding: 20px 24px;
        background: #fff;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 16px;
        z-index: 10;
    }

    .admin-avatar {
        width: 48px;
        height: 48px;
        background: var(--cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--line);
        color: var(--brown);
        font-size: 20px;
    }

    .admin-info h5 {
        margin: 0;
        font-weight: 700;
        color: var(--brown);
        font-size: 16px;
    }

    .admin-info span {
        font-size: 12px;
        color: var(--tan);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #2ecc71;
        border-radius: 50%;
        display: inline-block;
    }

    /* Messages Area */
    .chat-body {
        flex: 1;
        padding: 24px;
        background-color: var(--chat-bg);
        background-image: radial-gradient(var(--line) 1px, transparent 1px);
        background-size: 20px 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
        scroll-behavior: smooth;
    }

    .chat-date-divider {
        text-align: center;
        margin: 10px 0;
        position: relative;
    }

    .chat-date-divider span {
        background: rgba(150, 126, 118, 0.1);
        color: var(--tan);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .message-item {
        display: flex;
        flex-direction: column;
        max-width: 75%;
        position: relative;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message-item.user {
        align-self: flex-end;
        align-items: flex-end;
    }

    .message-item.admin {
        align-self: flex-start;
        align-items: flex-start;
    }

    .bubble {
        padding: 12px 18px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.5;
        position: relative;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    }

    .message-item.user .bubble {
        background: var(--user-bubble);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .message-item.admin .bubble {
        background: var(--admin-bubble);
        color: var(--brown);
        border: 1px solid var(--line);
        border-bottom-left-radius: 4px;
    }

    .message-meta {
        font-size: 10px;
        margin-top: 6px;
        opacity: 0.7;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .message-item.user .message-meta {
        color: var(--tan);
    }

    .message-item.admin .message-meta {
        color: var(--tan);
    }

    /* Empty State */
    .empty-chat {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: var(--tan);
        text-align: center;
        opacity: 0.7;
    }

    .empty-chat i {
        font-size: 48px;
        margin-bottom: 16px;
        color: var(--line);
    }

    /* Input Area */
    .chat-footer {
        padding: 16px 24px;
        background: #fff;
        border-top: 1px solid var(--line);
    }

    .input-wrapper {
        display: flex;
        align-items: center;
        background: var(--cream);
        border: 1px solid var(--line);
        border-radius: 50px;
        padding: 6px 6px 6px 20px;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within {
        border-color: var(--tan);
        box-shadow: 0 0 0 4px rgba(150, 126, 118, 0.1);
        background: #fff;
    }

    .chat-input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 14px;
        color: var(--brown);
        padding: 8px 0;
    }

    .chat-input::placeholder {
        color: #bdc3c7;
    }

    .btn-send {
        width: 44px;
        height: 44px;
        background: var(--brown);
        color: #fff;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        margin-left: 10px;
    }

    .btn-send:hover {
        background: var(--tan);
        transform: scale(1.05);
    }

    .btn-send i {
        font-size: 18px;
        margin-left: 2px; /* Visual centering adjustment */
    }

    /* Scrollbar */
    .chat-body::-webkit-scrollbar {
        width: 6px;
    }
    .chat-body::-webkit-scrollbar-track {
        background: transparent;
    }
    .chat-body::-webkit-scrollbar-thumb {
        background: #e0d4cc;
        border-radius: 10px;
    }
</style>

<div class="chat-wrapper">
    <!-- Header -->
    <div class="chat-header">
        <div class="admin-avatar">
            <i class="bi bi-headset"></i>
        </div>
        <div class="admin-info">
            <h5>Admin PetMatch</h5>
            <span><span class="status-dot"></span> Online & Siap Membantu</span>
        </div>
    </div>

    <!-- Chat Body -->
    <div class="chat-body" id="chatBody">
        @if($messages->count() > 0)
            <div class="chat-date-divider">
                <span>Hari Ini</span>
            </div>
        @endif

        @forelse($messages as $msg)
            <div class="message-item {{ $msg->is_admin ? 'admin' : 'user' }}">
                <div class="bubble">
                    {{ $msg->chat }}
                </div>
                <div class="message-meta">
                    {{ $msg->created_at->format('H:i') }}
                    @if(!$msg->is_admin)
                        @if($msg->status_read)
                            <i class="bi bi-check-all text-primary"></i>
                        @else
                            <i class="bi bi-check"></i>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-chat">
                <i class="bi bi-chat-heart"></i>
                <p>Belum ada pesan.<br>Tanyakan sesuatu tentang adopsi hewan!</p>
            </div>
        @endforelse
    </div>

    <!-- Footer Input -->
    <div class="chat-footer">
        <form action="{{ route('user.chat.store') }}" method="POST" id="chatForm">
            @csrf
            <div class="input-wrapper">
                <input type="text" name="chat" class="chat-input" placeholder="Ketik pesan Anda di sini..." required autocomplete="off">
                <button type="submit" class="btn-send">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatBody = document.getElementById('chatBody');
        chatBody.scrollTop = chatBody.scrollHeight;

        // Optional: Submit on Enter (if not using textarea)
        // Form default behavior handles enter for input[type=text]
    });
</script>
@endsection
