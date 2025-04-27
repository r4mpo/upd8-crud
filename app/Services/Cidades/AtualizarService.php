<?php

namespace App\Services\Cidades;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\CidadesRepository;
use App\Services\DefaultService;
use App\ValueObjects\Cidades\AtualizarVO;

class AtualizarService extends DefaultService
{
    private CidadesRepository $cidades_repository;
    protected string $mensagem_nao_encontrada = 'Cidades não foram atualizadas. Tente novamente.';

    public function __construct(CidadesRepository $cidades_repository)
    {
        parent::__construct();
        $this->cidades_repository = $cidades_repository;
    }
    
    public function atualizar($requisicao, $id): ResponseDTO
    {
        try {
            new AtualizarVO($requisicao);
            $resposta_db = $this->cidades_repository->atualizar_db($requisicao, $id);
            $resposta = $this->montar_resposta($resposta_db, null, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}