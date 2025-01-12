<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Florist;
use App\Models\Category;
use App\Models\SpecialOccassion;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'specialOccasion','florist'])->get();
        return response()->json($products);
        //  $products = Product::all();
        //  return $products;
    }
    // public function fetchRelationships()
    // {
    //     $florists = Florist::select('id', 'name')->get();
    //     $categories = Category::select('id', 'name')->get();
    //     $specialOccasions =  SpecialOccassion::select('id', 'name')->get();

    //     return response()->json([
    //         'florists' => $florists,
    //         'categories' => $categories,
    //         'specialOccasions' => $specialOccasions,
    //     ]);
    // }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)

    {
        //validate
        $request->validate([
            'name' => 'string|required',
            // 'image' => 'string|required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'price' => 'double|required|max:255',
            'price' => 'numeric|required',
            'description' => 'string|required',
            'florist_id' => 'required',
            'popular' => 'nullable|boolean',
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
            'popular' => $request->popular,
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
            // 'image' => 'string|required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'price' => 'double|required|max:255',
            'price' => 'numeric|required',
            'description' => 'string|required',
            'florist_id' => 'bigint|required',
            'popular' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'special_occassion_id' => 'nullable|exists:special_occassions,id',
        ]);

        Product::findorfail($id)->update([
            'name' => $request->name,
            'image' => $request->image,
            "price" => $request->price,
            "description" => $request->description,
            "florist_id" => $request->florist_id,
            "popular" => $request->popular,
            "category_id" => $request->category_id,
            "special_occassion_id" => $request->special_occassion_id

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
    // public function popular()
    // {
    //     $popular = Product::withCount('orders')
    //         ->orderBy('orders_count', 'desc')
    //         ->take(10)
    //         ->get();

    //     return response()->json($popular);
    // }
    //query pruducts by occassions

}
