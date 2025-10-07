<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegocioRequest extends FormRequest
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
            'name_user' => 'required',
            'email' => 'required|email:rfc,dns|unique:negocios,email',
            'password' => 'required|min:8',
            'telefone' => 'required|regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/|phone:BR',
            'endereco' => 'required',
            'name_negocio' => 'required|unique:negocios,name_negocio',
            'type_servico' => 'required',
            'logotipo' => 'required'
        ];
    }

    public function messages(){
        return [
            'name_user.required'=>'O campo nome é obrigatótio',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email'    => 'Digite um e-mail válido.',
            'email.unique'   => 'Esse e-mail já está em uso.',
            'email.dns'      => 'O domínio do e-mail informado não existe.',
            'password.required'=>'O campo senha é obrigatório',
            'password.min'=>'O campo senha deve ter no minímo 8 caracteres',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.regex'    => 'Digite um número de telefone válido com DDD.',
            'telefone.phone'    => 'Digite um número de telefone válido do Brasil.',
            'endereco.required' => 'O campo endereço é obrigatório',
            'type_servico.required' => 'O campo serviço/produto é obrigatório',
            'logotipo' => 'Envie uma imagem de capa do seu negócio',
            'name_negocio.required' => 'O campo nome do seu négocio é obrigatória',
            'name_negocio.unique' => 'Um Negócio com esse nome já está cadastrado'
        ];
    }
}


