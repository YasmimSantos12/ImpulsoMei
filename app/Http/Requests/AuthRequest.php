<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|exists:negocios,email',
            'password' => 'required|min:8',
        ];
    }

    public function messages(){
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email'    => 'Digite um e-mail válido.',
            'email.dns'      => 'O domínio do e-mail informado não existe.',
            'email.exists' => 'Esse E-mail não está cadastrado em nosso sistema',
            'password.required'=>'O campo senha é obrigatório',
            'password.min'=>'O campo senha deve ter no minímo 8 caracteres',
        ];
    }
}
