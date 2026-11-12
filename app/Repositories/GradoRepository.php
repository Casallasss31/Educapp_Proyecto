<?php

namespace App\Repositories;

use App\Interfaces\GradoInterface;
use App\Models\Grado;
use Illuminate\Database\Eloquent\Collection;

class GradoRepository implements GradoInterface
{
    public function getAll(): Collection
    {
        return Grado::all();
    }

    public function findById(int $id): ?Grado
    {
        return Grado::find($id);
    }

    public function create(array $data): Grado
    {
        return Grado::create($data);
    }

    public function update(int $id, array $data): ?Grado
    {
        $grado = Grado::find($id);

        if (!$grado) {
            return null;
        }

        $grado->update($data);

        return $grado->refresh();
    }

    public function delete(int $id): bool
    {
        $grado = Grado::find($id);

        if (!$grado) {
            return false;
        }

        return (bool) $grado->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return Grado::where('Nombre_Grado', $nombre)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Grado',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasCursos(int $id): bool
    {
        return Grado::whereKey($id)
            ->whereHas('cursos')
            ->exists();
    }
}
