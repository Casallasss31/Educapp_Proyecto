<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Fecha_Matricula' => 'required|date',
            'Id_estudiante' => 'required|integer|exists:estudiante,Id_Estudiante',
        ];
    }
}