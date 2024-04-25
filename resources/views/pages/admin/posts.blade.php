<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts - GemsTalk</title>
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
           
            @if ($posts->isEmpty())
                <p>No Posts.</p>
            @else

            <p style="font-size: 12px">TOTAL POSTS ({{$posts->count()}})</p>

                    <table>
                        <tr><th>Creator</th><th>Content</th><th>Category</th><th>Media</th><th>Link</th><th>is Deleted?</th><th>Published at</th><th>Actions</th></tr>
                        {{-- <tr><td style="width: 15%">AHmed BAHIJ</td><td style="width: 20%">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto quia dolorem accusamus ea aliquid sunt ad, doloremque temporibus repudiandae est reiciendis hic consequatur excepturi debitis alias voluptate perspiciatis, veritatis enim.</td><td style="width: 10%">Catg</td><td style="width: 10%">Media</td><td style="width: 10%">Link</td><td style="width: 10%">deleted</td><td>2024-04-16 09:31:45	</td><td><button>Delete</button></td></tr> --}}
                           
                        
                            @foreach ($posts->reverse() as $post)
                        <tr>
                            <td style="width: 15%">{{$post->user->name}}</td>
                            <td style="width: 20%">{{ $post->content }}</td>
                            <td style="width: 10%">{{ $post->category->name }}</td>
                            <td style="width: 10%">@if($post->media)<i style="color: #00753b" class="fa-solid fa-check"></i> @else <i style="color: #c61025" class="fa-solid fa-xmark"></i> @endif</td>
                            <td style="width: 10%">@if($post->link) <i style="color: #00753b" class="fa-solid fa-check"></i> @else <i style="color: #c61025" class="fa-solid fa-xmark"></i> @endif</td>
                            <td style="width: 10%">@if($post->is_deleted) <i style="color: #00753b" class="fa-solid fa-check"></i> @else <i style="color: #c61025" class="fa-solid fa-xmark"></i> @endif</td>
                            <td>{{$post->created_at}}</td>
                            <td>
                                <form method="POST" action="{{ route('adminpost.delete', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                            @endforeach
                    </table>
                @endif
                </div>

            </div>

        </div>
        



    </body>
</html>