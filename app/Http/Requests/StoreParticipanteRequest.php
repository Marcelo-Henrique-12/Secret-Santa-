<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParticipanteRequest extends FormRequest
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
            'nome' => 'required|max:255|min:3',
            'email' => ['required','nullable', 'max:255', 'min:3', Rule::unique('participantes'), 'regex:/^[a-zA-Z-0-9-@_.-]+@[a-zA-Z.]+$/i'],
            'user_id'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',

        ];
    }
}
