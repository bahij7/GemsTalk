<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GemsTalk - Administration</title>
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
                        <a href="/admin/users"><i class="fa-solid fa-users"></i>Users</a>
                        <a href="/admin/posts"><i class="fa-regular fa-note-sticky"></i>Posts</a>
                        <a href="/admin/chat"><i class="fa-regular fa-message"></i>Chats</a>
                        <a href="/admin/comments"><i class="fa-regular fa-comment"></i>Comments</a>
                        <a href="/admin/categories"><i class="fa-regular fa-comment"></i>Categories</a>
                        
                    </div>
                </div> 

                
            </div>
            <div class="tag">Ahmed Bahij © 2024</div>
        </div>

    <div class="container">
        
        <div class="main">
            <div class="main-head">

                <div class="users">
                    <p>All Users</p>
                    <h1>{{$allUsers}}</h1>
                </div>

                <div class="posts">
                    <p>All Posts</p>
                    <h1>{{$allPosts}}</h1>
                </div>
                
                <div class="chats">
                    <p>All Messages</p>
                    <h1>{{$allChats}}</h1>
                </div>

            </div>

            <div class="main-body" style="width: 90%; display: flex; flex-direction: column; gap: 20px">

                <div class="recentUsers">
                    <p>Latest Joined Users</p>
                    <table>
                        <tr><th>Name</th><th>Email</th><th>Role</th><th>Date</th></tr>
                        
                            @foreach ($users as $user)
                        <tr><td style="width: 20%">{{ $user->name }}</td><td style="width: 40%">{{ $user->email }}</td><td style="width: 20%">{{ $user->role }}</td><td>{{$user->created_at}}</td></tr>
                            @endforeach
                    </table>
                </div>

                <div class="recentChats">
                    <p>Latest Messages</p>

                    <table>
                        <tr><th>Sender</th><th>Message</th><th>Date</th></tr>
                        
                            @foreach ($chats as $chat)
                        <tr><td style="width: 20%">{{ $chat->user->name }}</td><td style="width: 60%">{{ $chat->content }}</td><td>{{$chat->chat_date}}</td></tr>
                            @endforeach
                    </table>
                </div>

                <a href="{{url('/admin/download-pdf')}}">Download Stats</a>


            </div>

        </div>

    </div>
    



</body>
</html>
