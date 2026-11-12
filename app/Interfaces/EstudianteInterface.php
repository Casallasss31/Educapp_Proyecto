<?php

namespace App\Interfaces;

use App\Models\Estudiante;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

interface EstudianteInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Estudiante;

    public function findUsuario(int $idUsuario): ?Usuario;

    public function create(array $data): Estudiante;

    public function update(
        int $id,
        array $data
    ): ?Estudiante;

    public function delete(int $id): bool;

    public function existsById(int $id): bool;

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool;

    public function hasMatriculas(int $id): bool;
}
