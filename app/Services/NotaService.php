<?php

namespace App\Services;

use App\Interfaces\NotaInterface;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class NotaService
{
    protected NotaInterface $notaRepository;

    public function __construct(
        NotaInterface $notaRepository
    ) {
        $this->notaRepository = $notaRepository;
    }

    public function getAll(): Collection
    {
        return $this->notaRepository->getAll();
    }

    public function findById(int $id): ?Nota
    {
        return $this->notaRepository->findById($id);
    }

    private function clasificarNota(float $valor): string
    {
        return match (true) {
            $valor >= 1.0 && $valor <= 3.4 => 'Bajo',

            $valor >= 3.5 && $valor <= 3.9 => 'Básico',

            $valor >= 4.0 && $valor <= 4.5 => 'Alto',

            $valor >= 4.6 && $valor <= 5.0 => 'Superior',

            default => throw ValidationException::withMessages([
                'Valor_Nota' => [
                    'El valor de la nota no es valido.'
                ]
            ])
        };
    }

    private function prepararNota(array $data): array
    {
        $datos = Validator::make($data, [
            'Valor_Nota' => [
                'required',
                'numeric',
                'min:1',
                'max:5',
                'decimal:0,1'
            ]
        ])->validate();

        $valor = (float) $datos['Valor_Nota'];

        return [
            'Valor_Nota' => $valor,
            'Nombre_Nota' => $this->clasificarNota($valor)
        ];
    }

    public function create(array $data): Nota
    {
        $data = $this->prepararNota($data);

        return $this->notaRepository->create($data);
    }

    public function update(int $id, array $data): ?Nota
    {
        $nota = $this->notaRepository->findById($id);

        if (!$nota) {
            return null;
        }

        $data = $this->prepararNota($data);

        return $this->notaRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $nota = $this->notaRepository->findById($id);

        if (!$nota) {
            return false;
        }

        if ($this->notaRepository->hasMaterias($id)) {
            throw new ConflictHttpException(
                'No se puede eliminar la nota porque tiene materias asociadas.'
            );
        }

        try {
            return $this->notaRepository->delete($id);

        } catch (QueryException $e) {

            if ((int) ($e->errorInfo[1] ?? 0) === 1451) {
                throw new ConflictHttpException(
                    'No se puede eliminar la nota porque tiene registros asociados.'
                );
            }

            throw $e;
        }
    }
}
