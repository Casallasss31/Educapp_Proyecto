<?php

namespace App\Interfaces;

use App\Models\Boletin;
use Illuminate\Database\Eloquent\Collection;

interface BoletinInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Boletin;

    public function create(array $data): Boletin;

    public function update(int $id, array $data): ?Boletin;

    public function delete(int $id): bool;
}