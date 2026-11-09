<?php

namespace App\Repositories;

use App\Interfaces\HorarioAcademicoInterface;
use App\Models\HorarioAcademico;
use Illuminate\Database\Eloquent\Collection;

class HorarioAcademicoRepository implements HorarioAcademicoInterface
{
    public function getAll(): Collection
    {
        return HorarioAcademico::all();
    }

    public function findById(int $id): ?HorarioAcademico
    {
        return HorarioAcademico::find($id);
    }

    public function create(array $data): HorarioAcademico
    {
        return HorarioAcademico::create($data);
    }

    public function update(int $id, array $data): ?HorarioAcademico
    {
        $horario = HorarioAcademico::find($id);

        if (!$horario) {
            return null;
        }

        $horario->update($data);

        return $horario;
    }

    public function delete(int $id): bool
    {
        $horario = HorarioAcademico::find($id);

        if (!$horario) {
            return false;
        }

        return (bool) $horario->delete();
    }
}