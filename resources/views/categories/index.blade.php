<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
    <title>Photos4U</title>
</head>
<body class="category-index" >
<header>@include('layouts.navbar')</header>
    <main>
    <h1 class="category-index-header" >{{ __('messages.categories') }}</h1>
    @auth
        @if(Auth::user()->isAdmin())
        <form method="GET" action="{{ route('admin.categories.create') }}">
            <button class="create-category" type="submit">{{ __('messages.create_new_category') }}</button>
        </form>
        @endif
    @endauth

    <form action="{{ route('categories.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="{{ __('messages.search_categories') }}" value="{{ request('query') }}">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">{{ __('messages.search') }}</button>
            </span>
        </div>
    </form>

    <ul>
    @forelse ($categories as $category)
        <li class="list-items" >
            <a class="category-link" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
        </li>
    @empty
        <li>{{ __('messages.no_categories_found') }}</li>
    @endforelse
    </ul>
    </main>
</body>
</html>