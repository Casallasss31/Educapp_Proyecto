<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetalleBoletinRequest;
use App\Services\DetalleBoletinService;
use Illuminate\Http\JsonResponse;

class DetalleBoletinController extends Controller
{
    protected DetalleBoletinService $detalleService;

    public function __construct(
        DetalleBoletinService $detalleService
    ) {
        $this->detalleService = $detalleService;
    }

    public function index(): JsonResponse
    {
        $detalles = $this->detalleService->getAll();

        return response()->json([
            'mensaje' => 'Detalles de boletín obtenidos correctamente.',
            'datos' => $detalles
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $detalle = $this->detalleService->findById(
            $id
        );

        if (!$detalle) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle obtenido correctamente.',
            'datos' => $detalle
        ], 200);
    }

    public function store(
        DetalleBoletinRequest $request
    ): JsonResponse {
        $detalle = $this->detalleService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Detalle de boletín creado correctamente.',
            'datos' => $detalle
        ], 201);
    }

    public function update(
        DetalleBoletinRequest $request,
        int $id
    ): JsonResponse {
        $detalle = $this->detalleService->update(
            $id,
            $request->validated()
        );

        if (!$detalle) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle actualizado correctamente.',
            'datos' => $detalle
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->detalleService->delete(
            $id
        );

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle eliminado correctamente.'
        ], 200);
    }

    public function porBoletin(
        int $idBoletin
    ): JsonResponse {
        $detalles = $this->detalleService->getByBoletin(
            $idBoletin
        );

        return response()->json([
            'mensaje' => 'Detalles del boletín obtenidos correctamente.',
            'datos' => $detalles
        ], 200);
    }
}
