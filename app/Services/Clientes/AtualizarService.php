<?php

namespace App\Services\Clientes;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\ClientesRepository;
use App\Services\DefaultService;
use App\ValueObjects\Clientes\AtualizarVO;

class AtualizarService extends DefaultService
{
    private ClientesRepository $clientes_repository;
    protected string $mensagem_nao_encontrada = 'Clientes não foram atualizados. Tente novamente.';

    public function __construct(ClientesRepository $clientes_repository)
    {
        parent::__construct();
        $this->clientes_repository = $clientes_repository;
    }
    
    public function atualizar($requisicao, $id): ResponseDTO
    {
        try {
            new AtualizarVO($requisicao);
            $resposta_db = $this->clientes_repository->atualizar_db($requisicao, $id);
            $resposta = $this->montar_resposta($resposta_db, null, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }
}