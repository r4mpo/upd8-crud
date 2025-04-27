<?php

namespace App\Repositories;

use App\Models\Representante;
use Illuminate\Database\Eloquent\Collection;

class RepresentantesRepository
{
    public function consultar_db(): Collection
    {
        return Representante::all();
    }

    public function registrar_db(array $dados): Representante
    {
        return Representante::create($dados);
    }

    public function buscar_db(int $id): Representante
    {
        return Representante::findOrFail($id);
    }

    public function atualizar_db(array $dados, int $id): bool
    {
        return $this->buscar_db($id)->update($dados);
    }

    public function excluir_db(int $id): bool|null
    {
        return $this->buscar_db($id)->delete();
    }
}