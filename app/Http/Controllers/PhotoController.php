<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Category $category)
    {
        $photos = $category->photos;
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('photos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $photo = new Photo;
        $photo->user_id = auth()->id();
        $photo->title = $request->title;
        $photo->image_path = $request->image_path; // Handle file upload
        $photo->save();

        $photo->categories()->attach($request->categories);

        return redirect()->route('photos.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $photos = Photo::where('title', 'like', '%' . $search . '%')->get();
        return view('photos.index', compact('photos'));
    }
}
