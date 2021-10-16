<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials =$request->only('email','password');

        if(Auth::attempt($credentials)){
           // $request->session()->regenerate();
            $user = User::where('email',$request['email'])->firstOrFail();
            $token  = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type'=> 'Bearer'
            ]);

        }
        else{
            return response()->json([
                'messaje' => 'Invalid login details'
            ],401);

        }

    }
    public function infouser(Request $request){
        return $request->user();

    }
}
