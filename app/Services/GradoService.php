<?php

namespace App\Services;

use App\Interfaces\GradoInterface;
use App\Models\Grado;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class GradoService
{
    protected GradoInterface $gradoRepository;

    public function __construct(
        GradoInterface $gradoRepository
    ) {
        $this->gradoRepository = $gradoRepository;
    }

    public function getAll(): Collection
    {
        return $this->gradoRepository->getAll();
    }

    public function findById(int $id): ?Grado
    {
        return $this->gradoRepository->findById($id);
    }

    public function create(array $data): Grado
    {
        $data['Nombre_Grado'] = trim(
            $data['Nombre_Grado']
        );

        if (
            $this->gradoRepository->existsByNombre(
                $data['Nombre_Grado']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Grado' => [
                    'Este grado académico ya se encuentra registrado.'
                ]
            ]);
        }

        return $this->gradoRepository->create($data);
    }

    public function update(int $id, array $data): ?Grado
    {
        $grado = $this->gradoRepository->findById($id);

        if (!$grado) {
            return null;
        }

        if (isset($data['Nombre_Grado'])) {
            $data['Nombre_Grado'] = trim(
                $data['Nombre_Grado']
            );

            if (
                $this->gradoRepository->existsByNombre(
                    $data['Nombre_Grado'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Grado' => [
                        'Ya existe otro grado académico con este nombre.'
                    ]
                ]);
            }
        }

        return $this->gradoRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $grado = $this->gradoRepository->findById($id);

        if (!$grado) {
            return false;
        }

        if ($this->gradoRepository->hasCursos($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el grado porque tiene cursos asociados.'
            );
        }

        return $this->gradoRepository->delete($id);
    }
}
