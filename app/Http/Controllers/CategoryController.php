<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $categories = Category::where('name', 'LIKE', '%' . $query . '%')->orderBy('name')->get();
        } else {
            $categories = Category::all();
        }
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('photos');
        return view('categories.show', compact('category'));
    }
}
