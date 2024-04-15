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
            <a href="/"><i class="fa-solid fa-house"></i>Feed</a>
            <a href="/topics"><i class="fa-regular fa-star"></i>Topic-Specific</a>
            <a href="/chat"><i class="fa-regular fa-message"></i>Off-Topic</a>
        </div>
    </div> 

    @if(auth()->check())
    <div class="section">
        <div class="section-head">Account</div>
        <div class="section-links">
            <a href="/profile"><i class="fa-regular fa-circle-user"></i> Profile</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="/admin/dashboard"><i class="fa-solid fa-key"></i> Administration</a>
            @endif

            <a href="/posts"><i class="fa-regular fa-note-sticky"></i> My Posts</a>
            
       <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        </div>
    </div>
@endif
    
</div>
<div class="tag">Ahmed Bahij © 2024</div>