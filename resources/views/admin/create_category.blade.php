<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos4U</title>
</head>
<body>
@include('layouts.navbar')
    <h1>Create New Category</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required><br>
        <button type="submit">Create Category</button>
    </form>
</body>
</html>