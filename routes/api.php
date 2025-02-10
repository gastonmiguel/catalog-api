<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{slug}', [CompanyController::class, 'show']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{company_slug}', [ProductController::class, 'companyProducts']);
Route::get('/products/{company_slug}/{product_slug}', [ProductController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
