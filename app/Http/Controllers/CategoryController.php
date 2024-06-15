<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::where('name', 'like', '%' . $search . '%')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
    $category->load('photos');
    return view('categories.show', compact('category'));
    }
}
