<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
            'Nombres' => [
                $obligatorio,
                'string',
                'max:150'
            ],

            'Apellidos' => [
                $obligatorio,
                'string',
                'max:150'
            ],

            'Tipo_Documento' => [
                $obligatorio,
                'string',
                'max:100'
            ],

            'Numero_Documento' => [
                $obligatorio,
                'integer',
                'min:1',
                'max:2147483647'
            ],

            'Fecha_Nacimiento' => [
                'nullable',
                'date',
                'before_or_equal:today'
            ],

            'Genero' => [
                'nullable',
                'string',
                'in:Masculino,Femenino'
            ],

            'Correo_Electronico' => [
                'nullable',
                'email',
                'max:150',
                Rule::unique(
                    'usuarios',
                    'Correo_Electronico'
                )->ignore(
                    $this->route('usuario') ?? $this->route('id'),
                    'Id_usuario'
                )
            ],

            'Numero_Telefonico' => [
                'nullable',
                'string',
                'regex:/^[0-9]{7,20}$/'
            ],

            'Id_Rol' => [
                $obligatorio,
                'integer',
                'exists:rol,Id_Rol'
            ],

            'Id_EPS' => [
                'nullable',
                'integer',
                'exists:eps,Id_EPS'
            ],

            'Id_Grupo_Sanguineo' => [
                'nullable',
                'integer',
                'exists:grupo_sanguineo,Id_GRUPO_SANGUINEO'
            ],

            'Id_Barrio' => [
                'nullable',
                'integer',
                'exists:barrio,Id_Barrio'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombres.required' =>
                'Los nombres son obligatorios.',

            'Nombres.string' =>
                'Los nombres deben ser un texto.',

            'Nombres.max' =>
                'Los nombres no pueden superar los 150 caracteres.',

            'Apellidos.required' =>
                'Los apellidos son obligatorios.',

            'Apellidos.string' =>
                'Los apellidos deben ser un texto.',

            'Apellidos.max' =>
                'Los apellidos no pueden superar los 150 caracteres.',

            'Tipo_Documento.required' =>
                'El tipo de documento es obligatorio.',

            'Tipo_Documento.string' =>
                'El tipo de documento debe ser un texto.',

            'Tipo_Documento.max' =>
                'El tipo de documento no puede superar los 100 caracteres.',

            'Numero_Documento.required' =>
                'El número de documento es obligatorio.',

            'Numero_Documento.integer' =>
                'El número de documento debe ser un número entero.',

            'Numero_Documento.min' =>
                'El número de documento debe ser mayor que cero.',

            'Numero_Documento.max' =>
                'El número de documento supera el límite permitido.',

            'Fecha_Nacimiento.date' =>
                'La fecha de nacimiento no es válida.',

            'Fecha_Nacimiento.before_or_equal' =>
                'La fecha de nacimiento no puede ser futura.',

            'Genero.in' =>
                'El género seleccionado no es válido.',

            'Correo_Electronico.email' =>
                'El correo electrónico no tiene un formato válido.',

            'Correo_Electronico.max' =>
                'El correo no puede superar los 150 caracteres.',

            'Correo_Electronico.unique' =>
                'Este correo electrónico ya está registrado.',

            'Numero_Telefonico.string' =>
                'El número telefónico debe ser un texto.',

            'Numero_Telefonico.regex' =>
                'El número telefónico debe contener entre 7 y 20 dígitos numéricos.',

            'Id_Rol.required' =>
                'El rol es obligatorio.',

            'Id_Rol.exists' =>
                'El rol seleccionado no existe.',

            'Id_EPS.exists' =>
                'La EPS seleccionada no existe.',

            'Id_Grupo_Sanguineo.exists' =>
                'El grupo sanguíneo seleccionado no existe.',

            'Id_Barrio.exists' =>
                'El barrio seleccionado no existe.'
        ];
    }
}
