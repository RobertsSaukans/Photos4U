<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
    <h1>Search Results</h1>
    <form method="GET" action="{{ route('categories.search') }}">
        <input type="text" name="query" placeholder="Search categories">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
    <a href="{{ route('categories.index') }}">Back to Categories</a>
</body>
</html>