<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Grado' => [
                'required',
                'string',
                'max:150'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Grado.required' =>
                'El nombre del grado académico es obligatorio.',

            'Nombre_Grado.string' =>
                'El nombre del grado académico debe ser un texto.',

            'Nombre_Grado.max' =>
                'El nombre del grado académico no puede superar los 150 caracteres.'
        ];
    }
}
