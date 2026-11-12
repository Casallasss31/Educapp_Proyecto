<?php

namespace App\Services;

use App\Interfaces\EstudianteInterface;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class EstudianteService
{
    protected EstudianteInterface $estudianteRepository;

    public function __construct(
        EstudianteInterface $estudianteRepository
    ) {
        $this->estudianteRepository = $estudianteRepository;
    }

    public function getAll(): Collection
    {
        return $this->estudianteRepository->getAll();
    }

    public function findById(int $id): ?Estudiante
    {
        return $this->estudianteRepository->findById($id);
    }

    public function create(array $data): Estudiante
    {
        if (
            $this->estudianteRepository->existsById(
                $data['Id_Estudiante']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_Estudiante' => [
                    'Este identificador de estudiante ya existe.'
                ]
            ]);
        }

        $this->validarUsuarioEstudiante(
            $data['Id_usuario']
        );

        $this->validarUsuarioDuplicado(
            $data['Id_usuario']
        );

        return $this->estudianteRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Estudiante {
        $estudiante = $this->estudianteRepository->findById(
            $id
        );

        if (!$estudiante) {
            return null;
        }

        if (isset($data['Id_usuario'])) {
            $this->validarUsuarioEstudiante(
                $data['Id_usuario']
            );

            $this->validarUsuarioDuplicado(
                $data['Id_usuario'],
                $id
            );
        }

        return $this->estudianteRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $estudiante = $this->estudianteRepository->findById(
            $id
        );

        if (!$estudiante) {
            return false;
        }

        if ($this->estudianteRepository->hasMatriculas($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el estudiante porque tiene matrículas asociadas.'
            );
        }

        try {
            return $this->estudianteRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el estudiante porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarUsuarioEstudiante(
        int $idUsuario
    ): void {
        $usuario = $this->estudianteRepository->findUsuario(
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
            trim($usuario->rol->Tipo) !== 'ESTUDIANTE'
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'El usuario seleccionado no tiene el rol ESTUDIANTE.'
                ]
            ]);
        }
    }

    private function validarUsuarioDuplicado(
        int $idUsuario,
        ?int $excludeId = null
    ): void {
        if (
            $this->estudianteRepository->existsByUsuario(
                $idUsuario,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'Este usuario ya está registrado como estudiante.'
                ]
            ]);
        }
    }
}
