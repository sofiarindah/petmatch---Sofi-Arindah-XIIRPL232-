<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('user.chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chat' => 'required|string',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'chat' => $request->chat,
            'is_admin' => 0, // User sending
            'status_read' => 0,
        ]);

        return redirect()->route('user.chat.index');
    }
}
