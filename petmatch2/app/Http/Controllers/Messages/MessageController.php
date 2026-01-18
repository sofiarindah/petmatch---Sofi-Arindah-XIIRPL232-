<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('messages.index');

        $authUser = auth()->user();

    if ($authUser->role === 'admin') {
        // Admin → ambil user pertama / aktif
        $chatUser = User::where('role', 'admin')->first();
    } else {
        // User → lawan chat adalah admin
        $chatUser = User::where('role', 'user')->first();
    }

    return view('messages.index', compact('chatUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat' => 'required|string'
        ]);

        // dd($request->chat);

        $message = Chat::create([
            'user_id'     => Auth::id(),
            'chat'        => $request->chat,
            'status_read' => 0
        ]);

        return response()->json([
            'success' => true,
            'data'    => $message
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getMessages()
    {
        $messages = Chat::all();

        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }
}
