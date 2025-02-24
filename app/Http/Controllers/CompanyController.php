<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::all());
    }

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        return response()->json($company);
    }
}