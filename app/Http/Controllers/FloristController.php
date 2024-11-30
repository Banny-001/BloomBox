<?php

namespace App\Http\Controllers;

use App\Models\Florist;
use Illuminate\Http\Request;
use App\Misc\Functions;

class FloristController extends Controller
{

    public function index()
    {
        $Florists = Florist::all();
        return response()->json($Florists);
    }


    public function create()
    {
        return view('florists.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            // 'user_id' => 'int|required|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'string|required',
            'phone_number' => 'string|required|max:10',
            'business_name' => 'string|required',
            'name' => 'string|required',
            'email' => 'string|required'
        ]);
        $imagePath = $request->file('image')->store('florist_image', 'public');

        Florist::create([
            'image' => $imagePath,
            // 'user_id' => $request->user_id,
            'location' => $request->location,
            'phone_number' => $request->phone_number,
            'business_name' => $request->business_name,
            'name' => $request->name,
            "email" => $request->email,
            // 'user_id' => auth()->id(),
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
            // 'user_id' => 'int|required|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'string|required',
            'phone_number' => 'string|required|max:10',
            'business_name' => 'string|required',
            'name' => 'string|required',
            'email' => 'string|required'
        ]);
        $florist = Florist::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('florist_image', 'public');
            $florist->image = $imagePath;
        }
        $florist->update([
            'location' => $request->location,
            'phone_number' => $request->phone_number,
            'business_name' => $request->business_name,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('status', 'Florists Updated');
    }
    public function destroy( $id)
    {
        $florist = Florist::findorFail($id);

        if ($florist->image && file_exists(public_path("storage/{$florist->image}"))) {
            unlink(public_path("storage/{$florist->image}"));
        }

        $florist->delete();

        return redirect()->back()->with('status', 'Florist Deleted');
    }
}
