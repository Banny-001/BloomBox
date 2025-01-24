<?php

namespace App\Http\Controllers;

use App\Models\Florist;
use Illuminate\Http\Request;
use App\Misc\Functions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FloristController extends Controller
{

    public function index()
    {
        $Florists = Florist::with('location')->get();
        return response()->json($Florists);
    }
    public function create()
    {
        return view('florists.create');
    }
    public function store(Request $request)
    {
        //  Log::info('Request Data:', $request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'location_id' => 'nullable|string',
            'phone_number' => 'required|string|digits:10',
            'business_name' => 'string|required',
            'name' => 'string|required',
            'email' => 'string|required|email',
        ]);

        $florist = new Florist();
        $florist->name = $request->name;
        $florist->email = $request->email;
        $florist->phone_number = $request->phone_number;
        $florist->business_name = $request->business_name;
        $florist->location_id = $request->location_id;
        $imagePath = $request->file('image')->store('florist_image', 'public');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('florist_images', 'public');
            $florist->image = $imagePath;
        }

        $florist->save();
        return redirect('florists/create')->with('status', 'Florists Created');
    }

    public function edit(int $id)
    {
        try {
            $florist = Florist::with('location')->findOrFail($id);
            // $florist->image =url('images/' . $florist->image);
            $florist->image = asset("storage/{$florist->image}");
            return response()->json($florist, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Florist not found'], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        Log::info('Request Data:', $request->all());
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'location_id' => 'nullable|string',
            'phone_number' => 'required|string|digits:10',
            'business_name' => 'string|required',
            'name' => 'string|required',
            'email' => 'string|required|email',
        ]);

        $florist = Florist::findOrFail($id);

        // Check if the image exists and delete the old one (if any)
        if ($request->hasFile('image')) {
            // If there's an old image, delete it
            if ($florist->image && Storage::disk('public')->exists($florist->image)) {
                Storage::disk('public')->delete($florist->image);
            }

            $imagePath = $request->file('image')->store('florist_images', 'public');
            $florist->image = $imagePath;
        }

        // Update the rest of the fields
        $florist->update($validatedData);

        return redirect()->back()->with('status', 'Florist Updated');
    }
    public function destroy($id)
    {
        $florist = Florist::findorFail($id);

        if ($florist->image && file_exists(public_path("storage/{$florist->image}"))) {
            unlink(public_path("storage/{$florist->image}"));
        }

        $florist->delete();

        return redirect()->back()->with('status', 'Florist Deleted');
    }
    public function show($id)
    {
        try {
            // Find the florist by ID
            $florist = Florist::findOrFail($id);  
            // load related data
            $florist->load('location');
            return response()->json($florist, 200);  
        } catch (\Exception $e) {
            return response()->json(['error' => 'Florist not found'], 404);
        }
    }
  
}
