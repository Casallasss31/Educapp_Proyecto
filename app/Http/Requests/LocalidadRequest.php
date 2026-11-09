<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Localidad' => 'required|string|max:100',
        ];
    }
}