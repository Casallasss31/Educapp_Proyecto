<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarrioRequest;
use App\Services\BarrioService;
use Illuminate\Http\JsonResponse;

class BarrioController extends Controller
{
    protected BarrioService $barrioService;

    public function __construct(BarrioService $barrioService)
    {
        $this->barrioService = $barrioService;
    }

    public function index(): JsonResponse
    {
        $barrios = $this->barrioService->getAll();

        return response()->json([
            'mensaje' => 'Barrios obtenidos correctamente.',
            'datos' => $barrios
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $barrio = $this->barrioService->findById($id);

        if (!$barrio) {
            return response()->json([
                'mensaje' => 'Barrio no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Barrio obtenido correctamente.',
            'datos' => $barrio
        ], 200);
    }

    public function store(BarrioRequest $request): JsonResponse
    {
        $barrio = $this->barrioService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Barrio creado correctamente.',
            'datos' => $barrio
        ], 201);
    }

    public function update(BarrioRequest $request, int $id): JsonResponse
    {
        $barrio = $this->barrioService->update(
            $id,
            $request->validated()
        );

        if (!$barrio) {
            return response()->json([
                'mensaje' => 'Barrio no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Barrio actualizado correctamente.',
            'datos' => $barrio
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->barrioService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Barrio no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Barrio eliminado correctamente.'
        ], 200);
    }
}