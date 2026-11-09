<?php

namespace App\Interfaces;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Collection;

interface DocenteInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Docente;

    public function create(array $data): Docente;

    public function update(int $id, array $data): ?Docente;

    public function delete(int $id): bool;
}