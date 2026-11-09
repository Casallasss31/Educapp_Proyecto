<?php

namespace App\Http\Controllers;

use App\Http\Requests\RectorRequest;
use App\Services\RectorService;
use Illuminate\Http\JsonResponse;

class RectorController extends Controller
{
    protected RectorService $rectorService;

    public function __construct(RectorService $rectorService)
    {
        $this->rectorService = $rectorService;
    }

    public function index(): JsonResponse
    {
        $rectores = $this->rectorService->getAll();

        return response()->json([
            'mensaje' => 'Rectores obtenidos correctamente.',
            'datos' => $rectores
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $rector = $this->rectorService->findById($id);

        if (!$rector) {
            return response()->json([
                'mensaje' => 'Rector no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rector obtenido correctamente.',
            'datos' => $rector
        ], 200);
    }

    public function store(RectorRequest $request): JsonResponse
    {
        $rector = $this->rectorService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Rector creado correctamente.',
            'datos' => $rector
        ], 201);
    }

    public function update(RectorRequest $request, int $id): JsonResponse
    {
        $rector = $this->rectorService->update(
            $id,
            $request->validated()
        );

        if (!$rector) {
            return response()->json([
                'mensaje' => 'Rector no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rector actualizado correctamente.',
            'datos' => $rector
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->rectorService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Rector no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Rector eliminado correctamente.'
        ], 200);
    }
}