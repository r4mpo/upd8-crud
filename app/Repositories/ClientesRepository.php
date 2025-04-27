<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

class ClientesRepository
{
    public function consultar_db(): Collection
    {
        return Cliente::all();
    }

    public function registrar_db(array $dados): Cliente
    {
        return Cliente::create($dados);
    }

    public function buscar_db(int $id): Cliente
    {
        return Cliente::findOrFail($id);
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