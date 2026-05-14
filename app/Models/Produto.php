<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $fillable = [
        'nome', 'descricao', 'preco', 'foto', 'categoria', 'negocio_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($produto) {
            if ($produto->foto && file_exists(public_path($produto->foto))) {
                unlink(public_path($produto->foto));
            }
        });
    }

     public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}
