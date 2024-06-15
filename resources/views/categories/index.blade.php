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
    <form action="{{ route('categories.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search categories..." value="{{ request('query') }}">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
            </span>
        </div>
    </form>

    <ul>
    @forelse ($categories as $category)
        <li>
            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
        </li>
    @empty
        <li>No categories found.</li>
    @endforelse
    </ul>
</body>
</html>