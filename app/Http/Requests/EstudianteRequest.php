<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Id_usuario' => 'required|integer|exists:usuarios,Id_usuario',
            'Id_acudiente' => 'required|integer|exists:acudiente,Id_Acudiente',
            'Id_Curso' => 'required|integer|exists:curso,Id_Curso',
        ];
    }
}