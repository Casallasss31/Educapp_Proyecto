<?php

namespace App\Interfaces;

use App\Models\Barrio;
use Illuminate\Database\Eloquent\Collection;

interface BarrioInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Barrio;

    public function create(array $data): Barrio;

    public function update(int $id, array $data): ?Barrio;

    public function delete(int $id): bool;
}