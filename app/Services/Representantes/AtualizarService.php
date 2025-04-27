<?php

namespace App\Services\Representantes;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\RepresentantesRepository;
use App\Services\DefaultService;
use App\ValueObjects\Representantes\AtualizarVO;

class AtualizarService extends DefaultService
{
    private RepresentantesRepository $representantes_repository;
    protected string $mensagem_nao_encontrada = 'Representantes não foram atualizados. Tente novamente.';

    public function __construct(RepresentantesRepository $representantes_repository)
    {
        parent::__construct();
        $this->representantes_repository = $representantes_repository;
    }
    
    public function atualizar($requisicao, $id): ResponseDTO
    {
        try {
            new AtualizarVO($requisicao);
            $resposta_db = $this->representantes_repository->atualizar_db($requisicao, $id);
            $resposta = $this->montar_resposta($resposta_db, null, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}