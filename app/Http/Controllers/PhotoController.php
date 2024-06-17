<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('photos.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $imagePath = $request->file('image')->store('photos', 'public');

        $photo = new Photo();
        $photo->title = $request->title;
        $photo->image_path = $imagePath;
        $photo->user_id = auth()->id();
        $photo->save();

        if ($request->categories) {
            $photo->categories()->attach($request->categories);
        }

        return redirect()->route('photos.index')
                         ->with('success', 'Photo uploaded successfully.');
    }

    public function show(Photo $photo)
    {
        $photo->load('categories', 'comments.user');
        $categories = Category::all();
        return view('photos.show', compact('photo', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $photos = Photo::where('title', 'like', "%$query%")
                       ->orWhereHas('categories', function ($q) use ($query) {
                           $q->where('name', 'like', "%$query%");
                       })->get();

        return view('photos.index', compact('photos'));
    }
}
