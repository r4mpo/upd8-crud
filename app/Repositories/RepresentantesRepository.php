<?php

namespace App\Repositories;

use App\Helpers\FormatarRetornosHelper;
use App\Models\Representante;
use Illuminate\Database\Eloquent\Collection;

class RepresentantesRepository
{
    public function consultar_db(array $dados = []): Collection
    {
        $query = Representante::query()
            ->join('cidades', 'representantes.cidade_id', '=', 'cidades.id') // Fazendo o join com a tabela cidades
            ->select('representantes.*', 'cidades.nome as nome_cidade'); // Selecionando todos os campos de cliente + o nome da cidade
    
        if (isset($dados['cpf']) && !empty($dados['cpf'])) {
            $query->where('representantes.cpf', $dados['cpf']);
        }
    
        if (isset($dados['nome']) && !empty($dados['nome'])) {
            $query->where('representantes.nome', 'LIKE', '%' . $dados['nome'] . '%');
        }
    
        if (isset($dados['data_nascimento']) && !empty($dados['data_nascimento'])) {
            $query->where('representantes.data_nascimento', $dados['data_nascimento']);
        }
    
        if (isset($dados['sexo']) && !empty($dados['sexo'])) {
            $query->where('representantes.sexo', $dados['sexo']);
        }
    
        if (isset($dados['estado']) && !empty($dados['estado'])) {
            $query->where('representantes.estado', $dados['estado']);
        }
    
        if (isset($dados['cidade_id']) && !empty($dados['cidade_id'])) {
            $query->where('representantes.cidade_id', $dados['cidade_id']);
        }

        if (isset($dados['cidade_id']) && !empty($dados['cidade_id'])) {
            $query->where('representantes.cidade_id', $dados['cidade_id']);
        }

        if (isset($dados['telefone']) && !empty($dados['telefone'])) {
            $query->where('representantes.telefone', FormatarRetornosHelper::formatarTelefone($dados['telefone']));
        }
    
        if (isset($dados['email']) && !empty($dados['email'])) {
            $query->where('representantes.email', $dados['email']);
        }

        return $query->get();
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