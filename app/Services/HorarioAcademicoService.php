<?php

namespace App\Services;

use App\Interfaces\HorarioAcademicoInterface;
use App\Models\HorarioAcademico;
use Illuminate\Database\Eloquent\Collection;

class HorarioAcademicoService
{
    protected HorarioAcademicoInterface $horarioAcademicoRepository;

    public function __construct(
        HorarioAcademicoInterface $horarioAcademicoRepository
    ) {
        $this->horarioAcademicoRepository = $horarioAcademicoRepository;
    }

    public function getAll(): Collection
    {
        return $this->horarioAcademicoRepository->getAll();
    }

    public function findById(int $id): ?HorarioAcademico
    {
        return $this->horarioAcademicoRepository->findById($id);
    }

    public function create(array $data): HorarioAcademico
    {
        return $this->horarioAcademicoRepository->create($data);
    }

    public function update(int $id, array $data): ?HorarioAcademico
    {
        return $this->horarioAcademicoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->horarioAcademicoRepository->delete($id);
    }
}