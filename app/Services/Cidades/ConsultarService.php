<?php

namespace App\Services\Cidades;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\CidadesRepository;
use App\Services\DefaultService;

class ConsultarService extends DefaultService
{
    protected CidadesRepository $cidades_repository;
    protected string $mensagem_nao_encontrada = 'Cidades não foram encontradas. Tente novamente.';

    public function __construct(CidadesRepository $cidades_repository)
    {
        parent::__construct();
        $this->cidades_repository = $cidades_repository;
    }

    public function consultar(): ResponseDTO
    {
        try {
            $resposta_db = $this->cidades_repository->consultar_db($_GET);
            $resposta_db = empty($resposta_db) ? false : $resposta_db;
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }
}