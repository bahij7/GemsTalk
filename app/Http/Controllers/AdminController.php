<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Chat;
use App\Models\Category;
use App\Models\Comments;

class AdminController extends Controller
{
    public function deletep($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->delete(); 
            return redirect('/admin/posts')->with('success', 'Post deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'Error deleting post!');
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete(); 
            return redirect('/admin/users')->with('success', 'User deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'Error deleting user!');
    }

    public function deletee($chatId)
    {
        $chat = CHat::find($chatId);
        if ($chat) {
            $chat->delete(); 
            return redirect('/admin/chat')->with('success', 'Message deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'Error deleting this message!');
    }


    
    public function deleteee($commentId)
    {
        $comment = Comments::find($commentId);
        if ($comment) {
            $comment->delete(); 
            return redirect('/admin/comments')->with('success', 'Comment deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'Error deleting this Comment!');
    }


    
    public function deleteeee($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $category->delete(); 
            return redirect('/admin/categories')->with('success', 'Category deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'Error deleting this Category!');
    }


    public function updateRole(User $user)
    {
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();
        
        return redirect('/admin/users')->with('success', 'User role updated successfully!');
    }
}

