<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoSanguineoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Grupo' => 'required|in:O,A,B,AB',
            'RH' => 'required|in:POSITIVO,NEGATIVO',
        ];
    }
}