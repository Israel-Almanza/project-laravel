<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MunicipioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prefijo' => 'required|string',
            'nombre' => 'required|string',
            'pais_id' => 'required|integer|exists:pais,id',
            'departamento_id' => [
                'required',
                'integer',
                Rule::exists('departamentos', 'id')->where('pais_id', $this->input('pais_id')),
            ],
            'provincia_id' => [
                'required',
                'integer',
                Rule::exists('provincias', 'id')
                    ->where('departamento_id', $this->input('departamento_id'))
                    ->where('pais_id', $this->input('pais_id')),
            ],
            'coordenadas' => 'required|string',
            'zoom' => 'required|string',
        ];
    }
}
