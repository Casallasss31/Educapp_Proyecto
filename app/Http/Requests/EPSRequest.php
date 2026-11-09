<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EPSRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Eps' => 'required|string|max:150',
        ];
    }
}