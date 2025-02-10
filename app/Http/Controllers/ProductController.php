<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['company', 'category', 'sizes', 'colors', 'images']);

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('color')) {
            $query->whereHas('colors', function($q) use ($request) {
                $q->where('name', $request->color);
            });
        }

        if ($request->has('size')) {
            $query->whereHas('sizes', function($q) use ($request) {
                $q->where('name', $request->size);
            });
        }

        return response()->json($query->get());
    }

    public function companyProducts($company_slug)
    {
        $company = Company::where('slug', $company_slug)->firstOrFail();
        return response()->json($company->products()->with(['category', 'sizes', 'colors', 'images'])->get());
    }

    public function show($company_slug, $product_slug)
    {
        $product = Product::whereHas('company', function($q) use ($company_slug) {
            $q->where('slug', $company_slug);
        })->where('slug', $product_slug)
          ->with(['category', 'sizes', 'colors', 'images'])
          ->firstOrFail();

        return response()->json($product);
    }
}