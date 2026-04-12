<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProvinciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prefijo' => 'required|string',
            'pais_id' => 'required|integer|exists:pais,id',
            'departamento_id' => [
                'required',
                'integer',
                Rule::exists('departamentos', 'id')->where('pais_id', $this->input('pais_id')),
            ],
            'coordena' => 'required|string',
            'zoom' => 'required|string',
        ];
    }
}
