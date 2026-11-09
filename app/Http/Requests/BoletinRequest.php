<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoletinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Fecha_publicacion' => 'required|date',
            'Periodo' => 'required|in:1,2,3',
            'Observacion' => 'nullable|string|max:255',
            'Id_materia' => 'required|integer|exists:materia,Id_Materia',
            'Id_estudiante' => 'required|integer|exists:estudiante,Id_Estudiante',
        ];
    }
}