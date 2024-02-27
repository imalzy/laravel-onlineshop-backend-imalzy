<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // index
    public function index()
    {
        $products = Products::paginate(10);
        return view('pages.products.index', compact('products'));
    }

    // create
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('pages.products.create', compact('categories'));
    }

    // store
    public function store(Request $request)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favourite' => 'required|boolean',

        ]);

        // store the request...
        $product = new Products;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->is_favourite = $request->is_favourite;

        $product->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // show
    public function show($id)
    {
        return view('pages.products.index');
    }

    // edit
    public function edit($id)
    {
        $products = Products::findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('pages.products.edit', compact('products', 'categories'));
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request...
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'category_id' => 'required',
        //     'stock' => 'required',
        //     'status' => 'required',
        //     'is_favourite' => 'required',
        // ]);

        // update the request...
        $product = Products::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);;
        $product->category_id = $request->category_id;
        $product->stock = (int) $request->stock;
        $product->status = $request->status == 'on' ? true : false;
        $product->is_favourite = $request->is_favourite == 'on' ? true : false;
        // dd($product);

        $product->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        // delete the request...
        $product = Products::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
