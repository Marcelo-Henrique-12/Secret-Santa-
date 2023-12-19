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
            'nome' => 'required|max:30|',
            'descricao'=> 'max:100',
            'participantes_selecionados'=> 'required|min:2',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do sorteio é obrigatório',
            'nome.max' => 'Digite no máximo 30 dígitos',
            'descricao.max'=>'Digite no máximo 100 dígitos',
            'participantes_selecionados.required' => 'Selecione os participantes',
            'participantes_selecionados.min' => 'Mínimo de 2 participantes'
        ];
    }
}
