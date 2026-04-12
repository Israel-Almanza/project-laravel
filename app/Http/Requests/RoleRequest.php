<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'administrador' => ['required', 'array', 'min:1'],
            'administrador.*' => ['string', Rule::in(['Coordinador', 'Home', 'Soporte'])],
            'representante' => ['required', 'array', 'min:1'],
            'representante.*' => ['string', Rule::in(['Home', 'Dashboard'])],
        ];
    }
}
