<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetalleBoletinRequest;
use App\Services\DetalleBoletinService;

class DetalleBoletinController extends Controller
{
    protected DetalleBoletinService $detalleBoletinService;

    public function __construct(DetalleBoletinService $detalleBoletinService)
    {
        $this->detalleBoletinService = $detalleBoletinService;
    }

    // Listar todos los detalles de boletines
    public function index()
    {
        $detalles = $this->detalleBoletinService->getAll();

        return response()->json($detalles, 200);
    }

    // Registrar un detalle de boletín
    public function store(DetalleBoletinRequest $request)
    {
        $detalle = $this->detalleBoletinService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Detalle de boletín registrado correctamente',
            'data' => $detalle
        ], 201);
    }

    // Consultar un detalle por ID
    public function show(int $id)
    {
        $detalle = $this->detalleBoletinService->findById($id);

        if (!$detalle) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado'
            ], 404);
        }

        return response()->json($detalle, 200);
    }

    // Actualizar un detalle de boletín
    public function update(DetalleBoletinRequest $request, int $id)
    {
        $detalle = $this->detalleBoletinService->update(
            $id,
            $request->validated()
        );

        if (!$detalle) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle de boletín actualizado correctamente',
            'data' => $detalle
        ], 200);
    }

    // Eliminar un detalle de boletín
    public function destroy(int $id)
    {
        $eliminado = $this->detalleBoletinService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Detalle de boletín no encontrado'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle de boletín eliminado correctamente'
        ], 200);
    }
}
