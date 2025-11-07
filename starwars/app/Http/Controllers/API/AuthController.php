<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:admin,gestor,usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => bcrypt($request->password)
        ]);


        $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;

        return response()->json([
            "success" => true,
            "data" => [
                'id' => $user->id,
                'name' => $user->name,
                'rol' => $user->rol,
                'token' => $token
            ],
            "message" => "Usuario registrado correctamente"
        ]);
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;

            return response()->json([
                "success" => true,
                "data" => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'rol' => $user->rol,
                    'token' => $token
                ],
                "message" => "Usuario autenticado correctamente"
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "Credenciales incorrectas"
        ], 401);
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                "success" => true,
                "message" => "Sesión cerrada correctamente"
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "No autenticado"
        ], 401);
    }
}



