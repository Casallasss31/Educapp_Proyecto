<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsistenteAdministrativoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Id_Asistente_Administrativo' => $creacion
                ? [
                    'required',
                    'integer',
                    'min:1',
                    'max:2147483647',
                    'unique:asistente_administrativo,Id_Asistente_Administrativo'
                ]
                : ['prohibited'],

            'Id_usuario' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:usuarios,Id_usuario'
            ],

            'Id_profesion' => [
                'nullable',
                'integer',
                'exists:profesion,Id_Profesion'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Asistente_Administrativo.required' =>
                'El identificador del asistente administrativo es obligatorio.',

            'Id_Asistente_Administrativo.integer' =>
                'El identificador debe ser un número entero.',

            'Id_Asistente_Administrativo.min' =>
                'El identificador debe ser mayor que cero.',

            'Id_Asistente_Administrativo.max' =>
                'El identificador supera el límite permitido.',

            'Id_Asistente_Administrativo.unique' =>
                'Este identificador ya está registrado.',

            'Id_Asistente_Administrativo.prohibited' =>
                'No se permite modificar el identificador del asistente administrativo.',

            'Id_usuario.required' =>
                'El usuario es obligatorio.',

            'Id_usuario.integer' =>
                'El identificador del usuario debe ser un número entero.',

            'Id_usuario.exists' =>
                'El usuario seleccionado no existe.',

            'Id_profesion.integer' =>
                'El identificador de la profesión debe ser un número entero.',

            'Id_profesion.exists' =>
                'La profesión seleccionada no existe.'
        ];
    }
}
