<?php

namespace App\Services\Clientes;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\ClientesRepository;
use App\Services\DefaultService;

class ConsultarService extends DefaultService
{
    protected ClientesRepository $clientes_repository;
    protected string $mensagem_nao_encontrada = 'Clientes não foram encontrados. Tente novamente.';

    public function __construct(ClientesRepository $clientes_repository)
    {
        parent::__construct();
        $this->clientes_repository = $clientes_repository;
    }

    public function consultar(): ResponseDTO
    {
        try {
            $resposta_db = $this->clientes_repository->consultar_db();
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