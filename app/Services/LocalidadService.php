<?php

namespace App\Services;

use App\Interfaces\LocalidadInterface;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class LocalidadService
{
    protected LocalidadInterface $localidadRepository;

    public function __construct(
        LocalidadInterface $localidadRepository
    ) {
        $this->localidadRepository = $localidadRepository;
    }

    public function getAll(): Collection
    {
        return $this->localidadRepository->getAll();
    }

    public function findById(int $id): ?Localidad
    {
        return $this->localidadRepository->findById($id);
    }

    public function create(array $data): Localidad
    {
        $data['Nombre_Localidad'] = trim(
            $data['Nombre_Localidad']
        );

        if ($this->localidadRepository->findById($data['Id_Localidad'])) {
            throw ValidationException::withMessages([
                'Id_Localidad' => [
                    'Ya existe una localidad con este ID.'
                ]
            ]);
        }

        if (
            $this->localidadRepository->existsByNombre(
                $data['Nombre_Localidad']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Localidad' => [
                    'Esta localidad ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->localidadRepository->create($data);
    }

    public function update(int $id, array $data): ?Localidad
    {
        $localidad = $this->localidadRepository->findById($id);

        if (!$localidad) {
            return null;
        }

        if (isset($data['Nombre_Localidad'])) {
            $data['Nombre_Localidad'] = trim(
                $data['Nombre_Localidad']
            );

            if (
                $this->localidadRepository->existsByNombre(
                    $data['Nombre_Localidad'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Localidad' => [
                        'Ya existe otra localidad con este nombre.'
                    ]
                ]);
            }
        }

        unset($data['Id_Localidad']);

        return $this->localidadRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $localidad = $this->localidadRepository->findById($id);

        if (!$localidad) {
            return false;
        }

        if ($this->localidadRepository->hasBarrios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la localidad porque tiene barrios asociados.'
            );
        }

        return $this->localidadRepository->delete($id);
    }
}
