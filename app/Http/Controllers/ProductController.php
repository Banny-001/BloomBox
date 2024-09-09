<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illumminate\Database\QueryException;

class ProductController extends Controller
{
    public function index()
    {
        $Products = Product::all();
        return response()->json($Products);
        //  $products = Product::all();
        //  return $products;
    }
    public function indexView()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
  
    {
        //validate
        $request->validate([
            'name' => 'string|required|max:255',
            'image' => 'string|required|max:255',
            'price' => 'double|required|max:255',
            'description' => 'string|required|max:255',
            'florist_id' => 'bigint|required|max:20',
        ]);




        //create product

        Product::create([

            'name' => $request->name,
            'image' => $request->image,
            "price" => $request->price,
            "description" => $request->description,
            "florist_id" => $request->florist_id,
        ]);

        return redirect('products/create')->with('status', 'Products Created');
    }

    public function edit(int $id)
    {
        $product = Product::findorfail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string|required|max:255',
            'image' => 'string|required|max:255',
            'price' => 'double|required|max:255',
            'description' => 'string|required|max:255',
            'florist_id' => 'bigint|required|max:20',


        ]);

        Product::findorfail($id)->updated([
            'name' => $request->name,
            'image' => $request->image,
            "price" => $request->price,
            "description" => $request->description,
            "florist_id" => $request->florist_id,

        ]);
        return redirect()->back()->with('status', 'products updated');
    }
    public function destroy(int $id)
    {
        $product = Product::findorFail($id);
        $product->delete();

        return redirect()->back()->with('status', 'Products Deleted');
    }
}
