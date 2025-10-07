<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Negocio extends Authenticatable
{
    protected $fillable=[
        'name_user',
        'email',
        'password',
        'telefone',
        'endereco',
        'name_negocio',
        'type_servico',
        'logotipo'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
