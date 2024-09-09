<?php

namespace App\Http\Controllers;

use App\Models\Florist;
use Illuminate\Http\Request;

class FloristController extends Controller
{
    public function index()
    {
        $Florists = Florist::all();
        return response()->json($Florists);
    }
    public function indexView()
    {
        $florists = Florist::all();
        return view('florists.index', compact('florists'));
    }

    public function create()
    {
        return view('florists.create');
    }
    public function store(Request $request)
    {
     
        $request->validate([
            'user_id' => 'int|required|max:20',
            'image' => 'string|required|max:255',
            'location' => 'string|required|max:255',
            'phone_number'=>'string|required|max:10',
            'business_name'=>'string|required|max:255'
        ]);

        Florist::create([
            'image' => $request->image,
            'user_id' => $request->user_id,
            'location' => $request->location,
            'phone_number'=>$request->phone_number,
            'business_name'=>$request->business_name
        ]);
        return redirect('florists/create')->with('status', 'Florists Created');
    }

    public function edit(int $id)
    {
        $florist = Florist::findorFail($id);
        return view('florists.edit', compact('florist'));
    }
    public function update(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'int|required|max:20',
            'image' => 'string|required|max:255',
            'location' => 'string|required|max:255',
            'phone_number'=>'string|required|max:10',
            'business_name'=>'string|required|max:255'
        ]);
        Florist::findorFail($id)->update([
            'image' => $request->image,
            'user_id' => $request->user_id,
            'location' => $request->location,
            'phone_number'=>$request->phone_number,
            'business_name'=>$request->business_name
        ]);
        return redirect()->back()->with('status', 'Florists Updated');
    }
    public function destroy(int $id)
    {
        $florist = Florist::findorFail($id);
        $florist->delete();

        return redirect()->back()->with('status', 'Florist Deleted');
    }
}
