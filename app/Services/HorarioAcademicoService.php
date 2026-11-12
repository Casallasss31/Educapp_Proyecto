<?php

namespace App\Services;

use App\Interfaces\HorarioAcademicoInterface;
use App\Models\HorarioAcademico;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class HorarioAcademicoService
{
    protected HorarioAcademicoInterface $horarioRepository;

    public function __construct(
        HorarioAcademicoInterface $horarioRepository
    ) {
        $this->horarioRepository = $horarioRepository;
    }

    public function getAll(): Collection
    {
        return $this->horarioRepository->getAll();
    }

    public function findById(int $id): ?HorarioAcademico
    {
        return $this->horarioRepository->findById($id);
    }

    public function getByCurso(int $idCurso): Collection
    {
        return $this->horarioRepository->getByCurso(
            $idCurso
        );
    }

    public function create(array $data): HorarioAcademico
    {
        $data['Dias_semana'] = $this->normalizarDia(
            $data['Dias_semana']
        );

        $this->validarHoras(
            $data['Hora_inicio'],
            $data['Horario_final']
        );

        $this->validarSuperposicion(
            (int) $data['Id_curso'],
            $data['Dias_semana'],
            $data['Hora_inicio'],
            $data['Horario_final']
        );

        return $this->horarioRepository->create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?HorarioAcademico {
        $horario = $this->horarioRepository->findById(
            $id
        );

        if (!$horario) {
            return null;
        }

        $dia = $this->normalizarDia(
            $data['Dias_semana']
                ?? $horario->Dias_semana
        );

        $horaInicio = $data['Hora_inicio']
            ?? $horario->Hora_inicio;

        $horaFinal = $data['Horario_final']
            ?? $horario->Horario_final;

        $idCurso = (int) (
            $data['Id_curso']
            ?? $horario->Id_curso
        );

        $this->validarHoras(
            $horaInicio,
            $horaFinal
        );

        $this->validarSuperposicion(
            $idCurso,
            $dia,
            $horaInicio,
            $horaFinal,
            $id
        );

        if (array_key_exists('Dias_semana', $data)) {
            $data['Dias_semana'] = $dia;
        }

        return $this->horarioRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $horario = $this->horarioRepository->findById(
            $id
        );

        if (!$horario) {
            return false;
        }

        try {
            return $this->horarioRepository->delete($id);
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el horario porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function normalizarDia(string $dia): string
    {
        $dia = mb_strtolower(trim($dia));

        $dias = [
            'lunes' => 'Lunes',
            'martes' => 'Martes',
            'miercoles' => 'Miercoles',
            'miércoles' => 'Miercoles',
            'jueves' => 'Jueves',
            'viernes' => 'Viernes'
        ];

        if (!array_key_exists($dia, $dias)) {
            throw ValidationException::withMessages([
                'Dias_semana' => [
                    'El día debe estar entre lunes y viernes.'
                ]
            ]);
        }

        return $dias[$dia];
    }

    private function validarHoras(
        string $horaInicio,
        string $horaFinal
    ): void {
        if ($horaFinal <= $horaInicio) {
            throw ValidationException::withMessages([
                'Horario_final' => [
                    'La hora de finalización debe ser posterior a la hora de inicio.'
                ]
            ]);
        }
    }

    private function validarSuperposicion(
        int $idCurso,
        string $dia,
        string $horaInicio,
        string $horaFinal,
        ?int $excludeId = null
    ): void {
        if (
            $this->horarioRepository->existsOverlap(
                $idCurso,
                $dia,
                $horaInicio,
                $horaFinal,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Hora_inicio' => [
                    'El curso ya tiene una clase programada en este intervalo de tiempo.'
                ]
            ]);
        }
    }
}
