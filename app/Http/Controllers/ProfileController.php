<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

use Inertia\Response;

class ProfileController extends Controller
{
    public function fetchProfile()
    {
        $user = Auth::user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            // 'phone' => $user->phone,
            'profile_image' => $user->profile_image, 
        ]);
     
    }

    // public function updatePhone(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required|string|max:15',
    //     ]);

    //     $user = Auth::user();
    //     $user->phone = $request->phone;
    //     $user->save();

    //     return response()->json(['message' => 'Phone number updated successfully.']);
    // }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = $request->file('profile_image')->store('profile_images', 'public');
        $user = Auth::user();
        $user->profile_image = asset('storage/'. $filePath);
        $user->save();
        Log::info('Profile image updated successfully:', [
            'user_id' => $user->id,
            'image_path' => $user->profile_image,
        ]);
        return response()->json(['message' => 'Profile image updated successfully.']);
        Log::info(response());
    }
   
 
}
