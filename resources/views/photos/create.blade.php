<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
@include('layouts.navbar')
    <h1>Add New Photo</h1>
    <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="image">Photo:</label>
        <input type="file" name="image" id="image" required><br>
        <button type="submit">Upload Photo</button>
    </form>
</body>
</html>