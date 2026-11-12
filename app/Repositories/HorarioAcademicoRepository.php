<?php

namespace App\Repositories;

use App\Interfaces\HorarioAcademicoInterface;
use App\Models\HorarioAcademico;
use Illuminate\Database\Eloquent\Collection;

class HorarioAcademicoRepository implements HorarioAcademicoInterface
{
    public function getAll(): Collection
    {
        return HorarioAcademico::with([
            'curso.grado',
            'curso.docente',
            'materia.area'
        ])
            ->orderBy('Id_curso')
            ->orderBy('Hora_inicio')
            ->get();
    }

    public function findById(int $id): ?HorarioAcademico
    {
        return HorarioAcademico::with([
            'curso.grado',
            'curso.docente',
            'materia.area'
        ])->find($id);
    }

    public function create(array $data): HorarioAcademico
    {
        $horario = HorarioAcademico::create($data);

        return $horario->load([
            'curso.grado',
            'curso.docente',
            'materia.area'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?HorarioAcademico {
        $horario = HorarioAcademico::find($id);

        if (!$horario) {
            return null;
        }

        $horario->update($data);

        return $horario->refresh()->load([
            'curso.grado',
            'curso.docente',
            'materia.area'
        ]);
    }

    public function delete(int $id): bool
    {
        $horario = HorarioAcademico::find($id);

        if (!$horario) {
            return false;
        }

        return (bool) $horario->delete();
    }

    public function existsOverlap(
        int $idCurso,
        string $dia,
        string $horaInicio,
        string $horaFinal,
        ?int $excludeId = null
    ): bool {
        return HorarioAcademico::where(
            'Id_curso',
            $idCurso
        )
            ->whereRaw(
                'LOWER(TRIM(Dias_semana)) = ?',
                [mb_strtolower(trim($dia))]
            )
            ->where('Hora_inicio', '<', $horaFinal)
            ->where('Horario_final', '>', $horaInicio)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Horario_Academico',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function getByCurso(
        int $idCurso
    ): Collection {
        return HorarioAcademico::with([
            'curso.grado',
            'curso.docente',
            'materia.area'
        ])
            ->where('Id_curso', $idCurso)
            ->orderByRaw(
                "FIELD(TRIM(Dias_semana),
                    'Lunes',
                    'Martes',
                    'Miercoles',
                    'Miércoles',
                    'Jueves',
                    'Viernes')"
            )
            ->orderBy('Hora_inicio')
            ->get();
    }
}
