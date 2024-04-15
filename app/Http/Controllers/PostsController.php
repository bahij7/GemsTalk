<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('welcome', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'category_id' => 'required',
            'content' => 'required',
            'media' => 'nullable|mimes:png,jpg,jpeg,pdf,doc,docx,pptx,xlsx|max:20480',
        ]);

        $filePath = null; 
        
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() .  $file->getClientOriginalName();
            $filePath = $file->move('images', $fileName);

        }

        $post = new Post();
        $post->user_id = auth()->id();
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->media = $fileName; 
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');

    }

}
