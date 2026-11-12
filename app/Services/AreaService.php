<?php

namespace App\Services;

use App\Interfaces\AreaInterface;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AreaService
{
    protected AreaInterface $areaRepository;

    public function __construct(
        AreaInterface $areaRepository
    ) {
        $this->areaRepository = $areaRepository;
    }

    public function getAll(): Collection
    {
        return $this->areaRepository->getAll();
    }

    public function findById(int $id): ?Area
    {
        return $this->areaRepository->findById($id);
    }

    public function create(array $data): Area
    {
        $data['Nombre_Area'] = trim(
            $data['Nombre_Area']
        );

        if ($data['Nombre_Area'] === '') {
            throw ValidationException::withMessages([
                'Nombre_Area' => [
                    'El nombre del área no puede estar vacío.'
                ]
            ]);
        }

        if (
            $this->areaRepository->existsByNombre(
                $data['Nombre_Area']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Area' => [
                    'Esta área académica ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->areaRepository->create($data);
    }

    public function update(int $id, array $data): ?Area
    {
        $area = $this->areaRepository->findById($id);

        if (!$area) {
            return null;
        }

        if (isset($data['Nombre_Area'])) {
            $data['Nombre_Area'] = trim(
                $data['Nombre_Area']
            );

            if ($data['Nombre_Area'] === '') {
                throw ValidationException::withMessages([
                    'Nombre_Area' => [
                        'El nombre del área no puede estar vacío.'
                    ]
                ]);
            }

            if (
                $this->areaRepository->existsByNombre(
                    $data['Nombre_Area'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Area' => [
                        'Ya existe otra área académica con este nombre.'
                    ]
                ]);
            }
        }

        return $this->areaRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $area = $this->areaRepository->findById($id);

        if (!$area) {
            return false;
        }

        if ($this->areaRepository->hasMaterias($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el área porque tiene materias asociadas.'
            );
        }

        return $this->areaRepository->delete($id);
    }
}
