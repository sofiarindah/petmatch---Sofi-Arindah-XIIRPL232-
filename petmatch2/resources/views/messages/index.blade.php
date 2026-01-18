@extends(auth()->user()->role === 'admin'
? 'admin.layouts.sidebar'
: 'user.layouts.side'
)
<meta name="user-id" content="{{ auth()->id() }}">

@section('content')
<style>
    body {
        background: #fdf8f5; /* Background krem pucat agar senada */
        font-family: 'Poppins', sans-serif;
    }

    /* ===== CHAT CONTAINER ===== */
    .chat-wrapper {
        max-width: 900px;
        margin: auto;
        background: #fff;
        border-radius: 25px; /* Lebih membulat agar terkesan soft */
        display: flex;
        flex-direction: column;
        height: calc(100vh - 140px);
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.1);
        border: 2px solid #f3e9e2;
        overflow: hidden;
    }

    /* ===== HEADER ===== */
    .chat-header {
        padding: 18px 25px;
        border-bottom: 2px solid #f3e9e2;
        display: flex;
        align-items: center;
        gap: 15px;
        background: #ffffff;
    }

    .chat-header img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #dbc1ac;
    }

    .chat-header h6 {
        margin: 0;
        font-weight: 700;
        color: #634832;
    }

    .chat-header small {
        color: #a68b7c;
        font-weight: 500;
    }

    /* ===== CHAT BODY ===== */
    .chat-body {
        flex: 1;
        padding: 25px;
        overflow-y: auto;
        background: #fffaf7; /* Warna latar chat area lebih hangat */
    }

    .chat-date {
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #dbc1ac;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 20px 0;
    }

    /* ===== CHAT BUBBLES ===== */
    .chat-row {
        display: flex;
        margin-bottom: 18px;
    }

    .chat-row.left {
        justify-content: flex-start;
    }

    .chat-row.right {
        justify-content: flex-end;
    }

    .chat-bubble {
        max-width: 75%;
        padding: 14px 18px;
        border-radius: 20px;
        font-size: 14px;
        line-height: 1.5;
        position: relative;
    }

    /* Bubble dari Orang Lain (Kiri) */
    .chat-row.left .chat-bubble {
        background: #ffffff;
        color: #5d4037;
        border-bottom-left-radius: 5px;
        box-shadow: 0 4px 15px rgba(139, 115, 85, 0.05);
        border: 1px solid #f3e9e2;
    }

    /* Bubble dari Kita (Kanan) */
    .chat-row.right .chat-bubble {
        background: #967e76; /* Warna Coklat Susu */
        color: #fff;
        border-bottom-right-radius: 5px;
        box-shadow: 0 4px 15px rgba(150, 126, 118, 0.2);
    }

    .chat-time {
        font-size: 10px;
        margin-top: 8px;
        opacity: .8;
        font-weight: 500;
    }

    .chat-row.right .chat-time {
        text-align: right;
    }

    /* ===== INPUT AREA ===== */
    .chat-input {
        padding: 20px 25px;
        border-top: 2px solid #f3e9e2;
        display: flex;
        align-items: center;
        gap: 15px;
        background: #fff;
    }

    .chat-input input {
        flex: 1;
        border-radius: 15px;
        border: 2px solid #f3e9e2;
        padding: 12px 20px;
        outline: none;
        transition: 0.3s;
        background: #fdf8f5;
        color: #5d4037;
    }

    .chat-input input:focus {
        border-color: #dbc1ac;
    }

    .chat-input button {
        border-radius: 15px;
        width: 50px;
        height: 50px;
        border: none;
        background: #967e76;
        color: #fff;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-input button:hover {
        background: #634832;
        transform: scale(1.05);
    }
</style>

<div class="container py-4">

    <div class="chat-wrapper">

        <div class="chat-header">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=dbc1ac&color=fff">
            <div>
                <h6>{{ auth()->user()->username }}</h6>
                <small>Sedang aktif</small>
            </div>
        </div>

        <div class="chat-body" id="chat-body">
            <div class="chat-date">Hari Ini</div>
        </div>

        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Tulis pesan anda di sini...">
            <button id="send-chat">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>

    </div>

</div>

<script>
    document.getElementById('send-chat').addEventListener('click', sendChat);

    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendChat();
        }
    });

    function sendChat() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();

        if (!message) return;

        fetch("{{ route('messages.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    chat: message
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    input.value = '';
                    loadMessages(); 
                }
            })
            .catch(err => console.error(err));
    }

    const chatBody = document.getElementById('chat-body');
    const meta = document.querySelector('meta[name="user-id"]');
    const myUserId = meta ? parseInt(meta.content) : null;

    function loadMessages() {
        fetch("{{ route('messages.getmessages') }}", {
                headers: {
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(res => {
                if (!res.success) return;

                chatBody.innerHTML = '<div class="chat-date">Hari Ini</div>';

                res.data.forEach(msg => {
                    const side = parseInt(msg.user_id) === myUserId ? 'right' : 'left';

                    const time = new Date(msg.created_at).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    chatBody.innerHTML += `
                <div class="chat-row ${side}">
                    <div class="chat-bubble shadow-sm">
                        ${escapeHtml(msg.chat)}
                        <div class="chat-time">${time}</div>
                    </div>
                </div>
            `;
                });

                chatBody.scrollTop = chatBody.scrollHeight;
            });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    loadMessages();
</script>

@endsection