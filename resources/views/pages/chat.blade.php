<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Discover GemsTalk: Off-Topic</title>
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
                
                @auth
                <div class="chats">
                    
                    <div class="chat-disclaimer">
                        <p>Respect Rules: Be Kind, Chat Mindfully!</p>
                    </div>
                    
                    @foreach($chats->reverse() as $chat)
                    <div class="chat {{ $chat->user_id === auth()->id() ? 'self-chat' : '' }}">
                        <div class="chat-head" style="display: {{ auth()->check() && $chat->user_id == auth()->id() ? 'none' : '' }}"
                            >{{ $chat->user->name }}</div>
                        <div class="chat-body">{{ $chat->content }}</div>
                        <div class="chat-foot">
                            <div>{{ $chat->created_at->format('d M Y, h:iA') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="message">
                    <form  method="POST" action="{{ route('chat.store') }}">
                        @csrf
                        <input type="text" name='content' placeholder="Type a Message" required/>
                        <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div>

                @else
                <div class="disclaimer">Login to interact with our community</div>
                @endauth 
            </div>
            
        </div>



    </body>
</html>