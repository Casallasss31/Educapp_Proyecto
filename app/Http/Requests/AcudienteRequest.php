<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcudienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $obligatorio = $this->isMethod('post')
            ? 'required'
            : 'sometimes';

        return [
            'Id_usuario' => [
                $obligatorio,
                'integer',
                'exists:usuarios,Id_usuario'
            ],

            'Id_Profesion' => [
                'nullable',
                'integer',
                'exists:profesion,Id_Profesion'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Id_usuario.required' =>
                'El usuario es obligatorio.',

            'Id_usuario.integer' =>
                'El ID del usuario debe ser un número entero.',

            'Id_usuario.exists' =>
                'El usuario seleccionado no existe.',

            'Id_Profesion.integer' =>
                'El ID de la profesión debe ser un número entero.',

            'Id_Profesion.exists' =>
                'La profesión seleccionada no existe.'
        ];
    }
}
