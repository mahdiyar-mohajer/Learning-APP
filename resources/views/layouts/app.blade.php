<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<nav class="shadow-lg mb-8" style="background-color: #91186a;">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="/assets/images/logo.svg" alt="Home Logo" class="h-auto w-32 filter invert brightness-0" />
            </a>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-600 transition duration-200">Login</a>
                    <a href="{{ route('register') }}" class="text-white hover:text-blue-600 transition duration-200">Register</a>
                @endguest
                @auth
                    <a href="{{ route('commands.index') }}" class="text-white hover:text-blue-600 transition duration-200">All Commands</a>
                    <a href="{{ route('commands.create') }}" class="text-white hover:text-blue-600 transition duration-200">Add New</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-600 transition duration-200">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mx-auto px-4" id="success-message">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    </div>
@endif

@yield('content')

<script>
    setTimeout(() => {
        const message = document.getElementById('success-message');
        if (message) {
            message.style.animation = 'fadeOut 1s forwards';
            setTimeout(() => message.remove(), 1000);
        }
    }, 5000);
</script>
</body>
</html>
