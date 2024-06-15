<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
    <h1>Photos</h1>
    @auth
        <a href="{{ route('photos.create') }}" method="POST">
        Upload A Photo
        </a>
    @endauth
    <form method="GET" action="{{ route('photos.search') }}">
        <input type="text" name="query" placeholder="Search photos">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach ($photos as $photo)
            <li>
                <a href="{{ route('photos.show', $photo->id) }}">{{ $photo->title }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>