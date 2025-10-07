<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'foto' => 'required|max:2048',
            'categoria' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string' => 'O campo Nome deve ser um texto.',
            'nome.max' => 'O campo Nome não pode ter mais que 255 caracteres.',

            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto válido.',

            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número válido.',

            'foto.required' => 'A foto do produto é obrigatória.',
            'foto.max' => 'A foto não pode ter mais que 2MB.',

            'categoria.required' => 'A categoria é obrigatória.',
            'categoria.string' => 'A categoria deve ser um texto.',
            'categoria.max' => 'A categoria não pode ter mais que 100 caracteres.',
        ];
    }
}
