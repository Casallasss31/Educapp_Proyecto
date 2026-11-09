<?php

namespace App\Http\Controllers;

use App\Http\Requests\MateriaRequest;
use App\Services\MateriaService;
use Illuminate\Http\JsonResponse;

class MateriaController extends Controller
{
    protected MateriaService $materiaService;

    public function __construct(MateriaService $materiaService)
    {
        $this->materiaService = $materiaService;
    }

    public function index(): JsonResponse
    {
        $materias = $this->materiaService->getAll();

        return response()->json([
            'mensaje' => 'Materias obtenidas correctamente.',
            'datos' => $materias
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $materia = $this->materiaService->findById($id);

        if (!$materia) {
            return response()->json([
                'mensaje' => 'Materia no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Materia obtenida correctamente.',
            'datos' => $materia
        ], 200);
    }

    public function store(MateriaRequest $request): JsonResponse
    {
        $materia = $this->materiaService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Materia creada correctamente.',
            'datos' => $materia
        ], 201);
    }

    public function update(MateriaRequest $request, int $id): JsonResponse
    {
        $materia = $this->materiaService->update(
            $id,
            $request->validated()
        );

        if (!$materia) {
            return response()->json([
                'mensaje' => 'Materia no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Materia actualizada correctamente.',
            'datos' => $materia
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->materiaService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Materia no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Materia eliminada correctamente.'
        ], 200);
    }
}