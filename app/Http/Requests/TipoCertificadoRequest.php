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
            'Nombre_Certificado' => 'required|string|max:150',
        ];
    }
}