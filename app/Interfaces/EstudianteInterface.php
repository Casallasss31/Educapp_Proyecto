<?php

namespace App\Interfaces;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Collection;

interface EstudianteInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Estudiante;

    public function create(array $data): Estudiante;

    public function update(int $id, array $data): ?Estudiante;

    public function delete(int $id): bool;
}