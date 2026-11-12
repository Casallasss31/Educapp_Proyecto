<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Id_Rector' => $creacion
                ? [
                    'required',
                    'integer',
                    'min:1',
                    'max:2147483647',
                    'unique:rector,Id_Rector'
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
            'Id_Rector.required' =>
                'El identificador del rector es obligatorio.',

            'Id_Rector.integer' =>
                'El identificador debe ser un número entero.',

            'Id_Rector.min' =>
                'El identificador debe ser mayor que cero.',

            'Id_Rector.max' =>
                'El identificador supera el límite permitido.',

            'Id_Rector.unique' =>
                'Este identificador ya está registrado.',

            'Id_Rector.prohibited' =>
                'No se permite modificar el identificador del rector.',

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
