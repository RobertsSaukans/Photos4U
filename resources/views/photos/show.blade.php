<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
<header>@include('layouts.navbar')</header>
    <main>    
    <h1>{{ $photo->title }}</h1>
    <img class="image" src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" style="width: 800px;">
    @auth
        @if(Auth::user()->isAdmin())
            <form action="{{ route('admin.photos.delete', $photo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this photo?');">Delete Photo</button>
            </form>
        @endif
    @endauth
    
    <h3>Categories:</h3>
    <ul>
        @foreach ($photo->categories as $category)
            <li class="photo-category-list" >
            <a class="photo-category" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <form action="{{ route('admin.photos.removeCategory', [$photo->id, $category->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

    @auth
    @if(Auth::user()->is_admin)
    <h3>Add Categories</h3>
    <form action="{{ route('admin.storeCategoryToPhoto', $photo->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="categories">Select Categories:</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Categories</button>
    </form>
    @endif
    @endauth


    <h2>Comments</h2>
    <ul>
        @foreach($photo->comments as $comment)
            <div class="comment">
            <p class="comment-body">{{ $comment->body }}</p>
            <small>Posted by {{ $comment->user->name }} on {{ $comment->created_at }}</small>
        
            @if(Auth::user() && Auth::user()->isAdmin())
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Comment</button>
                </form>
            @endif
            </div>
        @endforeach
    </ul>
    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="photo_id" value="{{ $photo->id }}">
            <div class="form-group">
                <label for="body">Comment:</label>
                <textarea name="body" id="body" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    @endauth
</main>
</body>
</html>