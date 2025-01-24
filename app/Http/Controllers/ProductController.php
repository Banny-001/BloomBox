<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Florist;
use App\Models\Category;
use App\Models\SpecialOccassion;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['Category', 'SpecialOccassion','Florist'])->get();
        return response()->json($products);
        //  $products = Product::all();
        //  return $products;
    }
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'numeric|required',
            'description' => 'string|required',
            'florist_id' => 'required|exists:florists,id',
            'category_id' => 'required|exists:categories,id',
            'special_occassion_id' => 'nullable|exists:special_occassions,id',
        ]);
    
        // Handle image upload
          $product = new Florist();
        $product->name = $request->name;
        $product->email = $request->email;
        $product->phone_number = $request->phone_number;
        $product->business_name = $request->business_name;
        $product->location_id = $request->location_id;
        $imagePath = $request->file('image')->store('products', 'public');
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
    
        $product->save();
      
    
        return redirect('products/create')->with('status', 'Product Created');
    }
    

    public function edit(int $id)
    {
        $product = Product::findorfail($id);
        $product->image = asset("storage/{$product->image}");
        return response()->json( $product, 200);
    }

    public function update(Request $request, int $id)
    {
        $validatedData= $request->validate([
            'name' => 'string|required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image' => 'sometimes|file|image|max:2048',
            'price' => 'numeric|required',
            'description' => 'string|required',
            'florist_id' => 'required|exists:florists,id',
            'category_id' => 'required|exists:categories,id',
            'special_occassion_id' => 'nullable|exists:special_occassions,id',
        ]);
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            // If there's an old image, delete it
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('florist_images', 'public');
            // $product->image = $imagePath;
            $validatedData['image'] = $imagePath;
        }
        $product->update($validatedData);
        dd($validatedData);

        return redirect()->back()->with('status', 'products updated');
    }
    public function destroy(int $id)
    {
        $product = Product::findorFail($id);
        if ( $product->image && file_exists(public_path("storage/{ $product->image}"))) {
            unlink(public_path("storage/{ $product->image}"));
        }
        $product->delete();


        return redirect()->back()->with('status', 'Products Deleted');
    }
    public function show($id)
    {
        try {
           
            $product = Product::findOrFail($id);  
            return response()->json($product, 200);  
        } catch (\Exception $e) {
            return response()->json(['error' => 'Florist not found'], 404);
        }
    }


}
