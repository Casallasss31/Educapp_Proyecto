<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfesionRequest;
use App\Services\ProfesionService;
use Illuminate\Http\JsonResponse;

class ProfesionController extends Controller
{
    protected ProfesionService $profesionService;

    public function __construct(ProfesionService $profesionService)
    {
        $this->profesionService = $profesionService;
    }

    public function index(): JsonResponse
    {
        $profesiones = $this->profesionService->getAll();

        return response()->json([
            'mensaje' => 'Profesiones obtenidas correctamente.',
            'datos' => $profesiones
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $profesion = $this->profesionService->findById($id);

        if (!$profesion) {
            return response()->json([
                'mensaje' => 'Profesión no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Profesión obtenida correctamente.',
            'datos' => $profesion
        ], 200);
    }

    public function store(ProfesionRequest $request): JsonResponse
    {
        $profesion = $this->profesionService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Profesión creada correctamente.',
            'datos' => $profesion
        ], 201);
    }

    public function update(ProfesionRequest $request, int $id): JsonResponse
    {
        $profesion = $this->profesionService->update(
            $id,
            $request->validated()
        );

        if (!$profesion) {
            return response()->json([
                'mensaje' => 'Profesión no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Profesión actualizada correctamente.',
            'datos' => $profesion
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->profesionService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Profesión no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Profesión eliminada correctamente.'
        ], 200);
    }
}