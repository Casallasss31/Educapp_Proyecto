<?php

namespace App\Services;

use App\Interfaces\CursoInterface;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class CursoService
{
    protected CursoInterface $cursoRepository;

    public function __construct(
        CursoInterface $cursoRepository
    ) {
        $this->cursoRepository = $cursoRepository;
    }

    public function getAll(): Collection
    {
        return $this->cursoRepository->getAll();
    }

    public function findById(int $id): ?Curso
    {
        return $this->cursoRepository->findById($id);
    }

    public function create(array $data): Curso
    {
        if (
            $this->cursoRepository->existsById(
                $data['Id_Curso']
            )
        ) {
            throw ValidationException::withMessages([
                'Id_Curso' => [
                    'El identificador del curso ya existe.'
                ]
            ]);
        }

        $this->validarCursoDuplicado(
            $data['Id_grado'],
            $data['Año']
        );

        return $this->cursoRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Curso {
        $curso = $this->cursoRepository->findById($id);

        if (!$curso) {
            return null;
        }

        $idGrado = $data['Id_grado']
            ?? $curso->Id_grado;

        $anio = $data['Año']
            ?? $curso->{'Año'};

        if ($idGrado !== null && $anio !== null) {
            $this->validarCursoDuplicado(
                (int) $idGrado,
                (int) $anio,
                $id
            );
        }

        return $this->cursoRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $curso = $this->cursoRepository->findById($id);

        if (!$curso) {
            return false;
        }

        if ($this->cursoRepository->hasEstudiantes($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar el curso porque tiene estudiantes asociados.'
            );
        }

        try {
            return $this->cursoRepository->delete($id);
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el curso porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarCursoDuplicado(
        int $idGrado,
        int $anio,
        ?int $excludeId = null
    ): void {
        if (
            $this->cursoRepository->existsByGradoAndAnio(
                $idGrado,
                $anio,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_grado' => [
                    'Ya existe un curso para este grado y año académico.'
                ]
            ]);
        }
    }
}
