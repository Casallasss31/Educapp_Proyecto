<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {

        $user = $request->user('api');

        if (!$user) {
            return response()->json([
                'mensaje' => 'Usuario no autenticado.'
            ], 401);
        }

        if (!$user->hasPermission($permission)) {
            return response()->json([
                'mensaje' => 'No tienes permiso para esta acción.'
            ], 403);
        }

        return $next($request);
    }
}