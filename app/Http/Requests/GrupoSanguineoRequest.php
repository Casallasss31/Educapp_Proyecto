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
            'Grupo' => 'required|string|in:O,A,B,AB',
            'RH' => 'required|string|in:POSITIVO,NEGATIVO'
        ];
    }

    public function messages(): array
    {
        return [
            'Grupo.required' => 'El grupo sanguíneo es obligatorio.',
            'Grupo.string' => 'El grupo sanguíneo debe ser un texto.',
            'Grupo.in' => 'El grupo sanguíneo debe ser O, A, B o AB.',

            'RH.required' => 'El factor RH es obligatorio.',
            'RH.string' => 'El factor RH debe ser un texto.',
            'RH.in' => 'El factor RH debe ser POSITIVO o NEGATIVO.'
        ];
    }
}
