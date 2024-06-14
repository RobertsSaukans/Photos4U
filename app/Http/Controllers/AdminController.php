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
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index');
    }

    public function addCategoryToPhoto(Request $request, Photo $photo)
    {
        $photo->categories()->attach($request->category_id);
        return redirect()->route('photos.show', $photo);
    }

    public function deletePhoto(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
