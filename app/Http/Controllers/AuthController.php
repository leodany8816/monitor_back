<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales, cambiar 'usuario' por 'usuario'
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required',
        ]);
    
        // Buscar al usuario por su nombre de usuario
        $user = Usuario::where('usuario', $request->usuario)->first();
    
        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'usuario' => ['The provided credentials are incorrect.'],
            // ]);
            return response()->json([
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ], 401);
        }
    
        // Crear un token personal para el usuario
        // $token = $user->createToken('auth_token')->plainTextToken;
        $token = "d0bdf102c221b53c81de90cfde55c51c1ce852ab036897f00c9c70aa12e42adb";
    
        // Retornar el token en la respuesta
        return response()->json([
            'success' => 'true',
            'token' => $token,
            'token_type' => 'Bearer',
            'id_empresa' => $user['id_empresa']
        ]);
    }

    public function logout(Request $request)
    {
        // Revoca el token actual del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ], 200);
    }
}
