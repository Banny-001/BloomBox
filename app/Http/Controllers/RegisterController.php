<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class RegisterController extends Controller
{
    public function store (Request $request)
    {
        $input=$request->all();
        User ::create([
          'name'=>$input['name'],
          'email'=>$input['email'],
          'password'=> Hash::make($input['password'])
          
        ]);
        return response ()->json(['status'=>true,
        'message'=>"Registration Success"
    ]);
    return response ()->json (['status'=>true,
      'message'=>"Registration Success"
    ]);
    }
}
