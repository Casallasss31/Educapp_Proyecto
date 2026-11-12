<?php

namespace App\Services;

use App\Interfaces\ProfesionInterface;
use App\Models\Profesion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ProfesionService
{
    protected ProfesionInterface $profesionRepository;

    public function __construct(
        ProfesionInterface $profesionRepository
    ) {
        $this->profesionRepository = $profesionRepository;
    }

    public function getAll(): Collection
    {
        return $this->profesionRepository->getAll();
    }

    public function findById(int $id): ?Profesion
    {
        return $this->profesionRepository->findById($id);
    }

    public function create(array $data): Profesion
    {
        $data['Nombre_Profesion'] = trim(
            $data['Nombre_Profesion']
        );

        if (
            $this->profesionRepository->existsByNombre(
                $data['Nombre_Profesion']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Profesion' => [
                    'Esta profesión ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->profesionRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Profesion {
        $profesion = $this->profesionRepository->findById($id);

        if (!$profesion) {
            return null;
        }

        if (isset($data['Nombre_Profesion'])) {
            $data['Nombre_Profesion'] = trim(
                $data['Nombre_Profesion']
            );

            if (
                $this->profesionRepository->existsByNombre(
                    $data['Nombre_Profesion'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Profesion' => [
                        'Ya existe otra profesión con este nombre.'
                    ]
                ]);
            }
        }

        return $this->profesionRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $profesion = $this->profesionRepository->findById($id);

        if (!$profesion) {
            return false;
        }

        if ($this->profesionRepository->hasAcudientes($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la profesión porque tiene acudientes asociados.'
            );
        }

        return $this->profesionRepository->delete($id);
    }
}
