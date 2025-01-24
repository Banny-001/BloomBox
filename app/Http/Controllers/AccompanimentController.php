<?php

namespace App\Http\Controllers;

use App\Models\Accompaniment;
use Illuminate\Http\Request;

class AccompanimentController extends Controller
{
    public function index()
    {   
        
        // $Accompaniments = Accompaniment::all();
        $Accompaniments= Accompaniment::with('product')->get();
        return response()->json($Accompaniments);
    }
    

    public function create()
    {
        return view('accompaniments.create');
    }
    public function store(Request $request)

    {
        $request->validate([
            // 'product_id' => 'int|required|max:20',
            'image' => 'string|required|max:255',
            'name'=>'string|required|max:255',
            'price'=>'double|required|max:255',
            'description'=>'string|required|max:255',
        ]);
        Accompaniment::create([
            'image' => $request->image,
            // 'product_id' => $request->product_id,
            'price'=>$request->price,
            'name'=>$request->name,
            'description'=>$request->description
        ]);


        return redirect('accompaniments/create')->with('status', 'Accompaniments Created');
    }

    public function edit(int $id)
    {
        $accompaniment = Accompaniment::findorFail($id);
        return view('accompaniments.edit', compact('accompaniment'));
    }

    public function update(Request $request,int $id )
    {
        $request->validate([
             'product_id' => 'int|required|max:20',
            'image' => 'string|required|max:255',
            'name'=>'string|required|max:255',
            'price'=>'double|required|max:255',
            'descrition'=>'string|required|max:255'
        ]);
        Accompaniment::findorFail($id)->update([
            'image' => $request->image,
             'product_id' => $request->product_id,
            'price'=>$request->price,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->back()->with('status', 'Accompaniments Updated');
    }
    public function destroy(int $id)
    {
        $accompaniment = Accompaniment::findorFail($id);
        $accompaniment->delete();

        return redirect()->back()->with('status', 'Accompaniments Deleted');
    }
}
