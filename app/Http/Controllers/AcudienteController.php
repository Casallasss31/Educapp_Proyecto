<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcudienteRequest;
use App\Services\AcudienteService;
use Illuminate\Http\JsonResponse;

class AcudienteController extends Controller
{
    protected AcudienteService $acudienteService;

    public function __construct(
        AcudienteService $acudienteService
    ) {
        $this->acudienteService = $acudienteService;
    }

    public function index(): JsonResponse
    {
        $acudientes = $this->acudienteService->getAll();

        return response()->json([
            'mensaje' => 'Acudientes obtenidos correctamente.',
            'datos' => $acudientes
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $acudiente = $this->acudienteService->findById($id);

        if (!$acudiente) {
            return response()->json([
                'mensaje' => 'Acudiente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Acudiente obtenido correctamente.',
            'datos' => $acudiente
        ], 200);
    }

    public function store(
        AcudienteRequest $request
    ): JsonResponse {
        $acudiente = $this->acudienteService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Acudiente creado correctamente.',
            'datos' => $acudiente
        ], 201);
    }

    public function update(
        AcudienteRequest $request,
        int $id
    ): JsonResponse {
        $acudiente = $this->acudienteService->update(
            $id,
            $request->validated()
        );

        if (!$acudiente) {
            return response()->json([
                'mensaje' => 'Acudiente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Acudiente actualizado correctamente.',
            'datos' => $acudiente
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->acudienteService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Acudiente no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Acudiente eliminado correctamente.'
        ], 200);
    }
}
