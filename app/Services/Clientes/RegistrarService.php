<?php

namespace App\Services\Clientes;

use App\Services\DefaultService;
use App\DTOs\Default\ResponseDTO;
use App\Repositories\ClientesRepository;
use App\ValueObjects\Clientes\RegistrarVO;

class RegistrarService extends DefaultService
{
    protected ClientesRepository $clientes_repository;
    protected string $mensagem_nao_encontrada = '';

    public function __construct(ClientesRepository $clientes_repository)
    {
        parent::__construct();
        $this->clientes_repository = $clientes_repository;
    }

    public function registrar($requisicao): ResponseDTO
    {
        try {
            new RegistrarVO($requisicao);
            $resposta_db = $this->clientes_repository->registrar_db($requisicao);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}