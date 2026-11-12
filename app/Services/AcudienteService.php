<?php

namespace App\Services;

use App\Interfaces\AcudienteInterface;
use App\Models\Acudiente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AcudienteService
{
    protected AcudienteInterface $acudienteRepository;

    public function __construct(
        AcudienteInterface $acudienteRepository
    ) {
        $this->acudienteRepository = $acudienteRepository;
    }

    public function getAll(): Collection
    {
        return $this->acudienteRepository->getAll();
    }

    public function findById(int $id): ?Acudiente
    {
        return $this->acudienteRepository->findById($id);
    }

    public function create(array $data): Acudiente
    {
        $this->validarUsuario(
            $data['Id_usuario']
        );

        return $this->acudienteRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Acudiente {
        $acudiente = $this->acudienteRepository->findById($id);

        if (!$acudiente) {
            return null;
        }

        if (isset($data['Id_usuario'])) {
            $this->validarUsuario(
                $data['Id_usuario'],
                $id
            );
        }

        return $this->acudienteRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $acudiente = $this->acudienteRepository->findById($id);

        if (!$acudiente) {
            return false;
        }

        if ($this->acudienteRepository->hasEstudiantes($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el acudiente porque tiene estudiantes asociados.'
            );
        }

        return $this->acudienteRepository->delete($id);
    }

    private function validarUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): void {
        if (
            $this->acudienteRepository->existsByUsuario(
                $idUsuario,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'Este usuario ya está registrado como acudiente.'
                ]
            ]);
        }
    }
}
