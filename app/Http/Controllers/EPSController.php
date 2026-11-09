<?php

namespace App\Http\Controllers;

use App\Http\Requests\EPSRequest;
use App\Services\EPSService;
use Illuminate\Http\JsonResponse;

class EPSController extends Controller
{
    protected EPSService $epsService;

    public function __construct(EPSService $epsService)
    {
        $this->epsService = $epsService;
    }

    public function index(): JsonResponse
    {
        $eps = $this->epsService->getAll();

        return response()->json([
            'mensaje' => 'EPS obtenidas correctamente.',
            'datos' => $eps
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $eps = $this->epsService->findById($id);

        if (!$eps) {
            return response()->json([
                'mensaje' => 'EPS no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'EPS obtenida correctamente.',
            'datos' => $eps
        ], 200);
    }

    public function store(EPSRequest $request): JsonResponse
    {
        $eps = $this->epsService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'EPS creada correctamente.',
            'datos' => $eps
        ], 201);
    }

    public function update(EPSRequest $request, int $id): JsonResponse
    {
        $eps = $this->epsService->update(
            $id,
            $request->validated()
        );

        if (!$eps) {
            return response()->json([
                'mensaje' => 'EPS no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'EPS actualizada correctamente.',
            'datos' => $eps
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->epsService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'EPS no encontrada.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'EPS eliminada correctamente.'
        ], 200);
    }
}