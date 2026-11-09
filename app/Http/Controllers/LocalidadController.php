<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalidadRequest;
use App\Services\LocalidadService;
use Illuminate\Http\JsonResponse;

class LocalidadController extends Controller
{
    protected LocalidadService $localidadService;

    public function __construct(LocalidadService $localidadService)
    {
        $this->localidadService = $localidadService;
    }

    public function index(): JsonResponse
    {
        $localidades = $this->localidadService->getAll();

        return response()->json([
            'mensaje' => 'Localidades obtenidas correctamente.',
            'datos' => $localidades
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $localidad = $this->localidadService->findById($id);

        if (!$localidad) {
            return response()->json([
                'mensaje' => 'Localidad no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Localidad obtenida correctamente.',
            'datos' => $localidad
        ], 200);
    }

    public function store(LocalidadRequest $request): JsonResponse
    {
        $localidad = $this->localidadService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Localidad creada correctamente.',
            'datos' => $localidad
        ], 201);
    }

    public function update(LocalidadRequest $request, int $id): JsonResponse
    {
        $localidad = $this->localidadService->update(
            $id,
            $request->validated()
        );

        if (!$localidad) {
            return response()->json([
                'mensaje' => 'Localidad no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Localidad actualizada correctamente.',
            'datos' => $localidad
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->localidadService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Localidad no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Localidad eliminada correctamente.'
        ], 200);
    }
}