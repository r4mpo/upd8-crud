<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento',
        'sexo',
        'endereco',
        'estado',
        'cidade_id',
    ];
}
