<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$post->user->name}}'s Post - GemsTalk</title>
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
                <div class="main-body" style="width: 90%; margin: 0 auto;">
                <div class="post">
                    <div class="post-head">

                        <div class="post-info">
                            <span>{{ $post->user->name }}</span>
                            <span>
                                @if(auth()->check() && $post->user_id == auth()->id())
                                <button><i class="fa-regular fa-pen-to-square"></i> Edit Post</button>
                                @if(!$post->is_deleted)
                                <form action="{{ route('post.delete', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash"></i> Delete Post</button>
                                  </form>
                                  @endif
                                @endif
                                {{ $post->category->name }}
                            </span>
                        </div>

                        <div class="post-time">
                            {{ $post->created_at->format('j M Y, H:i') }}
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
                   
                    </div>

                </div>

                <div class="post-comments">

                    @if(session()->has('success'))
                            <div class="popup success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                    @if(Auth()->check())
                    <div class="post-comment-field">
                        <form action="{{ route('comments.store', ['post_id' => $post->id]) }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Add a Comment" name="content"/>
                            <input type="submit" value="Send" />
                        </form>
                    </div>
                    @endif
                    @if($post->comments)
                    
                    @foreach ($post->comments->reverse() as $comment)
                    <div class="post-comment">
            
                        {{-- <div class="comment-top"><b>Ahmed BAHIJ</b> WA3R ASAHBI KEEP PUSHING</div>
                        <div class="comment-bottom" style="font-size: 10px; color: #f5f5f5b8">
                            2024-04-19 08:46:55
                        </div> --}}
                        <div class="comment-top"><b>{{$comment->user->name}}</b> {{$comment->content}}</div>
                        <div class="comment-bottom" style="font-size: 10px; color: #f5f5f5b8">{{$comment->comment_date}}</div>
                    </div>
                    @endforeach

                    
                @else <p>No Comments Yet</p>
                @endif
                </div>
            </div>
        </div>
        </div>



    </body>
</html>