<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'popular', 'specialOccasion'])->get();
        return response()->json($products);
        //  $products = Product::all();
        //  return $products;
    }
    public function indexView()
    {
        $products = Product::with(['category', 'popular', 'specialOccasion'])->get();
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
            'name' => 'string|required',
            'image' => 'string|required',
            // 'price' => 'double|required|max:255',
            'price' => 'numeric|required',
            'description' => 'string|required',
            'florist_id' => 'bigint|required',
            'popular_id' => 'nullable|exists:popular,id',
            'category_id' => 'required|exists:categories,id',
            'special_occassion_id' => 'nullable|exists:special_occassions,id',
        ]);




        //create product

        Product::create([

            'name' => $request->name,
            'image' => $request->image,
            "price" => $request->price,
            "description" => $request->description,
            "florist_id" => $request->florist_id,
            'popular_id' => $request->popular_id,
            'category_id' => $request->category_id,
            'special_occassion_id' => $request->special_occassion_id,
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
            'name' => 'string|required',
            'image' => 'string|required',
            'price' => 'double|required',
            'description' => 'string|required',
            'florist_id' => 'bigint|required',


        ]);

        Product::findorfail($id)->update([
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
    //query popular products
    public function popular()
    {
        $popular = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        return response()->json($popular);
    }
    //query pruducts by occassions
   
}
