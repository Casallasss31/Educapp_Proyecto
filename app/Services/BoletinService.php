<?php

namespace App\Services;

use App\Interfaces\BoletinInterface;
use App\Models\Boletin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class BoletinService
{
    protected BoletinInterface $boletinRepository;

    public function __construct(
        BoletinInterface $boletinRepository
    ) {
        $this->boletinRepository = $boletinRepository;
    }

    public function getAll(): Collection
    {
        return $this->boletinRepository->getAll();
    }

    public function findById(int $id): ?Boletin
    {
        return $this->boletinRepository->findById($id);
    }

    public function getByEstudiante(
        int $idEstudiante
    ): Collection {
        return $this->boletinRepository->getByEstudiante(
            $idEstudiante
        );
    }

    public function create(array $data): Boletin
    {
        $this->validarFecha(
            $data['Fecha_publicacion']
        );

        $this->validarPeriodo(
            (string) $data['Periodo']
        );

        $this->validarDuplicado(
            (int) $data['Id_estudiante'],
            (int) $data['Id_materia'],
            (string) $data['Periodo'],
            Carbon::parse(
                $data['Fecha_publicacion']
            )->year
        );

        return $this->boletinRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Boletin {
        $boletin = $this->boletinRepository->findById(
            $id
        );

        if (!$boletin) {
            return null;
        }

        $fecha = $data['Fecha_publicacion']
            ?? $boletin->Fecha_publicacion->format('Y-m-d');

        $periodo = (string) (
            $data['Periodo']
            ?? $boletin->Periodo
        );

        $idMateria = (int) (
            $data['Id_materia']
            ?? $boletin->Id_materia
        );

        $idEstudiante = (int) (
            $data['Id_estudiante']
            ?? $boletin->Id_estudiante
        );

        $this->validarFecha($fecha);

        $this->validarPeriodo($periodo);

        $this->validarDuplicado(
            $idEstudiante,
            $idMateria,
            $periodo,
            Carbon::parse($fecha)->year,
            $id
        );

        return $this->boletinRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $boletin = $this->boletinRepository->findById(
            $id
        );

        if (!$boletin) {
            return false;
        }

        try {
            return $this->boletinRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el boletín porque tiene registros académicos relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarFecha(
        string $fecha
    ): void {
        $fechaPublicacion = Carbon::parse($fecha)
            ->startOfDay();

        if ($fechaPublicacion->isFuture()) {
            throw ValidationException::withMessages([
                'Fecha_publicacion' => [
                    'La fecha de publicación no puede ser posterior a la fecha actual.'
                ]
            ]);
        }
    }

    private function validarPeriodo(
        string $periodo
    ): void {
        if (!in_array(
            $periodo,
            ['1', '2', '3'],
            true
        )) {
            throw ValidationException::withMessages([
                'Periodo' => [
                    'El periodo académico debe ser 1, 2 o 3.'
                ]
            ]);
        }
    }

    private function validarDuplicado(
        int $idEstudiante,
        int $idMateria,
        string $periodo,
        int $anio,
        ?int $excludeId = null
    ): void {
        if (
            $this->boletinRepository->existsByPeriodo(
                $idEstudiante,
                $idMateria,
                $periodo,
                $anio,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Periodo' => [
                    'Ya existe un boletín para este estudiante, materia, periodo y año.'
                ]
            ]);
        }
    }
}
