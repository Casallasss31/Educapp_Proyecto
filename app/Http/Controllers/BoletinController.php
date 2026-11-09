<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoletinRequest;
use App\Services\BoletinService;
use Illuminate\Http\JsonResponse;

class BoletinController extends Controller
{
    protected BoletinService $boletinService;

    public function __construct(BoletinService $boletinService)
    {
        $this->boletinService = $boletinService;
    }

    public function index(): JsonResponse
    {
        $boletines = $this->boletinService->getAll();

        return response()->json([
            'mensaje' => 'Boletines obtenidos correctamente.',
            'datos' => $boletines
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $boletin = $this->boletinService->findById($id);

        if (!$boletin) {
            return response()->json([
                'mensaje' => 'Boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Boletín obtenido correctamente.',
            'datos' => $boletin
        ], 200);
    }

    public function store(BoletinRequest $request): JsonResponse
    {
        $boletin = $this->boletinService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Boletín creado correctamente.',
            'datos' => $boletin
        ], 201);
    }

    public function update(BoletinRequest $request, int $id): JsonResponse
    {
        $boletin = $this->boletinService->update(
            $id,
            $request->validated()
        );

        if (!$boletin) {
            return response()->json([
                'mensaje' => 'Boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Boletín actualizado correctamente.',
            'datos' => $boletin
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->boletinService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Boletín eliminado correctamente.'
        ], 200);
    }
}