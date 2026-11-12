<?php

namespace App\Services;

use App\Interfaces\RolInterface;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class RolService
{
    protected RolInterface $rolRepository;

    public function __construct(RolInterface $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function getAll(): Collection
    {
        return $this->rolRepository->getAll();
    }

    public function findById(int $id): ?Rol
    {
        return $this->rolRepository->findById($id);
    }

    public function create(array $data): Rol
    {
        if ($this->rolRepository->existsByTipo($data['Tipo'])) {
            throw ValidationException::withMessages([
                'Tipo' => [
                    'Este tipo de rol ya se encuentra registrado.'
                ]
            ]);
        }

        return $this->rolRepository->create($data);
    }

    public function update(int $id, array $data): ?Rol
    {
        $rol = $this->rolRepository->findById($id);

        if (!$rol) {
            return null;
        }

        if (
            isset($data['Tipo']) &&
            $this->rolRepository->existsByTipo(
                $data['Tipo'],
                $id
            )
        ) {
            throw ValidationException::withMessages([
                'Tipo' => [
                    'Ya existe otro rol con este tipo.'
                ]
            ]);
        }

        return $this->rolRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $rol = $this->rolRepository->findById($id);

        if (!$rol) {
            return false;
        }

        if ($this->rolRepository->hasUsuarios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el rol porque tiene usuarios asociados.'
            );
        }

        return $this->rolRepository->delete($id);
    }
}
