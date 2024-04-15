<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;


class CreatePostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('pages.create', compact('categories'));
    }

}
