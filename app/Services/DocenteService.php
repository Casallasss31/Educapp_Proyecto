<?php

namespace App\Services;

use App\Interfaces\DocenteInterface;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class DocenteService
{
    protected DocenteInterface $docenteRepository;

    public function __construct(
        DocenteInterface $docenteRepository
    ) {
        $this->docenteRepository = $docenteRepository;
    }

    public function getAll(): Collection
    {
        return $this->docenteRepository->getAll();
    }

    public function findById(int $id): ?Docente
    {
        return $this->docenteRepository->findById($id);
    }

    public function create(array $data): Docente
    {
        if (
            $this->docenteRepository->existsById(
                $data['Id_Docente']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_Docente' => [
                    'Este identificador de docente ya existe.'
                ]
            ]);
        }

        $this->validarUsuarioDocente(
            $data['Id_usuario']
        );

        $this->validarUsuarioDuplicado(
            $data['Id_usuario']
        );

        return $this->docenteRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Docente {
        $docente = $this->docenteRepository->findById($id);

        if (!$docente) {
            return null;
        }

        if (isset($data['Id_usuario'])) {
            $this->validarUsuarioDocente(
                $data['Id_usuario']
            );

            $this->validarUsuarioDuplicado(
                $data['Id_usuario'],
                $id
            );
        }

        return $this->docenteRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $docente = $this->docenteRepository->findById($id);

        if (!$docente) {
            return false;
        }

        if ($this->docenteRepository->hasCursos($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el docente porque tiene cursos asignados.'
            );
        }

        return $this->docenteRepository->delete($id);
    }

    private function validarUsuarioDocente(
        int $idUsuario
    ): void {
        $usuario = $this->docenteRepository->findUsuario(
            $idUsuario
        );

        if (!$usuario) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'El usuario seleccionado no existe.'
                ]
            ]);
        }

        if (
            !$usuario->rol ||
            trim($usuario->rol->Tipo) !== 'DOCENTE'
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'El usuario seleccionado no tiene el rol DOCENTE.'
                ]
            ]);
        }
    }

    private function validarUsuarioDuplicado(
        int $idUsuario,
        ?int $excludeId = null
    ): void {
        if (
            $this->docenteRepository->existsByUsuario(
                $idUsuario,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'Este usuario ya se encuentra registrado como docente.'
                ]
            ]);
        }
    }
}
