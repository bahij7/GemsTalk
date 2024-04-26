<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $user_id = Auth::id();

        $comment = new Comments();
        $comment->content = $request->input('content');
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function adminComment()
    {
        $comments = Comments::with('post', 'user')->latest()->simplePaginate(20);
        return view('pages.admin.comments', compact('comments'));
    }
}
