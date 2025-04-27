<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento',
        'sexo',
        'email',
        'telefone',
        'endereco',
        'estado',
        'cidade_id',
    ];
}
