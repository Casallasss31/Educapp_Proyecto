<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarrioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Barrio' => [
                'required',
                'string',
                'max:150'
            ],
            'Id_localidad' => [
                'required',
                'integer',
                'exists:localidad,Id_Localidad'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Barrio.required' =>
                'El nombre del barrio es obligatorio.',

            'Nombre_Barrio.string' =>
                'El nombre del barrio debe ser un texto.',

            'Nombre_Barrio.max' =>
                'El nombre del barrio no puede superar los 150 caracteres.',

            'Id_localidad.required' =>
                'La localidad es obligatoria.',

            'Id_localidad.integer' =>
                'El ID de la localidad debe ser un número entero.',

            'Id_localidad.exists' =>
                'La localidad seleccionada no existe.'
        ];
    }
}
