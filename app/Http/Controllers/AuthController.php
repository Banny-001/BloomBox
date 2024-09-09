<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => 'required|confirmed|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'api_token'=> Str::radom(60),
        ]);
        // auth()->login($user);
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
        // $token = $user->createToken(name: 'main')->plainTextToken;

        // return response([
        //     'user' => $user,
        //     'token' => $token,
        // ]);
    }
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

         // Attempt to log the user in
         if (Auth::attempt($credentials)) {
            // Authentication was successful, generate a token
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);
        }
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);

        //validate user
    //     $user = $request->validate([
    //         'email' => 'required|email|string|exists:users,email',
    //         'password' => [
    //             'required',
    //         ],
    //         'remember' => 'boolean'
    //     ]);

    //     if (is_null($request->email) || is_null($request->password)) {
    //         return response()->json(['status' => 500, 'message' => 'Incomplete fields!']);
    //     } else {
    //         $checkuser = User::whereEmail($request->email)->first();

    //         if (is_null($checkuser)) {
    //             return response()->json(['status' => 500, 'message' => 'User not found']);
    //         } else {
    //             if (password_verify($request->password, $checkuser->password)) {
    //                 return response()->json(['status' => 200, 'message' => 'Logged In Successfully!']);
    //             } else {
    //                 return response()->json(['status' => 500, 'message' => 'Invalid password']);
    //             }
    //         }
    //     }
    //     $remember = $credentials['remember'] ?? false;
    //     unset($credentials['remember']);

    //     if (!Auth::attempt($credentials, $remember)) {
    //         //if attemps returns false
    //         return response(
    //             [
    //                 'error' => 'The provided credentials are not correct'
    //             ],
    //             status: 422
    //         );
    //     }
    //     //authorized user
    //     $user = Auth::user();
    //     $token = $user->createToken(name: 'main')->plainTextToken;

    //     return response([
    //         'user' => $user,
    //         'token' => $token,
    //     ]);
    // }
}

}
