<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Discover GemsTalk: Your Platform for Sparkling Conversations</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        
<div class="form-container">
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        <div class="login-head"><a href="/">💎 GemsTalk</a></div>

        @csrf

        <div class="login-body">

        <div>
            <label for="email"  style="width: 100%;">Email Address
                <input id="email" type="email" name="email" :value="old('email')" placeholder="ahmedbahij0@gmail.com" required autofocus autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')"/>
            </label>
        </div>

        <div>
            <label for="email">Password
                <input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password"/>
                <x-input-error :messages="$errors->get('password')"/>
            </label>
        </div>

        <div>
            <label for="remember_me" style="flex-direction: row-reverse; align-items: start; justify-content: start;">Remember me
                <input id="remember_me" type="checkbox" name="remember">
            </label>
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot your password?'</a>
            @endif
            <button href={{ __('Log in') }} type="submit">Log in</button>
        </div>

    </div>

    </form>
    
</div>

</body>
</html>
