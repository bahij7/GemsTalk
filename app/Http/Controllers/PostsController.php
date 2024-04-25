<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use App\Models\Category;

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
        $posts = Post::where('user_id', $user->id)->get();
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

    public function edit($id)
    {
        // Find the post by its ID
        $post = Post::findOrFail($id);
        $categories = Category::all();
        
        // Pass the post data to the edit view
        return view('pages.edit', compact('post', 'categories'));
    }


    public function update(Request $request, $id)
    {
        // Validation logic if needed
        
        $post = Post::findOrFail($id);
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move('images', $fileName);
            $post->media = 'images/' . $fileName;
        }
        

        if ($request->input('link') != $post->link) {
            $post->link = $request->input('link');
        }
        
        $post->save();
        
        return redirect('/posts')->with('success', 'Post updated successfully');
    }
    

    

    public function destroy($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->delete(); 
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
