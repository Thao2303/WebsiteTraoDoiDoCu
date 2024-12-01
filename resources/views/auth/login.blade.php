<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSS -->
        <link rel="stylesheet" href="/resources/css/loginStyle.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js', '/resources/css/loginStyle.css', '/resources/js/loginScript.js'])
        <!-- Scripts -->
    
 
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        @vite(['/template/css/loginStyle.css', '/template/js/loginScript.js'])
            
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Đăng nhập</header>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
            
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div class="field input-field" style="margin: bottom 15px;">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        
                        </div>

                        <div class="field input-field">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                        
                        </div>

                        <div class="form-link refor">
                        <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

                        </div>

                        <div class="field button-field">

                            <button type="submit">Đăng nhập</button>
</div>

                    </form>

                    <div class="form-link">
                        <span>Chưa có tài khoản ? 
                        <a href="http://127.0.0.1:8000/register" class="link signup-link">Đăng ký</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Đăng nhập với Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="/template/images/google.png" alt="" class="google-img">
                        <span>Đăng nhập với Google</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- JavaScript -->
        <script src="/template/js/loginScript.js"></script>
    </body>
</html>