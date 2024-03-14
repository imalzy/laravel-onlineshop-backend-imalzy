<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {

        try {
            $products = Products::paginate(10);
            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error'
            ], 500);
        }
    }
}
