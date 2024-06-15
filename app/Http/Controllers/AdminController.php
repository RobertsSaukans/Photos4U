<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createCategory()
    {
        return view('admin.create_category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully.');
    }

    public function addCategoryToPhoto()
    {
        $photos = Photo::all();
        $categories = Category::all();
        return view('admin.add_category_to_photo', compact('photos', 'categories'));
    }

    public function storeCategoryToPhoto(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $photo = Photo::findOrFail($request->photo_id);
        $photo->categories()->attach($request->category_id);

        return redirect()->route('photos.index')
                         ->with('success', 'Category added to photo successfully.');
    }

    public function deletePhoto(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index')
                         ->with('success', 'Photo deleted successfully.');
    }
}
