<?php

namespace App\DTOs\Representantes;

use App\DTOs\Default\RequestDTO;

class AtualizarDTO extends RequestDTO
{
    public function __construct($dados)
    {
        $chaves_esperadas = [
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

        $chaves_nao_esperadas = array_diff(array_keys($dados), $chaves_esperadas);

        $this->retorno_padrao_dto($chaves_nao_esperadas);
    }
}
