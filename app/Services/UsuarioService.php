<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UsuarioService
{
    protected UsuarioInterface $usuarioRepository;

    public function __construct(
        UsuarioInterface $usuarioRepository
    ) {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAll(): Collection
    {
        return $this->usuarioRepository->getAll();
    }

    public function findById(int $id): ?Usuario
    {
        return $this->usuarioRepository->findById($id);
    }

    public function create(array $data): Usuario
    {
        $data = $this->normalizarDatos($data);

        $this->validarDocumento(
            $data['Tipo_Documento'],
            (string) $data['Numero_Documento']
        );

        $this->validarCorreo($data['Correo']);

        return $this->usuarioRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Usuario {

        $usuario = $this->usuarioRepository->findById($id);

        if (!$usuario) {
            return null;
        }

        $data = $this->normalizarDatos($data);

        $tipoDocumento = $data['Tipo_Documento']
            ?? $usuario->Tipo_Documento;

        $numeroDocumento = $data['Numero_Documento']
            ?? $usuario->Numero_Documento;

        $this->validarDocumento(
            $tipoDocumento,
            (string) $numeroDocumento,
            $id
        );

        if (isset($data['Correo'])) {
            $this->validarCorreo(
                $data['Correo'],
                $id
            );
        }

        return $this->usuarioRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $usuario = $this->usuarioRepository->findById($id);

        if (!$usuario) {
            return false;
        }

        try {
            return $this->usuarioRepository->delete($id);

        } catch (QueryException $exception) {

            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el usuario porque tiene registros asociados.'
                );
            }

            throw $exception;
        }
    }

    private function normalizarDatos(array $data): array
    {
        foreach (
            ['Nombres', 'Apellidos', 'Tipo_Documento']
            as $campo
        ) {
            if (isset($data[$campo])) {

                $data[$campo] = trim($data[$campo]);

                if ($data[$campo] === '') {
                    throw ValidationException::withMessages([
                        $campo => [
                            'Este campo no puede estar vacío.'
                        ]
                    ]);
                }
            }
        }

        // Normalizar correo

        if (isset($data['Correo'])) {
            $data['Correo'] = mb_strtolower(
                trim($data['Correo'])
            );
        }

        // Normalizar teléfono

        if (isset($data['Numero_Telefono'])) {
            $data['Numero_Telefono'] = trim(
                $data['Numero_Telefono']
            );
        }

        // Convertir password al campo de la base de datos

        if (isset($data['password'])) {

            $data['contraseña'] = $data['password'];

            unset($data['password']);
        }

        return $data;
    }

    private function validarDocumento(
        string $tipoDocumento,
        string $numeroDocumento,
        ?int $excludeId = null
    ): void {

        if (
            $this->usuarioRepository->existsByDocumento(
                $tipoDocumento,
                $numeroDocumento,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Numero_Documento' => [
                    'Ya existe un usuario registrado con este tipo y número de documento.'
                ]
            ]);
        }
    }

    private function validarCorreo(
        string $correo,
        ?int $excludeId = null
    ): void {

        if (
            $this->usuarioRepository->existsByCorreo(
                $correo,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Correo' => [
                    'Este correo electrónico ya se encuentra registrado.'
                ]
            ]);
        }
    }
}
