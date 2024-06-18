<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
    <title>Photos4U</title>
</head>
<body class="photo-index" >
<header>@include('layouts.navbar')</header>
    <main>    
    <h1>Photos</h1>
    @auth
        <form method="GET" action="{{ route('photos.create') }}">
            <button class="create-photo" type="submit">Upload A Photo</button>
        </form>
    @endauth
    <form method="GET" action="{{ route('photos.search') }}">
        <input type="text" name="query" placeholder="Search photos">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach ($photos as $photo)
            <li class="photo-names">
                <a class="photo-name" href="{{ route('photos.show', $photo->id) }}">{{ $photo->title }}</a>
            </li>
        @endforeach
    </ul>
</main>
</body>
</html>