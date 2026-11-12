<?php

namespace App\Services;

use App\Interfaces\CertificadoInterface;
use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class CertificadoService
{
    protected CertificadoInterface $certificadoRepository;

    public function __construct(
        CertificadoInterface $certificadoRepository
    ) {
        $this->certificadoRepository = $certificadoRepository;
    }

    public function getAll(): Collection
    {
        return $this->certificadoRepository->getAll();
    }

    public function findById(int $id): ?Certificado
    {
        return $this->certificadoRepository->findById($id);
    }

    public function getByEstudiante(
        int $idEstudiante
    ): Collection {
        return $this->certificadoRepository->getByEstudiante(
            $idEstudiante
        );
    }

    public function create(array $data): Certificado
    {
        $data['Nombre_Certificado'] = trim(
            $data['Nombre_Certificado']
        );

        $this->validarNombre(
            $data['Nombre_Certificado']
        );

        $this->validarAnio(
            (int) $data['Año']
        );

        $this->validarDuplicado(
            $data['Nombre_Certificado'],
            (int) $data['Año'],
            (int) $data['Id_Tipo_Certificado'],
            (int) $data['Id_estudiante']
        );

        return $this->certificadoRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?Certificado {
        $certificado = $this->certificadoRepository->findById(
            $id
        );

        if (!$certificado) {
            return null;
        }

        $nombre = array_key_exists(
            'Nombre_Certificado',
            $data
        )
            ? trim($data['Nombre_Certificado'])
            : $certificado->Nombre_Certificado;

        $anio = $data['Año']
            ?? $certificado->{'Año'};

        $idTipo = $data['Id_Tipo_Certificado']
            ?? $certificado->Id_Tipo_Certificado;

        $idEstudiante = $data['Id_estudiante']
            ?? $certificado->Id_estudiante;

        $this->validarNombre($nombre);

        $this->validarAnio((int) $anio);

        $this->validarDuplicado(
            $nombre,
            (int) $anio,
            (int) $idTipo,
            (int) $idEstudiante,
            $id
        );

        if (array_key_exists('Nombre_Certificado', $data)) {
            $data['Nombre_Certificado'] = $nombre;
        }

        return $this->certificadoRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        return $this->certificadoRepository->delete(
            $id
        );
    }

    private function validarNombre(
        string $nombre
    ): void {
        if (trim($nombre) === '') {
            throw ValidationException::withMessages([
                'Nombre_Certificado' => [
                    'El nombre del certificado no puede estar vacío.'
                ]
            ]);
        }
    }

    private function validarAnio(
        int $anio
    ): void {
        $anioActual = (int) date('Y');

        if ($anio < 1900 || $anio > $anioActual) {
            throw ValidationException::withMessages([
                'Año' => [
                    'El año debe estar entre 1900 y el año actual.'
                ]
            ]);
        }
    }

    private function validarDuplicado(
        string $nombre,
        int $anio,
        int $idTipo,
        int $idEstudiante,
        ?int $excludeId = null
    ): void {
        if (
            $this->certificadoRepository->existsByDetails(
                $nombre,
                $anio,
                $idTipo,
                $idEstudiante,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Nombre_Certificado' => [
                    'Este certificado ya existe para el estudiante, tipo y año seleccionados.'
                ]
            ]);
        }
    }
}
