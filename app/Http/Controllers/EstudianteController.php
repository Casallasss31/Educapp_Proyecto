<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudianteRequest;
use App\Services\EstudianteService;
use Illuminate\Http\JsonResponse;

class EstudianteController extends Controller
{
    protected EstudianteService $estudianteService;

    public function __construct(EstudianteService $estudianteService)
    {
        $this->estudianteService = $estudianteService;
    }

    public function index(): JsonResponse
    {
        $estudiantes = $this->estudianteService->getAll();

        return response()->json([
            'mensaje' => 'Estudiantes obtenidos correctamente.',
            'datos' => $estudiantes
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $estudiante = $this->estudianteService->findById($id);

        if (!$estudiante) {
            return response()->json([
                'mensaje' => 'Estudiante no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Estudiante obtenido correctamente.',
            'datos' => $estudiante
        ], 200);
    }

    public function store(EstudianteRequest $request): JsonResponse
    {
        $estudiante = $this->estudianteService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Estudiante creado correctamente.',
            'datos' => $estudiante
        ], 201);
    }

    public function update(EstudianteRequest $request, int $id): JsonResponse
    {
        $estudiante = $this->estudianteService->update(
            $id,
            $request->validated()
        );

        if (!$estudiante) {
            return response()->json([
                'mensaje' => 'Estudiante no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Estudiante actualizado correctamente.',
            'datos' => $estudiante
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->estudianteService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Estudiante no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Estudiante eliminado correctamente.'
        ], 200);
    }
}