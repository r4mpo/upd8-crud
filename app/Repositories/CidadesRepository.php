<?php

namespace App\Repositories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Collection;

class CidadesRepository
{
    public function consultar_db(array $dados = []): Collection
    {
        $query = Cidade::query();

        if (isset($dados['nome']) && !empty($dados['nome'])) {
            $query->where('cidades.nome', $dados['nome']);
        }

        if (isset($dados['estado']) && !empty($dados['estado'])) {
            $query->where('cidades.estado', $dados['estado']);
        }

        return $query->get();
    }

    public function registrar_db(array $dados): Cidade
    {
        return Cidade::create($dados);
    }

    public function buscar_db(int $id): Cidade
    {
        return Cidade::findOrFail($id);
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