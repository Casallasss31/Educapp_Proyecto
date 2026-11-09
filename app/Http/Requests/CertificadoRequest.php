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
        return [
            'Año' => 'required|integer|min:2000|max:2100',
            'Nombre_Certificado' => 'required|string|max:150',
            'Id_Tipo_Certificado' => 'required|integer|exists:tipo_certificado,Id_Tipo_Certificado',
            'Id_estudiante' => 'required|integer|exists:estudiante,Id_Estudiante',
        ];
    }
}