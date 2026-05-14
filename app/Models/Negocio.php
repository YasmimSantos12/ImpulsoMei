<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Negocio extends Authenticatable
{
    use Notifiable;

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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($negocio) {
            if ($negocio->logotipo && file_exists(public_path($negocio->logotipo))) {
                unlink(public_path($negocio->logotipo));
            }
        });
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
