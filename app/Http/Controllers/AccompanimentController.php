<?php

namespace App\Http\Controllers;

use App\Models\Accompaniment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AccompanimentController extends Controller
{
    public function index()
    {

        $Accompaniments = Accompaniment::with('product')->get();
        return response()->json($Accompaniments);
    }

    public function create()
    {
        return view('accompaniments.create');
    }
    public function store(Request $request)

    {
        $request->validate([
            'product_id' => 'int|required|max:20',   
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'string|required|max:255',
            'price' => 'numeric|required',
            'description' => 'string|required|max:255',
        ]);
        // Handle image upload
        $Accompaniment = new Accompaniment();
        $Accompaniment->name = $request->name;
        $Accompaniment->description = $request->description;
        $Accompaniment->price = $request->price;
        $Accompaniment->product_id = $request->product_id;
        $imagePath = $request->file('image')->store('accompaniment', 'public');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accompaniment', 'public');
            $Accompaniment->image = $imagePath;
        }

        $Accompaniment->save();

        return redirect('accompaniments/create')->with('status', 'Accompaniment Created');
    }

    public function edit(int $id)
    {
        $accompaniment = Accompaniment::findorFail($id);
        // $accompaniment->image = asset("storage/{ $accompaniment->image}");
        $accompaniment->image = asset("storage/" . $accompaniment->image);
        return response()->json($accompaniment, 200);
    }

    public function update(Request $request, int $id)
    {
        $validatedData= $request->validate([
            'product_id' => 'int|required|max:20',
            // 'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
              
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'string|required|max:255',
            'price' => 'numeric|required',
            'description' => 'string|required|max:255',
        ]);
        $accompaniment=Accompaniment::findorFail($id);
        if ($request->hasFile('image')) {
                if ($accompaniment->image && Storage::disk('public')->exists($accompaniment->image)) {
                    Storage::disk('public')->delete($accompaniment->image);
                };
                $imagePath = $request->file('image')->store('accompaniment_images', 'public');
                    $validatedData['image'] = $imagePath;
            }
            $accompaniment->update($validatedData);
        // return redirect()->back()->with('status', 'Accompaniments Updated');
        return response()->json(['status' => 'Accompaniment updated successfully'], 200);

    }
    public function destroy(int $id)
    {
        $accompaniment = Accompaniment::findorFail($id);
        $accompaniment->delete();

        return redirect()->back()->with('status', 'Accompaniments Deleted');
    }
}
