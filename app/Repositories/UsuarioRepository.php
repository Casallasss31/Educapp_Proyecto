<?php

namespace App\Repositories;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class UsuarioRepository implements UsuarioInterface
{
    public function getAll(): Collection
    {
        return Usuario::with([
            'rol',
            'eps',
            'grupoSanguineo',
            'barrio'
        ])->get();
    }

    public function findById(int $id): ?Usuario
    {
        return Usuario::with([
            'rol',
            'eps',
            'grupoSanguineo',
            'barrio'
        ])->find($id);
    }

    public function create(array $data): Usuario
    {
        $usuario = Usuario::create($data);

        return $usuario->load([
            'rol',
            'eps',
            'grupoSanguineo',
            'barrio'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Usuario {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return null;
        }

        $usuario->update($data);

        return $usuario->refresh()->load([
            'rol',
            'eps',
            'grupoSanguineo',
            'barrio'
        ]);
    }

    public function delete(int $id): bool
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return false;
        }

        return (bool) $usuario->delete();
    }

    public function existsByDocumento(
        string $tipoDocumento,
        string $numeroDocumento,
        ?int $excludeId = null
    ): bool {
        return Usuario::where(
            'Tipo_Documento',
            $tipoDocumento
        )
            ->where(
                'Numero_Documento',
                $numeroDocumento
            )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_usuario',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function existsByCorreo(
        string $correo,
        ?int $excludeId = null
    ): bool {
        return Usuario::where(
            'Correo_Electronico',
            $correo
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_usuario',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }
}
