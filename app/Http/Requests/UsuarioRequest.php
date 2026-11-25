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
                'required',
                'string',
                'max:150'
            ],

            'Apellidos' => [
                $obligatorio,
                'required',
                'string',
                'max:150'
            ],

            'Tipo_Documento' => [
                $obligatorio,
                'required',
                'string',
                'max:100'
            ],

            'Numero_Documento' => [
                $obligatorio,
                'required',
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

            'Correo' => [
                $obligatorio,
                'required',
                'email',
                'max:150',
                Rule::unique('usuarios', 'Correo')->ignore(
                    $this->route('usuario') ?? $this->route('id'),
                    'Id_usuario'
                )
            ],

            'password' => [
                $obligatorio,
                'required',
                'string',
                'min:8',
                'max:72'
            ],

            'Numero_Telefono' => [
                'nullable',
                'string',
                'regex:/^[0-9]{7,20}$/'
            ],

            'Id_Rol' => [
                $obligatorio,
                'required',
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

            'Apellidos.required' =>
                'Los apellidos son obligatorios.',

            'Tipo_Documento.required' =>
                'El tipo de documento es obligatorio.',

            'Numero_Documento.required' =>
                'El número de documento es obligatorio.',

            'Numero_Documento.integer' =>
                'El número de documento debe ser entero.',

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

            'Correo.required' =>
                'El correo electrónico es obligatorio.',

            'Correo.email' =>
                'El correo electrónico no es válido.',

            'Correo.max' =>
                'El correo no puede superar los 150 caracteres.',

            'Correo.unique' =>
                'Este correo electrónico ya está registrado.',

            'password.required' =>
                'La contraseña es obligatoria.',

            'password.string' =>
                'La contraseña debe ser un texto.',

            'password.min' =>
                'La contraseña debe contener mínimo 8 caracteres.',

            'password.max' =>
                'La contraseña no puede superar los 72 caracteres.',

            'Numero_Telefono.string' =>
                'El número telefónico debe ser un texto.',

            'Numero_Telefono.regex' =>
                'El teléfono debe contener entre 7 y 20 dígitos.',

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
