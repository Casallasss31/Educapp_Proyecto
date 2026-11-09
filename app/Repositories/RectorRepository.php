<?php

namespace App\Repositories;

use App\Interfaces\RectorInterface;
use App\Models\Rector;
use Illuminate\Database\Eloquent\Collection;

class RectorRepository implements RectorInterface
{
    public function getAll(): Collection
    {
        return Rector::all();
    }

    public function findById(int $id): ?Rector
    {
        return Rector::find($id);
    }

    public function create(array $data): Rector
    {
        return Rector::create($data);
    }

    public function update(int $id, array $data): ?Rector
    {
        $rector = Rector::find($id);

        if (!$rector) {
            return null;
        }

        $rector->update($data);

        return $rector;
    }

    public function delete(int $id): bool
    {
        $rector = Rector::find($id);

        if (!$rector) {
            return false;
        }

        return (bool) $rector->delete();
    }
}