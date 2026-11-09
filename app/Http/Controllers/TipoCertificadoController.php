<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoCertificadoRequest;
use App\Services\TipoCertificadoService;
use Illuminate\Http\JsonResponse;

class TipoCertificadoController extends Controller
{
    protected TipoCertificadoService $tipoCertificadoService;

    public function __construct(TipoCertificadoService $tipoCertificadoService)
    {
        $this->tipoCertificadoService = $tipoCertificadoService;
    }

    public function index(): JsonResponse
    {
        $tipos = $this->tipoCertificadoService->getAll();

        return response()->json([
            'mensaje' => 'Tipos de certificado obtenidos correctamente.',
            'datos' => $tipos
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $tipo = $this->tipoCertificadoService->findById($id);

        if (!$tipo) {
            return response()->json([
                'mensaje' => 'Tipo de certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Tipo de certificado obtenido correctamente.',
            'datos' => $tipo
        ], 200);
    }

    public function store(TipoCertificadoRequest $request): JsonResponse
    {
        $tipo = $this->tipoCertificadoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Tipo de certificado creado correctamente.',
            'datos' => $tipo
        ], 201);
    }

    public function update(TipoCertificadoRequest $request, int $id): JsonResponse
    {
        $tipo = $this->tipoCertificadoService->update(
            $id,
            $request->validated()
        );

        if (!$tipo) {
            return response()->json([
                'mensaje' => 'Tipo de certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Tipo de certificado actualizado correctamente.',
            'datos' => $tipo
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->tipoCertificadoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Tipo de certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Tipo de certificado eliminado correctamente.'
        ], 200);
    }
}