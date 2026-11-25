<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
    $credentials = $request->validated();

    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json([
            'mensaje' => 'Credenciales incorrectas'
        ], 401);
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
        $user = auth('api')->user()->load('rol');

        if(!$user)
         {
            return response()->json([
            'message' => 'Usuario no encontrado'
        ],403);
            }

        return response()->json([
            'user' => $user,
            'role' => $user->getRolNombres(),
            'permissions' => $user->getPermissions()
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

    protected function respondWithToken(string $token): JsonResponse
    {
    return response()->json([
        'mensaje' => 'Token renovado correctamente.',
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60
    ], 200);
    }

}
