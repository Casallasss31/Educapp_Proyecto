<?php

namespace App\Services;

use App\Interfaces\MateriaInterface;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class MateriaService
{
    protected MateriaInterface $materiaRepository;

    public function __construct(
        MateriaInterface $materiaRepository
    ) {
        $this->materiaRepository = $materiaRepository;
    }

    public function getAll(): Collection
    {
        return $this->materiaRepository->getAll();
    }

    public function findById(int $id): ?Materia
    {
        return $this->materiaRepository->findById($id);
    }

    public function create(array $data): Materia
    {
        $data['Nombre_Materia'] = trim(
            $data['Nombre_Materia']
        );

        $this->validarNombre(
            $data['Nombre_Materia']
        );

        $this->validarDuplicado(
            $data['Nombre_Materia'],
            $data['Id_area']
        );

        return $this->materiaRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Materia {
        $materia = $this->materiaRepository->findById(
            $id
        );

        if (!$materia) {
            return null;
        }

        $nombre = isset($data['Nombre_Materia'])
            ? trim($data['Nombre_Materia'])
            : $materia->Nombre_Materia;

        $idArea = $data['Id_area']
            ?? $materia->Id_area;

        $this->validarNombre($nombre);

        if ($idArea !== null) {
            $this->validarDuplicado(
                $nombre,
                (int) $idArea,
                $id
            );
        }

        if (isset($data['Nombre_Materia'])) {
            $data['Nombre_Materia'] = $nombre;
        }

        return $this->materiaRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $materia = $this->materiaRepository->findById(
            $id
        );

        if (!$materia) {
            return false;
        }

        if ($this->materiaRepository->hasHorarios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la materia porque tiene horarios académicos asociados.'
            );
        }

        try {
            return $this->materiaRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar la materia porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarNombre(
        string $nombre
    ): void {
        if (trim($nombre) === '') {
            throw ValidationException::withMessages([
                'Nombre_Materia' => [
                    'El nombre de la materia no puede estar vacío.'
                ]
            ]);
        }
    }

    private function validarDuplicado(
        string $nombre,
        int $idArea,
        ?int $excludeId = null
    ): void {
        if (
            $this->materiaRepository->existsByNameAndArea(
                $nombre,
                $idArea,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Materia' => [
                    'Ya existe una materia con este nombre en el área seleccionada.'
                ]
            ]);
        }
    }
}
