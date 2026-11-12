<?php

namespace App\Services;

use App\Interfaces\RectorInterface;
use App\Models\Rector;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class RectorService
{
    protected RectorInterface $rectorRepository;

    public function __construct(
        RectorInterface $rectorRepository
    ) {
        $this->rectorRepository = $rectorRepository;
    }

    public function getAll(): Collection
    {
        return $this->rectorRepository->getAll();
    }

    public function findById(int $id): ?Rector
    {
        return $this->rectorRepository->findById($id);
    }

    public function create(array $data): Rector
    {
        if (
            $this->rectorRepository->existsById(
                $data['Id_Rector']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_Rector' => [
                    'Este identificador de rector ya existe.'
                ]
            ]);
        }

        $this->validarUsuarioRector(
            $data['Id_usuario']
        );

        $this->validarUsuarioDuplicado(
            $data['Id_usuario']
        );

        return $this->rectorRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Rector {
        $rector = $this->rectorRepository->findById($id);

        if (!$rector) {
            return null;
        }

        if (isset($data['Id_usuario'])) {
            $this->validarUsuarioRector(
                $data['Id_usuario']
            );

            $this->validarUsuarioDuplicado(
                $data['Id_usuario'],
                $id
            );
        }

        return $this->rectorRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $rector = $this->rectorRepository->findById($id);

        if (!$rector) {
            return false;
        }

        try {
            return $this->rectorRepository->delete($id);
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el rector porque tiene registros asociados.'
                );
            }

            throw $exception;
        }
    }

    private function validarUsuarioRector(
        int $idUsuario
    ): void {
        $usuario = $this->rectorRepository->findUsuario(
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
            trim($usuario->rol->Tipo) !== 'RECTOR'
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'El usuario seleccionado no tiene el rol RECTOR.'
                ]
            ]);
        }
    }

    private function validarUsuarioDuplicado(
        int $idUsuario,
        ?int $excludeId = null
    ): void {
        if (
            $this->rectorRepository->existsByUsuario(
                $idUsuario,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'Este usuario ya está registrado como rector.'
                ]
            ]);
        }
    }
}
