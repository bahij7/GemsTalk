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
            <div class="logo"><a href="/">💎 GemsTalk</a></div>

            <div class="auth">
                @if(auth()->check())
                <p style="font-size: 20px">Welcome<br/> <span style="font-weight:700">{{ auth()->user()->name }}</span> 👋</p>
            @else
                <p>Guest Account <a href="/login">Login</a> or <a href="/signup">Sign up</a></p>
            @endif
            </div>

            <div class="links" style="justify-content: {{ Auth::check() ? '' : 'start' }}">
                <div class="section">
                    <div class="section-head">Discovery</div>
                    <div class="section-links">
                        <a href="/"><i class="fa-solid fa-house"></i>Feed</a>
                        <a href="/chat"><i class="fa-regular fa-message"></i>Chat</a>
                        @if(auth()->check())
                        <a href="/posts"><i class="fa-regular fa-note-sticky"></i> My Posts</a>
                        @endif

                    </div>
                </div> 

                @if(auth()->check())
                <div class="section">
                    <div class="section-head">Account</div>
                    <div class="section-links">
                        <a href="/profile"><i class="fa-regular fa-circle-user"></i> Profile</a>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="/admin"><i class="fa-solid fa-key"></i> Administration</a>
                        @endif
                        
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
                

                
                    <div class="create">

                        <div class="create-top">
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                @csrf
                            <textarea name="content" placeholder="Start typing your post...*" required></textarea>
                        </div>

                        <div class="create-bottom">
                            <div class="top">
                                <select name="category_id" required>
                                    <option value="">Select a category*</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <input type="file" name="media" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx, .pptx, .xlsx"/>                            </div>

                            <div class="middle">
                                <label>Add a Link</label>
                                <input type="text" name="link" placeholder="e.g. https://www.bahij.xyz"/>
                            </div>

                            <div class="bottom">
                                <button type="submit">Post</button>
                                <button type="button"><a href='/'>Cancel</a></button>
                            </div>
                        </div>

                       


                    </div>
                  
                </div>  
            </div>
        </div>





    </body>
</html>