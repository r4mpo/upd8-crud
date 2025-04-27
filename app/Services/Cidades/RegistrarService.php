<?php

namespace App\Services\Cidades;

use App\Services\DefaultService;
use App\DTOs\Default\ResponseDTO;
use App\Repositories\CidadesRepository;
use App\ValueObjects\Cidades\RegistrarVO;

class RegistrarService extends DefaultService
{
    protected CidadesRepository $cidades_repository;
    protected string $mensagem_nao_encontrada = '';

    public function __construct(CidadesRepository $cidades_repository)
    {
        parent::__construct();
        $this->cidades_repository = $cidades_repository;
    }

    public function registrar($requisicao): ResponseDTO
    {
        try {
            new RegistrarVO($requisicao);
            $resposta_db = $this->cidades_repository->registrar_db($requisicao);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}