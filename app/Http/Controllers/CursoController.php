<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Services\CursoService;
use Illuminate\Http\JsonResponse;

class CursoController extends Controller
{
    protected CursoService $cursoService;

    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    public function index(): JsonResponse
    {
        $cursos = $this->cursoService->getAll();

        return response()->json([
            'mensaje' => 'Cursos obtenidos correctamente.',
            'datos' => $cursos
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $curso = $this->cursoService->findById($id);

        if (!$curso) {
            return response()->json([
                'mensaje' => 'Curso no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Curso obtenido correctamente.',
            'datos' => $curso
        ], 200);
    }

    public function store(CursoRequest $request): JsonResponse
    {
        $curso = $this->cursoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Curso creado correctamente.',
            'datos' => $curso
        ], 201);
    }

    public function update(CursoRequest $request, int $id): JsonResponse
    {
        $curso = $this->cursoService->update(
            $id,
            $request->validated()
        );

        if (!$curso) {
            return response()->json([
                'mensaje' => 'Curso no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Curso actualizado correctamente.',
            'datos' => $curso
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->cursoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Curso no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Curso eliminado correctamente.'
        ], 200);
    }
}