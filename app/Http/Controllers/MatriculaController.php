<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Services\MatriculaService;
use Illuminate\Http\JsonResponse;

class MatriculaController extends Controller
{
    protected MatriculaService $matriculaService;

    public function __construct(
        MatriculaService $matriculaService
    ) {
        $this->matriculaService = $matriculaService;
    }

    public function index(): JsonResponse
    {
        $matriculas = $this->matriculaService->getAll();

        return response()->json([
            'mensaje' => 'Matrículas obtenidas correctamente.',
            'datos' => $matriculas
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $matricula = $this->matriculaService->findById(
            $id
        );

        if (!$matricula) {
            return response()->json([
                'mensaje' => 'Matrícula no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Matrícula obtenida correctamente.',
            'datos' => $matricula
        ], 200);
    }

    public function store(
        MatriculaRequest $request
    ): JsonResponse {
        $matricula = $this->matriculaService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Matrícula creada correctamente.',
            'datos' => $matricula
        ], 201);
    }

    public function update(
        MatriculaRequest $request,
        int $id
    ): JsonResponse {
        $matricula = $this->matriculaService->update(
            $id,
            $request->validated()
        );

        if (!$matricula) {
            return response()->json([
                'mensaje' => 'Matrícula no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Matrícula actualizada correctamente.',
            'datos' => $matricula
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->matriculaService->delete(
            $id
        );

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Matrícula no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Matrícula eliminada correctamente.'
        ], 200);
    }
}
