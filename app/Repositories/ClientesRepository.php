<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

class ClientesRepository
{
    public function consultar_db(array $dados = []): Collection
    {
        $query = Cliente::query()
            ->join('cidades', 'clientes.cidade_id', '=', 'cidades.id') // Fazendo o join com a tabela cidades
            ->select('clientes.*', 'cidades.nome as nome_cidade'); // Selecionando todos os campos de cliente + o nome da cidade
    
        if (isset($dados['cpf']) && !empty($dados['cpf'])) {
            $query->where('clientes.cpf', $dados['cpf']);
        }
    
        if (isset($dados['nome']) && !empty($dados['nome'])) {
            $query->where('clientes.nome', 'LIKE', '%' . $dados['nome'] . '%');
        }
    
        if (isset($dados['data_nascimento']) && !empty($dados['data_nascimento'])) {
            $query->where('clientes.data_nascimento', $dados['data_nascimento']);
        }
    
        if (isset($dados['sexo']) && !empty($dados['sexo'])) {
            $query->where('clientes.sexo', $dados['sexo']);
        }
    
        if (isset($dados['estado']) && !empty($dados['estado'])) {
            $query->where('clientes.estado', $dados['estado']);
        }
    
        if (isset($dados['cidade_id']) && !empty($dados['cidade_id'])) {
            $query->where('clientes.cidade_id', $dados['cidade_id']);
        }
    
        return $query->get();
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