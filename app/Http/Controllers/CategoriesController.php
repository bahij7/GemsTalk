<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.admin.categories', compact('categories'));
    }
}
