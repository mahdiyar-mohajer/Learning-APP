<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @vite('resources/css/app.css')

    <style>
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navbar -->
<nav class="shadow-lg mb-8" style="background-color: #91186a;">
    <div class="container mx-auto px-4 flex justify-between items-center py-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="/assets/images/logo.svg" alt="Admin Logo" class="h-auto w-10 mr-2 filter invert brightness-0">
            <span class="text-white text-lg font-semibold">Admin Panel</span>
        </a>

        <!-- Mobile Menu Toggle -->
        <button id="hamburger" class="text-white md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Desktop Links -->
        <div id="nav-links" class="hidden md:flex items-center gap-6">
            <!-- Admin Links -->
{{--            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a>--}}
            <a href="{{ route('admin.users') }}" class="text-white hover:text-gray-300">Manage Users</a>
{{--            <a href="{{ route('admin.commands') }}" class="text-white hover:text-gray-300">Manage Commands</a>--}}
            <a href="{{ route('home') }}" class="text-white hover:text-gray-300">Go to Site</a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white hover:text-gray-300">Logout</button>
            </form>
        </div>
    </div>

    <!-- Mobile Links -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#91186a]">
        <div class="flex flex-col items-start space-y-4 py-4 px-4 text-white">
{{--            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>--}}
            <a href="{{ route('admin.users') }}" class="hover:text-gray-300">Manage Users</a>
{{--            <a href="{{ route('admin.commands') }}" class="hover:text-gray-300">Manage Commands</a>--}}
            <a href="{{ route('home') }}" class="hover:text-gray-300">Go to Site</a>

            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full text-left hover:text-gray-300">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
@if(session('success'))
    <div class="container mx-auto px-4" id="success-message">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    </div>
@endif

<!-- Main Content -->
<main class="container mx-auto px-4">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-[#91186a] py-4 text-center text-white">
    &copy; {{ date('Y') }} Admin Panel. All Rights Reserved.
</footer>

<script>
    // Hide success messages after 5 seconds
    setTimeout(() => {
        const message = document.getElementById('success-message');
        if (message) {
            message.style.animation = 'fadeOut 1s forwards';
            setTimeout(() => message.remove(), 1000);
        }
    }, 5000);

    // Toggle Mobile Menu
    document.getElementById('hamburger').addEventListener('click', function () {
        let menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
