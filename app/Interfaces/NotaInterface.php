<?php

namespace App\Interfaces;

use App\Models\Nota;
use Illuminate\Database\Eloquent\Collection;

interface NotaInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Nota;

    public function create(array $data): Nota;

    public function update(int $id, array $data): ?Nota;

    public function delete(int $id): bool;
}