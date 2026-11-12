<?php

namespace App\Interfaces;

use App\Models\Docente;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

interface DocenteInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Docente;

    public function findUsuario(int $idUsuario): ?Usuario;

    public function create(array $data): Docente;

    public function update(int $id, array $data): ?Docente;

    public function delete(int $id): bool;

    public function existsById(int $id): bool;

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool;

    public function hasCursos(int $id): bool;
}
