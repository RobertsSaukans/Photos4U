<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title></head>
<body>
    <h1>{{ $photo->title }}</h1>
    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}">
    
    @auth
        @if(Auth::user()->isAdmin())
            <form action="{{ route('admin.photos.delete', $photo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this photo?');">Delete Photo</button>
            </form>
        @endif
    @endauth
    
    <p>Categories:
        @foreach ($photo->categories as $category)
            {{ $category->name }},
        @endforeach
    </p>
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
</body>
</html>