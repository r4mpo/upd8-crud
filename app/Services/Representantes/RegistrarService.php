<?php

namespace App\Services\Representantes;

use App\Services\DefaultService;
use App\DTOs\Default\ResponseDTO;
use App\Repositories\RepresentantesRepository;
use App\ValueObjects\Representantes\RegistrarVO;

class RegistrarService extends DefaultService
{
    protected RepresentantesRepository $representantes_repository;
    protected string $mensagem_nao_encontrada = '';

    public function __construct(RepresentantesRepository $representantes_repository)
    {
        parent::__construct();
        $this->representantes_repository = $representantes_repository;
    }

    public function registrar($requisicao): ResponseDTO
    {
        try {
            new RegistrarVO($requisicao);
            $resposta_db = $this->representantes_repository->registrar_db($requisicao);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}