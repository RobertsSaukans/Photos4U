<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function storeCategoryToPhoto(Request $request, $photo_id)
    {
        $photo = Photo::findOrFail($photo_id);
        $categories = $request->input('categories', []);

        $photo->categories()->syncWithoutDetaching($categories);
        return redirect()->route('photos.show', $photo_id)->with('success', 'Categories added to the photo successfully.');
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

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

}
