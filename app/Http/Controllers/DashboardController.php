<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\Post;
use App\Models\Comments;

class DashboardController extends Controller
{
    public function index()
    {

        $allPosts = Post::count();

        $allUsers = User::count();
        
        $allChats = Chat::count();

        $allComments = Comments::count();



        $users = User::latest()->take(3)->get();

        $chats = Chat::latest()->take(5)->get();

        return view('pages.admin.admin', compact('allPosts', 'allUsers', 'allChats', 'allComments', 'users', 'chats'));
    }


    public function downloadPDF()
    {

        $data = [
            'allPosts' => Post::count(),
            'allUsers' => User::count(),
            'allChats' => Chat::count(),
            'allComments' => Comments::count(),
            'users' => User::latest()->take(3)->get(),
            'chats' => Chat::latest()->take(5)->get(),
        ];

        $html = view('pages.admin.admin', $data)->render();

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        return $dompdf->stream('admin_dashboard.pdf');
    }


}
