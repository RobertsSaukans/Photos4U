<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
@include('layouts.navbar')
    <h1>Add Category to Photo</h1>
    <form method="POST" action="{{ route('admin.photos.add_category') }}">
        @csrf
        <label for="photo">Photo:</label>
        <select name="photo_id" id="photo" required>
            @foreach ($photos as $photo)
                <option value="{{ $photo->id }}">{{ $photo->title }}</option>
            @endforeach
        </select><br>
        <label for="category">Category:</label>
        <select name="category_id" id="category" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>
        <button type="submit">Add Category to Photo</button>
    </form>
</body>
</html>