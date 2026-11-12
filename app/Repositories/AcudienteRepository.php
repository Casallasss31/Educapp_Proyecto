<?php

namespace App\Repositories;

use App\Interfaces\AcudienteInterface;
use App\Models\Acudiente;
use Illuminate\Database\Eloquent\Collection;

class AcudienteRepository implements AcudienteInterface
{
    public function getAll(): Collection
    {
        return Acudiente::with([
            'usuario',
            'profesion'
        ])->get();
    }

    public function findById(int $id): ?Acudiente
    {
        return Acudiente::with([
            'usuario',
            'profesion',
            'estudiantes'
        ])->find($id);
    }

    public function create(array $data): Acudiente
    {
        $acudiente = Acudiente::create($data);

        return $acudiente->load([
            'usuario',
            'profesion'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Acudiente {
        $acudiente = Acudiente::find($id);

        if (!$acudiente) {
            return null;
        }

        $acudiente->update($data);

        return $acudiente->refresh()->load([
            'usuario',
            'profesion'
        ]);
    }

    public function delete(int $id): bool
    {
        $acudiente = Acudiente::find($id);

        if (!$acudiente) {
            return false;
        }

        return (bool) $acudiente->delete();
    }

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool {
        return Acudiente::where(
            'Id_usuario',
            $idUsuario
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Acudiente',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasEstudiantes(int $id): bool
    {
        return Acudiente::whereKey($id)
            ->whereHas('estudiantes')
            ->exists();
    }
}
