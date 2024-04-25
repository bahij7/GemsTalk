<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Post - GemsTalk</title>
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
                <div class="main-head"> 
                </div>
                
                <div class="main-body">
                    <div class="create">
                        <div class="create-head">
                            {{ auth()->user()->name }}
                        </div>
                        <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
                            @csrf
                        <div class="create-body">
                            <textarea name="content" placeholder="Start typing your post...*" required>{{$post->content}}</textarea>
                            
                            <select name="category_id">
                                <option value="">Select a category*</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            
                            <label>Add a Link</label>
                            <input type="text" name="link" placeholder="e.g. https://www.bahij.xyz" value="{{$post->link}}"/>
                            <input type="file" name="media" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx, .pptx, .xlsx"/>

                            @if ($post->media)
                            <p>Previous Image :</p>
                                <div class="post-media">
                                    <img src="{{ asset($post->media) }}">
                                </div>
                            @endif
                            
                        </div>

                        <div class="create-foot">
                            <button type="button"><a href='/posts'>Cancel</a></button>
                            <button type="submit">Saves Changes</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>

        </div>
        



    </body>
</html>