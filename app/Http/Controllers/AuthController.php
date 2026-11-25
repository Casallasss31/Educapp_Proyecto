<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Correo' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'mensaje' => 'Credenciales incorrectas'
            ], 403);
        }

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ], 200);
    }

     public function me(): JsonResponse
    {
        $user = auth('api')->user()->load('role');

        if(!$user)
         {
            return response()->json([
            'message' => 'Usuario no encontrado'
        ],403);
            }

        return response()->json([
            'user' => $user,
            'role' => $user->getRoleName(),
            'permissions' => $user->getPermissions(),
        ],200);
    }

     public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ],200);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


}



//protected function respondWithToken(string $token): JsonResponse
    // {
    //     $user = auth('api')->user()->load('role');

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth('api')->factory()->getTTL() * 60,
    //         'user' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'rol' => $user->getRolName(),
    //             'permissions' => $user->getPermissions(),
    //         ],
    //     ],200);
    // }