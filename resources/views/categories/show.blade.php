<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} - Photos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@include('layouts.navbar')
    <div class="container">
        <h1>{{ $category->name }}</h1>
        @auth
            @if(Auth::user()->isAdmin())
                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete Category</button>
                </form>
            @endif
        @endauth
        <ul class="list-unstyled">
        @forelse($category->photos as $photo)
            <li class="mb-3">
                <a href="{{ route('photos.show', $photo->id) }}">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" style="width: 200px;">
                </a>
            </li>
        @empty
            <li>No photos in this category.</li>
        @endforelse
        </ul>
    </div>
</body>
</html>