<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('children')->get());
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        return response()->json($category);
    }
}
