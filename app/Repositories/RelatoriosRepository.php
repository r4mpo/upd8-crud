<?php

namespace App\Repositories;

use App\Queries\Relatorios\RepresentantesCidadesQuery;
use App\Queries\Relatorios\RepresentantesClientesQuery;
use DB;

class RelatoriosRepository
{
    public function representantes_clientes_db($id_cliente): array
    {
        return DB::select(RepresentantesClientesQuery::getQuery(), ['cliente_id' => $id_cliente]);
    }

    public function representantes_cidades_db($id_cidade): array
    {
        return DB::select(RepresentantesCidadesQuery::getQuery(), ['cidade_id' => $id_cidade]);
    }
}