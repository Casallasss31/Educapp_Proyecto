<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrupoSanguineoRequest;
use App\Services\GrupoSanguineoService;
use Illuminate\Http\JsonResponse;

class GrupoSanguineoController extends Controller
{
    protected GrupoSanguineoService $grupoSanguineoService;

    public function __construct(
        GrupoSanguineoService $grupoSanguineoService
    ) {
        $this->grupoSanguineoService = $grupoSanguineoService;
    }

    public function index(): JsonResponse
    {
        $grupos = $this->grupoSanguineoService->getAll();

        return response()->json([
            'mensaje' => 'Grupos sanguíneos obtenidos correctamente.',
            'datos' => $grupos
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $grupo = $this->grupoSanguineoService->findById($id);

        if (!$grupo) {
            return response()->json([
                'mensaje' => 'Grupo sanguíneo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grupo sanguíneo obtenido correctamente.',
            'datos' => $grupo
        ], 200);
    }

    public function store(
        GrupoSanguineoRequest $request
    ): JsonResponse {
        $grupo = $this->grupoSanguineoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Grupo sanguíneo creado correctamente.',
            'datos' => $grupo
        ], 201);
    }

    public function update(
        GrupoSanguineoRequest $request,
        int $id
    ): JsonResponse {
        $grupo = $this->grupoSanguineoService->update(
            $id,
            $request->validated()
        );

        if (!$grupo) {
            return response()->json([
                'mensaje' => 'Grupo sanguíneo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grupo sanguíneo actualizado correctamente.',
            'datos' => $grupo
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->grupoSanguineoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Grupo sanguíneo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Grupo sanguíneo eliminado correctamente.'
        ], 200);
    }
}
