<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title></head>
<body>
    <h1>{{ $photo->title }}</h1>
    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}">
    <p>Categories:
        @foreach ($photo->categories as $category)
            {{ $category->name }},
        @endforeach
    </p>
    <h2>Comments</h2>
    <ul>
        @foreach ($photo->comments as $comment)
            <li>{{ $comment->user->name }}: {{ $comment->content }}</li>
        @endforeach
    </ul>
    @auth
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="photo_id" value="{{ $photo->id }}">
            <textarea name="content" placeholder="Add a comment" required></textarea><br>
            <button type="submit">Post Comment</button>
        </form>
    @endauth
</body>
</html>