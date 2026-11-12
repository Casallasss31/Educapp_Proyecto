<?php

namespace App\Services;

use App\Interfaces\BarrioInterface;
use App\Models\Barrio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class BarrioService
{
    protected BarrioInterface $barrioRepository;

    public function __construct(
        BarrioInterface $barrioRepository
    ) {
        $this->barrioRepository = $barrioRepository;
    }

    public function getAll(): Collection
    {
        return $this->barrioRepository->getAll();
    }

    public function findById(int $id): ?Barrio
    {
        return $this->barrioRepository->findById($id);
    }

    public function create(array $data): Barrio
    {
        $data['Nombre_Barrio'] = trim(
            $data['Nombre_Barrio']
        );

        if ($data['Nombre_Barrio'] === '') {
            throw ValidationException::withMessages([
                'Nombre_Barrio' => [
                    'El nombre del barrio no puede estar vacío.'
                ]
            ]);
        }

        if (
            !$this->barrioRepository->existsLocalidad(
                $data['Id_localidad']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_localidad' => [
                    'La localidad seleccionada no existe.'
                ]
            ]);
        }

        if (
            $this->barrioRepository->existsByNombreAndLocalidad(
                $data['Nombre_Barrio'],
                $data['Id_localidad']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Barrio' => [
                    'Este barrio ya se encuentra registrado en la localidad seleccionada.'
                ]
            ]);
        }

        return $this->barrioRepository->create($data);
    }

    public function update(int $id, array $data): ?Barrio
    {
        $barrio = $this->barrioRepository->findById($id);

        if (!$barrio) {
            return null;
        }

        if (isset($data['Nombre_Barrio'])) {
            $data['Nombre_Barrio'] = trim(
                $data['Nombre_Barrio']
            );

            if ($data['Nombre_Barrio'] === '') {
                throw ValidationException::withMessages([
                    'Nombre_Barrio' => [
                        'El nombre del barrio no puede estar vacío.'
                    ]
                ]);
            }
        }

        $nombre = $data['Nombre_Barrio']
            ?? $barrio->Nombre_Barrio;

        $idLocalidad = $data['Id_localidad']
            ?? $barrio->Id_localidad;

        if (
            !$this->barrioRepository->existsLocalidad(
                $idLocalidad
            )
        ) {
            throw ValidationException::withMessages([
                'Id_localidad' => [
                    'La localidad seleccionada no existe.'
                ]
            ]);
        }

        if (
            $this->barrioRepository->existsByNombreAndLocalidad(
                $nombre,
                $idLocalidad,
                $id
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Barrio' => [
                    'Ya existe otro barrio con este nombre en la localidad seleccionada.'
                ]
            ]);
        }

        return $this->barrioRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $barrio = $this->barrioRepository->findById($id);

        if (!$barrio) {
            return false;
        }

        if ($this->barrioRepository->hasUsuarios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el barrio porque tiene usuarios asociados.'
            );
        }

        return $this->barrioRepository->delete($id);
    }
}
