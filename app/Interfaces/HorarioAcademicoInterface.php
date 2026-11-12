<?php

namespace App\Interfaces;

use App\Models\HorarioAcademico;
use Illuminate\Database\Eloquent\Collection;

interface HorarioAcademicoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?HorarioAcademico;

    public function create(array $data): HorarioAcademico;

    public function update(
        int $id,
        array $data
    ): ?HorarioAcademico;

    public function delete(int $id): bool;

    public function existsOverlap(
        int $idCurso,
        string $dia,
        string $horaInicio,
        string $horaFinal,
        ?int $excludeId = null
    ): bool;

    public function getByCurso(
        int $idCurso
    ): Collection;
}
