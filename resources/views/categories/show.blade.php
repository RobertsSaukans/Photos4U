<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} - Photos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $category->name }}</h1>
        <h2>Photos</h2>
        <ul>
            @forelse($category->photos as $photo)
                <li>{{ $photo->title }}</li>
            @empty
                <li>No photos in this category.</li>
            @endforelse
        </ul>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        @auth
            @if(Auth::user()->isAdmin())
                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete Category</button>
                </form>
            @endif
        @endauth
    </div>
</body>
</html>