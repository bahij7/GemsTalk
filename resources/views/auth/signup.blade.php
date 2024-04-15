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
    
        <form method="POST" action="{{ route('register') }}">
            <div class="login-head"><a href="/">💎 GemsTalk</a></div>
    
            @csrf
    
            <div class="login-body">

            <div>
                <label for="name">Name
                    <input id="name" type="text" name="name" :value="old('name')" placeholder="Ahmed Bahij*" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" />
                </label>
           
                <label for="date_of_birth" >Date Of Birth
                    <input id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth')"  autocomplete="username" />
                    <x-input-error :messages="$errors->get('date_of_birth')"/>
                </label>
            </div>

            <div>
                <label for="email" >Email
                    <input id="email" type="email" name="email" :value="old('email')" placeholder="ahmedbahij0@gmail.com*" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')"/>
                </label>
            </div>
    
            <div>
                <label for="email">Password
                    <input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </label>
            </div>

            <div>
                <label for="password_confirmation" >Confirm Password
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter your password for confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </label>
            </div>
    
        
    
            <div>
                <a href="{{ route('login') }}">Already have an Account?'</a>
                <button href={{ __('Register') }} type="submit">Sign up</button>
            </div>

        </div>
    
        </form>
        
    </div>

</body>
</html>