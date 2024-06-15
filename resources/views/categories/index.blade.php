<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
    <h1>Categories</h1>

    @auth
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.categories.create') }}" method="POST" style="display:inline;">
                Create Category
            </a>
        @endif
    @endauth

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
        @foreach($categories as $category)
            <li>
                <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
            </li>
        @endforeach
        </ul>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>
</html>