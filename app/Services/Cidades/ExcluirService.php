<?php

namespace App\Services\Cidades;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\CidadesRepository;
use App\Services\DefaultService;

class ExcluirService extends DefaultService
{
    private CidadesRepository $cidades_repository;
    protected string $mensagem_nao_encontrada = 'Cidades não foram excluídas. Tente novamente.';

    public function __construct(CidadesRepository $cidades_repository)
    {
        parent::__construct();
        $this->Cidades_repository = $cidades_repository;
    }
    
    public function excluir($id): ResponseDTO
    {
        try {
            $resposta_db = $this->cidades_repository->excluir_db($id);
            $resposta = $this->montar_resposta($resposta_db, null, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }
}