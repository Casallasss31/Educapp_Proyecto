<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Nota' => 'required|string|max:100',
            'nota' => 'required|numeric|between:1,5',
        ];
    }
}