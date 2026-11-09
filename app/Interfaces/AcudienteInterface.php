<?php

namespace App\Interfaces;

use App\Models\Acudiente;
use Illuminate\Database\Eloquent\Collection;

interface AcudienteInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Acudiente;

    public function create(array $data): Acudiente;

    public function update(int $id, array $data): ?Acudiente;

    public function delete(int $id): bool;
}