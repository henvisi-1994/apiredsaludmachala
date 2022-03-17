<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            $user = User::where('email', $request['email'])->firstOrFail();
            $token  = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->name,
                'email' => $user->email,
                'identificacion' => $user->identificacion,
                'telefono' => $user->telefono,
                'direccion' => $user->direccion,
                'clave' => $user->password,
                'id' => $user->id
            ]);
        } else {
            return response()->json([
                'messaje' => 'Credenciales Incorrectas'
            ], 401);
        }
    }
    public function infouser(Request $request)
    {
        return $request->user();
    }
    public function cambiarContrasena(Request $request,$id)
    {
        $usuario = User::where('id', $id)->first();
        if (Hash::check($request->password_old, $usuario->password)) {
            $usuario->password = Hash::make($request->input('password_new'));
            DB::table('users')
            ->where('id', $id)
            ->update(
                ['password' => $usuario->password]
            );
            return response()->json(['Mensaje' => 'Contrasena actualizada con exito'], 200);
        }
        else{
            return response()->json([
                'messaje' => 'Contraseñas Incorrectas'
            ], 401);
        }
    }
}
