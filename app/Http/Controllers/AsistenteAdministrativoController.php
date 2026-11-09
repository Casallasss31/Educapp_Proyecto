<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsistenteAdministrativoRequest;
use App\Services\AsistenteAdministrativoService;
use Illuminate\Http\JsonResponse;

class AsistenteAdministrativoController extends Controller
{
    protected AsistenteAdministrativoService $asistenteAdministrativoService;

    public function __construct(AsistenteAdministrativoService $asistenteAdministrativoService)
    {
        $this->asistenteAdministrativoService = $asistenteAdministrativoService;
    }

    public function index(): JsonResponse
    {
        $asistentes = $this->asistenteAdministrativoService->getAll();

        return response()->json([
            'mensaje' => 'Asistentes administrativos obtenidos correctamente.',
            'datos' => $asistentes
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $asistente = $this->asistenteAdministrativoService->findById($id);

        if (!$asistente) {
            return response()->json([
                'mensaje' => 'Asistente administrativo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Asistente administrativo obtenido correctamente.',
            'datos' => $asistente
        ], 200);
    }

    public function store(AsistenteAdministrativoRequest $request): JsonResponse
    {
        $asistente = $this->asistenteAdministrativoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Asistente administrativo creado correctamente.',
            'datos' => $asistente
        ], 201);
    }

    public function update(AsistenteAdministrativoRequest $request, int $id): JsonResponse
    {
        $asistente = $this->asistenteAdministrativoService->update(
            $id,
            $request->validated()
        );

        if (!$asistente) {
            return response()->json([
                'mensaje' => 'Asistente administrativo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Asistente administrativo actualizado correctamente.',
            'datos' => $asistente
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->asistenteAdministrativoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Asistente administrativo no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Asistente administrativo eliminado correctamente.'
        ], 200);
    }
}