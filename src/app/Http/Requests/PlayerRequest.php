<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:3|required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Name too short',
            'name.required' => 'Name is required',
        ];
    }
}
