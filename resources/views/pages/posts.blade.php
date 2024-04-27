<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MyPosts - GemsTalk</title>
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

                    @if (auth()->check())
                    <a href="/posts/create"><i class="fa-regular fa-square-plus"></i> New Post</a>
                    @endif

                </div>
                <div class="main-body" style="width: 90%; margin: 0 auto;">
                    @if ($posts->isEmpty())
                        <p>No posts found.</p>
                    @else

                    <div class="main-body" style="margin-top: 0%;">
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
                    <p style="font-size: 12px">TOTAL POSTS ({{$posts->count()}})</p>
                    
                    
                @foreach($posts->reverse() as $post)
                
                    

                    
                        <div class="post" style="margin-bottom: 2%;">
                            <div class="post-head">
                                <div class="post-info">
                                    <span>{{ $post->user->name }}</span>
                                    <span>
                                       
                                        <form action="{{ route('posts.delete', $post->slug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete?')" style="text-decoration: underline"><i class="fa-solid fa-trash"></i> Delete Post</button>
                                        </form>
                                        
                                        <a href="{{ route('posts.edit', ['slug' => $post->slug]) }}" style="color: #f5f5f5b8"><i class="fa-regular fa-pen-to-square"></i> Edit Post</a>                                        {{ $post->category->name }}
                                    </span>
                                </div>

                                <div class="post-time">
                                    {{ $post->updated_at->format('j M Y, H:i') }}
                                </div>

                            </div>
                                

                            <div class="post-body">
                                {{ $post->content }}
                            </div>

                            @if ($post->link)
                            <div class="post-link">
                                <a href="{{$post->link}}" target="_blank">{{$post->link}}</a>
                            </div>
                            @endif

                            @if ($post->media)
                            <div class="post-media">
                                <img src="{{ asset($post->media) }}">
                            </div>
                            @endif
                                
                            <div class="post-foot">
                                <a href="{{ route('posts.show', ['slug' => $post->slug]) }}"><i class="fa-solid fa-comment"></i> Comments ({{ $post->comments()->count() }})</a>
                            </div>

                        </div>
                        
                        
                        @endforeach
                        @endif
                </div>
            </div>



    </body>
</html>