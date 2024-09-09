<?php

namespace App\Http\Controllers;
use Ap\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Facade;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try{
             $google_user=Socialite::driver('google')->user();
             $user=User::where('google_id',$google_user ->getId())->first();

             if(!$user){
                $new_user=User::create([
                  'name'=>$google_user->getName(),
                  'email'=>$google_user->getEmail(),
                  'google_id'=>$google_user->getId(),
                ]);
                FacadesAuth::login($new_user);
                return redirect()->intended('http://localhost:5173/');
             }
             else{
                FacadesAuth::login($user);
                return redirect()->intended('http://localhost:5173/');
             }
        }catch (\Throwable $th){
         dd('Something went wrong!' .$th->getMessage());
        }
    }
}
