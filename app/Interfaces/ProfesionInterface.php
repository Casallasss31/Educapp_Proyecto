<?php

namespace App\Interfaces;

use App\Models\Profesion;
use Illuminate\Database\Eloquent\Collection;

interface ProfesionInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Profesion;

    public function create(array $data): Profesion;

    public function update(int $id, array $data): ?Profesion;

    public function delete(int $id): bool;
}