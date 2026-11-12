<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Año' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'between:1900,' . date('Y')
            ],

            'Nombre_Certificado' => [
                $creacion ? 'required' : 'sometimes',
                'string',
                'max:150',
                'not_regex:/^\s*$/u'
            ],

            'Id_Tipo_Certificado' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:tipo_certificado,Id_Tipo_Certificado'
            ],

            'Id_estudiante' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:estudiante,Id_Estudiante'
            ],

            'Id_Certificado' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Año.required' =>
                'El año del certificado es obligatorio.',

            'Año.integer' =>
                'El año debe ser un número entero.',

            'Año.between' =>
                'El año debe estar entre 1900 y el año actual.',

            'Nombre_Certificado.required' =>
                'El nombre del certificado es obligatorio.',

            'Nombre_Certificado.string' =>
                'El nombre del certificado debe ser texto.',

            'Nombre_Certificado.max' =>
                'El nombre no puede superar los 150 caracteres.',

            'Nombre_Certificado.not_regex' =>
                'El nombre del certificado no puede contener solo espacios.',

            'Id_Tipo_Certificado.required' =>
                'El tipo de certificado es obligatorio.',

            'Id_Tipo_Certificado.integer' =>
                'El identificador del tipo debe ser un número entero.',

            'Id_Tipo_Certificado.exists' =>
                'El tipo de certificado seleccionado no existe.',

            'Id_estudiante.required' =>
                'El estudiante es obligatorio.',

            'Id_estudiante.integer' =>
                'El identificador del estudiante debe ser un número entero.',

            'Id_estudiante.exists' =>
                'El estudiante seleccionado no existe.',

            'Id_Certificado.prohibited' =>
                'No se permite enviar ni modificar el identificador del certificado.'
        ];
    }
}
