<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Tipo' => 'required|string|max:100|in:RECTOR,ASISTENTE ADMINISTRATIVO,ESTUDIANTE,ACUDIENTE,DOCENTE',
        ];
    }

    public function messages(): array
    {
        return [
            'Tipo.required' => 'El tipo de rol es obligatorio.',
            'Tipo.string' => 'El tipo de rol debe ser un texto.',
            'Tipo.max' => 'El tipo de rol no puede superar los 100 caracteres.',
            'Tipo.in' => 'El tipo de rol seleccionado no es válido.'
        ];
    }
}
