<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSorteioRequest extends FormRequest
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
    public function rules()
    {
        return [
            'ano' => 'required|max:4|min:4'
        ];
    }

    public function messages()
    {
        return [
            'ano.required' => 'O ano é obrigatório',
            'ano.max' => 'Digite 4 digitos, exemplo 2023',
            'ano.min' => 'Digite 4 digitos, exemplo 2023'
    
        ];
    }
}
