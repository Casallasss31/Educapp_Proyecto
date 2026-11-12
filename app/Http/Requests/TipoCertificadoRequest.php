<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoCertificadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Certificado' => [
                'required',
                'string',
                'max:150'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Certificado.required' =>
                'El nombre del tipo de certificado es obligatorio.',

            'Nombre_Certificado.string' =>
                'El nombre del tipo de certificado debe ser un texto.',

            'Nombre_Certificado.max' =>
                'El nombre del tipo de certificado no puede superar los 150 caracteres.'
        ];
    }
}
