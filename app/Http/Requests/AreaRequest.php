<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Area' => [
                'required',
                'string',
                'max:150'
            ],
            'Descripcion_Area' => [
                'nullable',
                'string'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Area.required' =>
                'El nombre del área es obligatorio.',

            'Nombre_Area.string' =>
                'El nombre del área debe ser un texto.',

            'Nombre_Area.max' =>
                'El nombre del área no puede superar los 150 caracteres.',

            'Descripcion_Area.string' =>
                'La descripción del área debe ser un texto.'
        ];
    }
}
