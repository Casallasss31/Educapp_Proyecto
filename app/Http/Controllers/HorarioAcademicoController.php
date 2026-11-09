<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioAcademicoRequest;
use App\Services\HorarioAcademicoService;
use Illuminate\Http\JsonResponse;

class HorarioAcademicoController extends Controller
{
    protected HorarioAcademicoService $horarioAcademicoService;

    public function __construct(HorarioAcademicoService $horarioAcademicoService)
    {
        $this->horarioAcademicoService = $horarioAcademicoService;
    }

    public function index(): JsonResponse
    {
        $horarios = $this->horarioAcademicoService->getAll();

        return response()->json([
            'mensaje' => 'Horarios académicos obtenidos correctamente.',
            'datos' => $horarios
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $horario = $this->horarioAcademicoService->findById($id);

        if (!$horario) {
            return response()->json([
                'mensaje' => 'Horario académico no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario académico obtenido correctamente.',
            'datos' => $horario
        ], 200);
    }

    public function store(HorarioAcademicoRequest $request): JsonResponse
    {
        $horario = $this->horarioAcademicoService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Horario académico creado correctamente.',
            'datos' => $horario
        ], 201);
    }

    public function update(HorarioAcademicoRequest $request, int $id): JsonResponse
    {
        $horario = $this->horarioAcademicoService->update(
            $id,
            $request->validated()
        );

        if (!$horario) {
            return response()->json([
                'mensaje' => 'Horario académico no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario académico actualizado correctamente.',
            'datos' => $horario
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->horarioAcademicoService->delete($id);

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Horario académico no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario académico eliminado correctamente.'
        ], 200);
    }
}