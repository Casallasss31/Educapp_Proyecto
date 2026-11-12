<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocenteRequest;
use App\Services\DocenteService;
use Illuminate\Http\JsonResponse;

class DocenteController extends Controller
{
    protected DocenteService $docenteService;

    public function __construct(
        DocenteService $docenteService
    ) {
        $this->docenteService = $docenteService;
    }

    public function index(): JsonResponse
    {
        $docentes = $this->docenteService->getAll();

        return response()->json([
            'mensaje' => 'Docentes obtenidos correctamente.',
            'datos' => $docentes
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $docente = $this->docenteService->findById($id);

        if (!$docente) {
            return response()->json([
                'mensaje' => 'Docente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Docente obtenido correctamente.',
            'datos' => $docente
        ], 200);
    }

    public function store(
        DocenteRequest $request
    ): JsonResponse {
        $docente = $this->docenteService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Docente creado correctamente.',
            'datos' => $docente
        ], 201);
    }

    public function update(
        DocenteRequest $request,
        int $id
    ): JsonResponse {
        $docente = $this->docenteService->update(
            $id,
            $request->validated()
        );

        if (!$docente) {
            return response()->json([
                'mensaje' => 'Docente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Docente actualizado correctamente.',
            'datos' => $docente
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->docenteService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Docente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Docente eliminado correctamente.'
        ], 200);
    }
}
