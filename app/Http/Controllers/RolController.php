<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest;
use App\Services\RolService;
use Illuminate\Http\JsonResponse;

class RolController extends Controller
{
    protected RolService $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index(): JsonResponse
    {
        $roles = $this->rolService->getAll();

        return response()->json([
            'mensaje' => 'Roles obtenidos correctamente.',
            'datos' => $roles
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $rol = $this->rolService->findById($id);

        if (!$rol) {
            return response()->json([
                'mensaje' => 'Rol no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rol obtenido correctamente.',
            'datos' => $rol
        ], 200);
    }

    public function store(RolRequest $request): JsonResponse
    {
        $rol = $this->rolService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Rol creado correctamente.',
            'datos' => $rol
        ], 201);
    }

    public function update(RolRequest $request, int $id): JsonResponse
    {
        $rol = $this->rolService->update(
            $id,
            $request->validated()
        );

        if (!$rol) {
            return response()->json([
                'mensaje' => 'Rol no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rol actualizado correctamente.',
            'datos' => $rol
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->rolService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Rol no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rol eliminado correctamente.'
        ], 200);
    }
}