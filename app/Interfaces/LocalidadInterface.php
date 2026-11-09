<?php

namespace App\Interfaces;

use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;

interface LocalidadInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Localidad;

    public function create(array $data): Localidad;

    public function update(int $id, array $data): ?Localidad;

    public function delete(int $id): bool;
}