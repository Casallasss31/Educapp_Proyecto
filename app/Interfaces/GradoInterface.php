<?php

namespace App\Interfaces;

use App\Models\Grado;
use Illuminate\Database\Eloquent\Collection;

interface GradoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Grado;

    public function create(array $data): Grado;

    public function update(int $id, array $data): ?Grado;

    public function delete(int $id): bool;
}