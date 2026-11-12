<?php

namespace App\Services;

use App\Interfaces\GrupoSanguineoInterface;
use App\Models\GrupoSanguineo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class GrupoSanguineoService
{
    protected GrupoSanguineoInterface $grupoSanguineoRepository;

    public function __construct(
        GrupoSanguineoInterface $grupoSanguineoRepository
    ) {
        $this->grupoSanguineoRepository = $grupoSanguineoRepository;
    }

    public function getAll(): Collection
    {
        return $this->grupoSanguineoRepository->getAll();
    }

    public function findById(int $id): ?GrupoSanguineo
    {
        return $this->grupoSanguineoRepository->findById($id);
    }

    public function create(array $data): GrupoSanguineo
    {
        if (
            $this->grupoSanguineoRepository->existsByGrupoAndRH(
                $data['Grupo'],
                $data['RH']
            )
        ) {
            throw ValidationException::withMessages([
                'Grupo' => [
                    'Esta combinación de grupo sanguíneo y RH ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->grupoSanguineoRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?GrupoSanguineo {
        $grupoSanguineo = $this->grupoSanguineoRepository->findById($id);

        if (!$grupoSanguineo) {
            return null;
        }

        $grupo = $data['Grupo'] ?? $grupoSanguineo->Grupo;
        $rh = $data['RH'] ?? $grupoSanguineo->RH;

        if (
            $this->grupoSanguineoRepository->existsByGrupoAndRH(
                $grupo,
                $rh,
                $id
            )
        ) {
            throw ValidationException::withMessages([
                'Grupo' => [
                    'Ya existe otro registro con esta combinación de grupo sanguíneo y RH.'
                ]
            ]);
        }

        return $this->grupoSanguineoRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $grupoSanguineo = $this->grupoSanguineoRepository->findById($id);

        if (!$grupoSanguineo) {
            return false;
        }

        if ($this->grupoSanguineoRepository->hasUsuarios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el grupo sanguíneo porque tiene usuarios asociados.'
            );
        }

        return $this->grupoSanguineoRepository->delete($id);
    }
}
