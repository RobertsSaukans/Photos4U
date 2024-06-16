<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
@include('layouts.navbar')
    <h1>Categories</h1>
    @auth
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.categories.create') }}" method="POST" style="display:inline;">
                Create Category
            </a>
        @endif
    @endauth

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