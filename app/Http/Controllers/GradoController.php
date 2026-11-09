<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradoRequest;
use App\Services\GradoService;
use Illuminate\Http\JsonResponse;

class GradoController extends Controller
{
    protected GradoService $gradoService;

    public function __construct(GradoService $gradoService)
    {
        $this->gradoService = $gradoService;
    }

    public function index(): JsonResponse
    {
        $grados = $this->gradoService->getAll();

        return response()->json([
            'mensaje' => 'Grados obtenidos correctamente.',
            'datos' => $grados
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $grado = $this->gradoService->findById($id);

        if (!$grado) {
            return response()->json([
                'mensaje' => 'Grado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grado obtenido correctamente.',
            'datos' => $grado
        ], 200);
    }

    public function store(GradoRequest $request): JsonResponse
    {
        $grado = $this->gradoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Grado creado correctamente.',
            'datos' => $grado
        ], 201);
    }

    public function update(GradoRequest $request, int $id): JsonResponse
    {
        $grado = $this->gradoService->update(
            $id,
            $request->validated()
        );

        if (!$grado) {
            return response()->json([
                'mensaje' => 'Grado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grado actualizado correctamente.',
            'datos' => $grado
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->gradoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Grado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grado eliminado correctamente.'
        ], 200);
    }
}