<?php

namespace App\Services\Clientes;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\ClientesRepository;
use App\Services\DefaultService;

class ExcluirService extends DefaultService
{
    private ClientesRepository $clientes_repository;
    protected string $mensagem_nao_encontrada = 'Clientes não foram excluídas. Tente novamente.';

    public function __construct(ClientesRepository $clientes_repository)
    {
        parent::__construct();
        $this->clientes_repository = $clientes_repository;
    }
    
    public function excluir($id): ResponseDTO
    {
        try {
            $resposta_db = $this->clientes_repository->excluir_db($id);
            $resposta = $this->montar_resposta($resposta_db, null, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }
}