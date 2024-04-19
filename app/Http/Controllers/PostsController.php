<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('welcome', ['posts' => $posts]);
    }

    public function myposts()
    {
        $user = Auth::user();
        $posts = $user->posts()->get();
        return view('pages.posts', ['posts' => $posts]);
    }
    
    public function store(Request $request)
    {
        
        $request->validate([
            'content' => 'required',
            'media' => 'nullable|mimes:png,jpg,jpeg,pdf,doc,docx,pptx,xlsx|max:20480',
        ]);

        $filePath = null; 
        
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move('images', $fileName);
            $filePath = 'images/' . $fileName;
        }

        $post = new Post();
        $post->user_id = auth()->id();
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->media = $filePath; 
        $post->link = $request->link; 
        $post->save();

        return redirect('/')->with('success', 'Post created successfully!');

    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->is_deleted = true;
            $post->save();
            return redirect()->back()->with('success', 'Post deleted successfully!');
        }

        return redirect()->back()->with('error', 'Error deleting post!');
    }

    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);

        return view('pages.show', compact('post'));
    }

    public function adminPost()
    {
        $posts = Post::all();
        return view('pages.admin.posts', ['posts' => $posts]);
    }

}
