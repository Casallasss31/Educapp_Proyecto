<?php

namespace App\Interfaces;

use App\Models\Matricula;
use Illuminate\Database\Eloquent\Collection;

interface MatriculaInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Matricula;

    public function create(array $data): Matricula;

    public function update(
        int $id,
        array $data
    ): ?Matricula;

    public function delete(int $id): bool;

    public function existsByEstudianteAndAnio(
        int $idEstudiante,
        int $anio,
        ?int $excludeId = null
    ): bool;

    public function getByEstudiante(
        int $idEstudiante
    ): Collection;
}
