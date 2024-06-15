<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
    <h1>Categories</h1>
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
        @auth
        <a href="{{ url('/dashboard') }}">Dashboard</a>
    @else
        <a href="{{ route('login') }}">Log in</a>

    @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
    @endif
        @endauth
        </nav>
    @endif
    <form method="GET" action="{{ route('categories.search') }}">
        <input type="text" name="query" placeholder="Search categories">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</body>
</html>