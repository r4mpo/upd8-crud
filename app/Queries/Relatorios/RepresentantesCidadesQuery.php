<?php
namespace App\Queries\Relatorios;

use App\Queries\DefaultQuery;

class RepresentantesCidadesQuery extends DefaultQuery
{
    public static function getQuery(): string
    {
        return "SELECT r.*, cidades.nome AS cidade_nome 
        FROM representantes r
        JOIN cidades ON r.cidade_id = cidades.id
        WHERE r.cidade_id = :cidade_id;";
    }
}