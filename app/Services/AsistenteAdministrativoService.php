<?php

namespace App\Services;

use App\Interfaces\AsistenteAdministrativoInterface;
use App\Models\AsistenteAdministrativo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AsistenteAdministrativoService
{
    protected AsistenteAdministrativoInterface $asistenteRepository;

    public function __construct(
        AsistenteAdministrativoInterface $asistenteRepository
    ) {
        $this->asistenteRepository = $asistenteRepository;
    }

    public function getAll(): Collection
    {
        return $this->asistenteRepository->getAll();
    }

    public function findById(
        int $id
    ): ?AsistenteAdministrativo {
        return $this->asistenteRepository->findById(
            $id
        );
    }

    public function create(
        array $data
    ): AsistenteAdministrativo {
        if (
            $this->asistenteRepository->existsById(
                $data['Id_Asistente_Administrativo']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_Asistente_Administrativo' => [
                    'Este identificador de asistente administrativo ya existe.'
                ]
            ]);
        }

        $this->validarUsuarioAsistente(
            $data['Id_usuario']
        );

        $this->validarUsuarioDuplicado(
            $data['Id_usuario']
        );

        return $this->asistenteRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?AsistenteAdministrativo {
        $asistente = $this->asistenteRepository->findById(
            $id
        );

        if (!$asistente) {
            return null;
        }

        if (isset($data['Id_usuario'])) {
            $this->validarUsuarioAsistente(
                $data['Id_usuario']
            );

            $this->validarUsuarioDuplicado(
                $data['Id_usuario'],
                $id
            );
        }

        return $this->asistenteRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $asistente = $this->asistenteRepository->findById(
            $id
        );

        if (!$asistente) {
            return false;
        }

        try {
            return $this->asistenteRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el asistente administrativo porque tiene registros asociados.'
                );
            }

            throw $exception;
        }
    }

    private function validarUsuarioAsistente(
        int $idUsuario
    ): void {
        $usuario = $this->asistenteRepository->findUsuario(
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
            trim($usuario->rol->Tipo) !== 'ASISTENTE ADMINISTRATIVO'
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'El usuario seleccionado no tiene el rol ASISTENTE ADMINISTRATIVO.'
                ]
            ]);
        }
    }

    private function validarUsuarioDuplicado(
        int $idUsuario,
        ?int $excludeId = null
    ): void {
        if (
            $this->asistenteRepository->existsByUsuario(
                $idUsuario,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_usuario' => [
                    'Este usuario ya está registrado como asistente administrativo.'
                ]
            ]);
        }
    }
}
