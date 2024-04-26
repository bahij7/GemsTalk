<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->simplePaginate(20);
        return view('pages.admin.users', ['users' => $users]);
    }

    public function admins()
    {
        $adminUsers = User::where('role', 'admin')->latest()->simplePaginate(10);
        
        return view('pages.admin.admins', ['users' => $adminUsers]);
    }

}
