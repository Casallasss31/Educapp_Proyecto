<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Id_Localidad' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'integer',
                'min:1'
            ],
            'Nombre_Localidad' => [
                'required',
                'string',
                'max:150'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Localidad.required' => 'El ID de la localidad es obligatorio.',
            'Id_Localidad.integer' => 'El ID de la localidad debe ser un número entero.',
            'Id_Localidad.min' => 'El ID de la localidad debe ser mayor que cero.',

            'Nombre_Localidad.required' => 'El nombre de la localidad es obligatorio.',
            'Nombre_Localidad.string' => 'El nombre de la localidad debe ser un texto.',
            'Nombre_Localidad.max' => 'El nombre de la localidad no puede superar los 150 caracteres.'
        ];
    }
}
