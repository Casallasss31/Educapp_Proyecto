<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotaRequest;
use App\Services\NotaService;
use Illuminate\Http\JsonResponse;

class NotaController extends Controller
{
    protected NotaService $notaService;

    public function __construct(NotaService $notaService)
    {
        $this->notaService = $notaService;
    }

    public function index(): JsonResponse
    {
        $notas = $this->notaService->getAll();

        return response()->json([
            'mensaje' => 'Notas obtenidas correctamente.',
            'datos' => $notas
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $nota = $this->notaService->findById($id);

        if (!$nota) {
            return response()->json([
                'mensaje' => 'Nota no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Nota obtenida correctamente.',
            'datos' => $nota
        ], 200);
    }

    public function store(NotaRequest $request): JsonResponse
    {
        $nota = $this->notaService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Nota creada correctamente.',
            'datos' => $nota
        ], 201);
    }

    public function update(NotaRequest $request, int $id): JsonResponse
    {
        $nota = $this->notaService->update(
            $id,
            $request->validated()
        );

        if (!$nota) {
            return response()->json([
                'mensaje' => 'Nota no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Nota actualizada correctamente.',
            'datos' => $nota
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->notaService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Nota no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Nota eliminada correctamente.'
        ], 200);
    }
}