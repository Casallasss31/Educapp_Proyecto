<?php

namespace App\Services;

use App\Interfaces\MatriculaInterface;
use App\Models\Matricula;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class MatriculaService
{
    protected MatriculaInterface $matriculaRepository;

    public function __construct(
        MatriculaInterface $matriculaRepository
    ) {
        $this->matriculaRepository = $matriculaRepository;
    }

    public function getAll(): Collection
    {
        return $this->matriculaRepository->getAll();
    }

    public function findById(int $id): ?Matricula
    {
        return $this->matriculaRepository->findById($id);
    }

    public function getByEstudiante(
        int $idEstudiante
    ): Collection {
        return $this->matriculaRepository->getByEstudiante(
            $idEstudiante
        );
    }

    public function create(array $data): Matricula
    {
        $this->validarFecha(
            $data['Fecha_Matricula']
        );

        $anio = Carbon::parse(
            $data['Fecha_Matricula']
        )->year;

        $this->validarDuplicado(
            (int) $data['Id_estudiante'],
            $anio
        );

        return $this->matriculaRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Matricula {
        $matricula = $this->matriculaRepository->findById(
            $id
        );

        if (!$matricula) {
            return null;
        }

        $fecha = $data['Fecha_Matricula']
            ?? $matricula->Fecha_Matricula->format('Y-m-d');

        $idEstudiante = (int) (
            $data['Id_estudiante']
            ?? $matricula->Id_estudiante
        );

        $this->validarFecha($fecha);

        $anio = Carbon::parse($fecha)->year;

        $this->validarDuplicado(
            $idEstudiante,
            $anio,
            $id
        );

        return $this->matriculaRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $matricula = $this->matriculaRepository->findById(
            $id
        );

        if (!$matricula) {
            return false;
        }

        try {
            return $this->matriculaRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar la matrícula porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarFecha(
        string $fecha
    ): void {
        $fechaMatricula = Carbon::parse($fecha)
            ->startOfDay();

        if ($fechaMatricula->isFuture()) {
            throw ValidationException::withMessages([
                'Fecha_Matricula' => [
                    'La fecha de matrícula no puede ser futura.'
                ]
            ]);
        }
    }

    private function validarDuplicado(
        int $idEstudiante,
        int $anio,
        ?int $excludeId = null
    ): void {
        if (
            $this->matriculaRepository->existsByEstudianteAndAnio(
                $idEstudiante,
                $anio,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_estudiante' => [
                    'El estudiante ya tiene una matrícula registrada para este año.'
                ]
            ]);
        }
    }
}
