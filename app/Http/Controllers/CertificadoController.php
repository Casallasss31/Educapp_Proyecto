<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificadoRequest;
use App\Services\CertificadoService;
use Illuminate\Http\JsonResponse;

class CertificadoController extends Controller
{
    protected CertificadoService $certificadoService;

    public function __construct(CertificadoService $certificadoService)
    {
        $this->certificadoService = $certificadoService;
    }

    public function index(): JsonResponse
    {
        $certificados = $this->certificadoService->getAll();

        return response()->json([
            'mensaje' => 'Certificados obtenidos correctamente.',
            'datos' => $certificados
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $certificado = $this->certificadoService->findById($id);

        if (!$certificado) {
            return response()->json([
                'mensaje' => 'Certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Certificado obtenido correctamente.',
            'datos' => $certificado
        ], 200);
    }

    public function store(CertificadoRequest $request): JsonResponse
    {
        $certificado = $this->certificadoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Certificado creado correctamente.',
            'datos' => $certificado
        ], 201);
    }

    public function update(CertificadoRequest $request, int $id): JsonResponse
    {
        $certificado = $this->certificadoService->update(
            $id,
            $request->validated()
        );

        if (!$certificado) {
            return response()->json([
                'mensaje' => 'Certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Certificado actualizado correctamente.',
            'datos' => $certificado
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->certificadoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Certificado no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Certificado eliminado correctamente.'
        ], 200);
    }
}