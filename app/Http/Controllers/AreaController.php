<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Services\AreaService;
use Illuminate\Http\JsonResponse;

class AreaController extends Controller
{
    protected AreaService $areaService;

    public function __construct(
        AreaService $areaService
    ) {
        $this->areaService = $areaService;
    }

    public function index(): JsonResponse
    {
        $areas = $this->areaService->getAll();

        return response()->json([
            'mensaje' => 'Áreas obtenidas correctamente.',
            'datos' => $areas
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $area = $this->areaService->findById($id);

        if (!$area) {
            return response()->json([
                'mensaje' => 'Área no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Área obtenida correctamente.',
            'datos' => $area
        ], 200);
    }

    public function store(AreaRequest $request): JsonResponse
    {
        $area = $this->areaService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Área creada correctamente.',
            'datos' => $area
        ], 201);
    }

    public function update(
        AreaRequest $request,
        int $id
    ): JsonResponse {
        $area = $this->areaService->update(
            $id,
            $request->validated()
        );

        if (!$area) {
            return response()->json([
                'mensaje' => 'Área no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Área actualizada correctamente.',
            'datos' => $area
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->areaService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Área no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Área eliminada correctamente.'
        ], 200);
    }
}
