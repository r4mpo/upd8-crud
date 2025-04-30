<?php
namespace App\Queries\Relatorios;

use App\Queries\DefaultQuery;

class RepresentantesClientesQuery extends DefaultQuery
{
    public static function getQuery(): string
    {
        return "SELECT r.*, cidades.nome AS cidade_nome 
        FROM representantes r
        JOIN clientes c ON r.cidade_id = c.cidade_id
        JOIN cidades ON r.cidade_id = cidades.id
        WHERE c.id = :cliente_id;";
    }
}