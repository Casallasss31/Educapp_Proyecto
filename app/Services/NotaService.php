<?php

namespace App\Services;

use App\Interfaces\NotaInterface;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class NotaService
{
    protected NotaInterface $notaRepository;

    public function __construct(
        NotaInterface $notaRepository
    ) {
        $this->notaRepository = $notaRepository;
    }

    public function getAll(): Collection
    {
        return $this->notaRepository->getAll();
    }

    public function findById(int $id): ?Nota
    {
        return $this->notaRepository->findById($id);
    }

    public function create(array $data): Nota
    {
        $data['Nombre_Nota'] = trim(
            $data['Nombre_Nota']
        );

        if ($data['Nombre_Nota'] === '') {
            throw ValidationException::withMessages([
                'Nombre_Nota' => [
                    'El nombre de la nota no puede estar vacío.'
                ]
            ]);
        }

        if (
            $this->notaRepository->existsByNombre(
                $data['Nombre_Nota']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Nota' => [
                    'Esta nota ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->notaRepository->create($data);
    }

    public function update(int $id, array $data): ?Nota
    {
        $nota = $this->notaRepository->findById($id);

        if (!$nota) {
            return null;
        }

        if (isset($data['Nombre_Nota'])) {
            $data['Nombre_Nota'] = trim(
                $data['Nombre_Nota']
            );

            if ($data['Nombre_Nota'] === '') {
                throw ValidationException::withMessages([
                    'Nombre_Nota' => [
                        'El nombre de la nota no puede estar vacío.'
                    ]
                ]);
            }

            if (
                $this->notaRepository->existsByNombre(
                    $data['Nombre_Nota'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Nota' => [
                        'Ya existe otra nota con este nombre.'
                    ]
                ]);
            }
        }

        return $this->notaRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $nota = $this->notaRepository->findById($id);

        if (!$nota) {
            return false;
        }

        if ($this->notaRepository->hasDetallesBoletin($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la nota porque tiene detalles de boletín asociados.'
            );
        }

        return $this->notaRepository->delete($id);
    }
}
