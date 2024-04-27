<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Categories - GemsTalk</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
 
        <div class="sidebar">
            <div class="logo"><a href="/">💎 GemsTalk</a></div>

            <div class="auth">
                @if(auth()->check())
                <p style="font-size: 20px">Welcome<br/> <span style="font-weight:700">{{ auth()->user()->name }}</span> 👋</p>
            @endif
            </div>

            <div class="links" style="justify-content: start">
                <div class="section">
                    <div class="section-head">Administration</div>
                    <div class="section-links">
                        <a href="/admin"><i class="fa-solid fa-house"></i>Dashboard</a>
                        <a href="/admin/admins"><i class="fa-solid fa-user-tie"></i>Admins</a>
                        <a href="/admin/users"><i class="fa-solid fa-users"></i>Users</a>
                        <a href="/admin/posts"><i class="fa-regular fa-note-sticky"></i>Posts</a>
                        <a href="/admin/chat"><i class="fa-regular fa-message"></i>Chats</a>
                        <a href="/admin/comments"><i class="fa-regular fa-comment"></i>Comments</a>
                        <a href="/admin/categories"><i class="fa-solid fa-list"></i>Categories</a>
                        
                    </div>
                </div> 

                
            </div>
            <div class="tag">Ahmed Bahij © 2024</div>
        </div>

        <div class="container">
            
            <div class="main">
                
                <div class="main-body">
                        
                @if(session()->has('success'))
                <div class="popup success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="popup danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('categories.store') }}" style="margin-top: 2%; margin-bottom: 2%">
                @csrf
                <input type="text" name="name" placeholder="Category's Name" style="margin-bottom: 6px"/>   
                <button type="submit">Create a new Category</button>
            </form>
            @if ($categories->isEmpty())
                <p>No Categories.</p>
            @else
           
            <p style="font-size: 12px">TOTAL CATEGORIES ({{$categories->count()}})</p>

        
            

                    <table>
                        <tr><th>Category</th><th>Actions</th></tr>
                            @foreach ($categories as $category)
                        <tr><td style="width: 80%; font-weight: 500;">{{ $category->name }}</td><td style="width: 20%">
                            <form method="POST" action="{{ route('admincategory.delete', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form></td></tr>
                            @endforeach
                    </table>
                @endif
                </div>

            </div>

        </div>
        



    </body>
</html>