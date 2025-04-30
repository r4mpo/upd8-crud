<?php

namespace App\Services\Relatorios;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\RelatoriosRepository;
use App\Services\DefaultService;

class RepresentantesCidadesService extends DefaultService
{
    protected RelatoriosRepository $relatorios_repository;
    protected string $mensagem_nao_encontrada = 'Representantes para o cidade não foram encontrados. Tente novamente.';

    public function __construct(RelatoriosRepository $relatorios_repository)
    {
        parent::__construct();
        $this->relatorios_repository = $relatorios_repository;
    }
    
    public function buscar($id): ResponseDTO
    {
        try {
            $resposta_db = $this->relatorios_repository->representantes_cidades_db($id);
            $resposta_db = empty($resposta_db) ? false : $this->formatar_dados($resposta_db);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }

    private function formatar_dados($dados): mixed
    {
        $dados_formatados = [];

        foreach($dados as $representante){
            $dados_formatados[] = [
                'id'                =>  $representante->id,
                'nome'              =>  $representante->nome,
                'endereco'          =>  $representante->endereco,
                'telefone'          =>  $representante->telefone,
                'email'             =>  $representante->email,
                'cidade'            =>  $representante->cidade_nome,
            ];
        };

        return $dados_formatados;
    }
}