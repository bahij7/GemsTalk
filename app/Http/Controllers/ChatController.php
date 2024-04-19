<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{

    public function index()
    {
        $chats = Chat::all();
        return view('pages.chat', compact('chats'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'content' => 'required|string',
    ]);

    $chat = new Chat();
    $chat->user_id = auth()->id();
    $chat->content = $request->input('content');
    

    $chat->save();

    return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function adminChat()
    {
        $chats = Chat::latest()->get();
        return view('pages.admin.chat', compact('chats'));
    }


}
