<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioAcademicoRequest;
use App\Services\HorarioAcademicoService;
use Illuminate\Http\JsonResponse;

class HorarioAcademicoController extends Controller
{
    protected HorarioAcademicoService $horarioService;

    public function __construct(
        HorarioAcademicoService $horarioService
    ) {
        $this->horarioService = $horarioService;
    }

    public function index(): JsonResponse
    {
        $horarios = $this->horarioService->getAll();

        return response()->json([
            'mensaje' => 'Horarios obtenidos correctamente.',
            'datos' => $horarios
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $horario = $this->horarioService->findById(
            $id
        );

        if (!$horario) {
            return response()->json([
                'mensaje' => 'Horario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario obtenido correctamente.',
            'datos' => $horario
        ], 200);
    }

    public function store(
        HorarioAcademicoRequest $request
    ): JsonResponse {
        $horario = $this->horarioService->create(
            $request->validated()
        );

        return response()->json([
            'mensaje' => 'Horario creado correctamente.',
            'datos' => $horario
        ], 201);
    }

    public function update(
        HorarioAcademicoRequest $request,
        int $id
    ): JsonResponse {
        $horario = $this->horarioService->update(
            $id,
            $request->validated()
        );

        if (!$horario) {
            return response()->json([
                'mensaje' => 'Horario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario actualizado correctamente.',
            'datos' => $horario
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->horarioService->delete(
            $id
        );

        if (!$eliminado) {
            return response()->json([
                'mensaje' => 'Horario no encontrado.'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Horario eliminado correctamente.'
        ], 200);
    }

    public function porCurso(int $idCurso): JsonResponse
    {
        $horarios = $this->horarioService->getByCurso(
            $idCurso
        );

        return response()->json([
            'mensaje' => 'Horarios del curso obtenidos correctamente.',
            'datos' => $horarios
        ], 200);
    }
}
