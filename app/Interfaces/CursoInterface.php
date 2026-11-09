<?php

namespace App\Interfaces;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

interface CursoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Curso;

    public function create(array $data): Curso;

    public function update(int $id, array $data): ?Curso;

    public function delete(int $id): bool;
}