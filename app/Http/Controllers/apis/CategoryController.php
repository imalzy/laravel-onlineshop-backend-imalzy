<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        try {
            $categories = Category::all();
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }
}
