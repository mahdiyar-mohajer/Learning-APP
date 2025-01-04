<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<nav>
    <!-- Add admin navigation -->
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('commands.index') }}">Courses</a>
{{--    <a href="{{ route('users.index') }}">Users</a>--}}
    <a href="{{ route('logout') }}">Logout</a>
</nav>
<main>
    @yield('content')
</main>
</body>
</html>
