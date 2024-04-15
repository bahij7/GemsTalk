<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Discover GemsTalk: Create a New Post</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
            <div class="sidebar">
                <div class="logo">💎 GemsTalk</div>

                <div class="auth">
                    @if(auth()->check())
                    <p style="font-size: 20px">Welcome<br/> <span style="font-weight:700">{{ auth()->user()->name }}</span> 👋</p>
                @else
                    <p>Guest Account <a href="/login">Login</a> or <a href="/register">Sign up</a></p>
                @endif
                </div>

                <div class="links" style="justify-content: {{ Auth::check() ? '' : 'start' }}">
                    <div class="section">
                        <div class="section-head">Discovery</div>
                        <div class="section-links">
                            <a href="/"><i class="fa-solid fa-house"></i> Feed</a>
                            <a href=""><i class="fa-regular fa-star"></i> Topic-Specific</a>
                            <a href=""><i class="fa-regular fa-message"></i>  Off-Topic</a>
                        </div>
                    </div> 

                    @if(auth()->check())
                    <div class="section">
                        <div class="section-head">Account</div>
                        <div class="section-links">
                            <a href="/profile"><i class="fa-regular fa-circle-user"></i> Profile</a>
                            <a href=""><i class="fa-regular fa-note-sticky"></i> My Posts</a>
                            
                       <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        </div>
                    </div>
                @endif
                    
                </div>
                <div class="tag">Ahmed Bahij © 2024</div>
            </div>

        <div class="container">

            

            <div class="main">

                <div class="main-body">
                    <div class="create">
                        <div class="create-head">
                            {{ auth()->user()->name }}
                        </div>
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="create-body">
                            <select name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <textarea name="content" placeholder="Start typing your post..." required></textarea>
                            <input type="file" name="media" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx, .pptx, .xlsx"/>
                        </div>

                        <div class="create-foot">
                            <button type="button"><a href='/'>Cancel</a></button>
                            <button type="submit">Post</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>




    </body>
</html>