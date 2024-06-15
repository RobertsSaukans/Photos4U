<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('categories.index')
                                 ->with('error', 'Unauthorized access.');
            }
            return $next($request);
        })->only(['deleteCategory']);
    }*/

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

    public function deleteCategory(Category $category)
    {
        if ($category->photos()->count() > 0) {
        return redirect()->route('categories.index')
                         ->with('error', 'Category cannot be deleted because it is associated with photos.');
    }

        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

}
