<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Get users who have messages, order by latest message
        $users = User::whereHas('messages')
            ->withCount(['messages as unread_count' => function ($query) {
                $query->where('is_admin', 0)->where('status_read', 0);
            }])
            ->get();

        return view('admin.chat.index', compact('users'));
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        
        // Mark messages from this user as read
        Message::where('user_id', $userId)
            ->where('is_admin', 0)
            ->update(['status_read' => 1]);

        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.chat.show', compact('user', 'messages'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'chat' => 'required|string',
        ]);

        Message::create([
            'user_id' => $userId,
            'chat' => $request->chat,
            'is_admin' => 1, // Admin replying
            'status_read' => 0,
        ]);

        return redirect()->route('admin.chat.show', $userId);
    }
}
