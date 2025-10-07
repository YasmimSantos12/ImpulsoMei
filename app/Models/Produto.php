<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $fillable = [
        'nome', 'descricao', 'preco', 'foto', 'categoria', 'negocio_id'
    ];

     public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}
