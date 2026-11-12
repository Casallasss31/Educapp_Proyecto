<?php

namespace App\Services;

use App\Interfaces\EPSInterface;
use App\Models\EPS;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class EPSService
{
    protected EPSInterface $epsRepository;

    public function __construct(EPSInterface $epsRepository)
    {
        $this->epsRepository = $epsRepository;
    }

    public function getAll(): Collection
    {
        return $this->epsRepository->getAll();
    }

    public function findById(int $id): ?EPS
    {
        return $this->epsRepository->findById($id);
    }

    public function create(array $data): EPS
    {
        $data['Nombre_Eps'] = trim($data['Nombre_Eps']);

        if ($this->epsRepository->existsByNombre($data['Nombre_Eps'])) {
            throw ValidationException::withMessages([
                'Nombre_Eps' => [
                    'Esta EPS ya se encuentra registrada.'
                ]
            ]);
        }

        return $this->epsRepository->create($data);
    }

    public function update(int $id, array $data): ?EPS
    {
        $eps = $this->epsRepository->findById($id);

        if (!$eps) {
            return null;
        }

        if (isset($data['Nombre_Eps'])) {
            $data['Nombre_Eps'] = trim($data['Nombre_Eps']);

            if (
                $this->epsRepository->existsByNombre(
                    $data['Nombre_Eps'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Eps' => [
                        'Ya existe otra EPS con este nombre.'
                    ]
                ]);
            }
        }

        return $this->epsRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $eps = $this->epsRepository->findById($id);

        if (!$eps) {
            return false;
        }

        if ($this->epsRepository->hasUsuarios($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la EPS porque tiene usuarios asociados.'
            );
        }

        return $this->epsRepository->delete($id);
    }
}
