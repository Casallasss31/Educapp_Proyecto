<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    protected UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index(): JsonResponse
    {
        $usuarios = $this->usuarioService->getAll();

        return response()->json([
            'mensaje' => 'Usuarios obtenidos correctamente.',
            'datos' => $usuarios
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $usuario = $this->usuarioService->findById($id);

        if (!$usuario) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Usuario obtenido correctamente.',
            'datos' => $usuario
        ], 200);
    }

    public function store(UsuarioRequest $request): JsonResponse
    {
        $usuario = $this->usuarioService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Usuario creado correctamente.',
            'datos' => $usuario
        ], 201);
    }

    public function update(UsuarioRequest $request, int $id): JsonResponse
    {
        $usuario = $this->usuarioService->update(
            $id,
            $request->validated()
        );

        if (!$usuario) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Usuario actualizado correctamente.',
            'datos' => $usuario
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->usuarioService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Usuario eliminado correctamente.'
        ], 200);
    }
}