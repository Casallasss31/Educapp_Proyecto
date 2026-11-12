<?php

namespace App\Services;

use App\Interfaces\TipoCertificadoInterface;
use App\Models\TipoCertificado;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class TipoCertificadoService
{
    protected TipoCertificadoInterface $tipoCertificadoRepository;

    public function __construct(
        TipoCertificadoInterface $tipoCertificadoRepository
    ) {
        $this->tipoCertificadoRepository = $tipoCertificadoRepository;
    }

    public function getAll(): Collection
    {
        return $this->tipoCertificadoRepository->getAll();
    }

    public function findById(int $id): ?TipoCertificado
    {
        return $this->tipoCertificadoRepository->findById($id);
    }

    public function create(array $data): TipoCertificado
    {
        $data['Nombre_Certificado'] = trim(
            $data['Nombre_Certificado']
        );

        if ($data['Nombre_Certificado'] === '') {
            throw ValidationException::withMessages([
                'Nombre_Certificado' => [
                    'El nombre del tipo de certificado no puede estar vacío.'
                ]
            ]);
        }

        if (
            $this->tipoCertificadoRepository->existsByNombre(
                $data['Nombre_Certificado']
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Certificado' => [
                    'Este tipo de certificado ya se encuentra registrado.'
                ]
            ]);
        }

        return $this->tipoCertificadoRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?TipoCertificado {
        $tipoCertificado = $this->tipoCertificadoRepository->findById($id);

        if (!$tipoCertificado) {
            return null;
        }

        if (isset($data['Nombre_Certificado'])) {
            $data['Nombre_Certificado'] = trim(
                $data['Nombre_Certificado']
            );

            if ($data['Nombre_Certificado'] === '') {
                throw ValidationException::withMessages([
                    'Nombre_Certificado' => [
                        'El nombre del tipo de certificado no puede estar vacío.'
                    ]
                ]);
            }

            if (
                $this->tipoCertificadoRepository->existsByNombre(
                    $data['Nombre_Certificado'],
                    $id
                )
            ) {
                throw ValidationException::withMessages([
                    'Nombre_Certificado' => [
                        'Ya existe otro tipo de certificado con este nombre.'
                    ]
                ]);
            }
        }

        return $this->tipoCertificadoRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $tipoCertificado = $this->tipoCertificadoRepository->findById($id);

        if (!$tipoCertificado) {
            return false;
        }

        if ($this->tipoCertificadoRepository->hasCertificados($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el tipo de certificado porque tiene certificados asociados.'
            );
        }

        return $this->tipoCertificadoRepository->delete($id);
    }
}
