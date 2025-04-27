<?php

namespace App\Services\Representantes;

use App\DTOs\Default\ResponseDTO;
use App\Repositories\RepresentantesRepository;
use App\Services\DefaultService;

class BuscarService extends DefaultService
{
    protected RepresentantesRepository $representantes_repository;
    protected string $mensagem_nao_encontrada = 'Representantes não foram encontrados. Tente novamente.';

    public function __construct(RepresentantesRepository $representantes_repository)
    {
        parent::__construct();
        $this->representantes_repository = $representantes_repository;
    }
    
    public function buscar($id): ResponseDTO
    {
        try {
            $resposta_db = $this->representantes_repository->buscar_db($id);
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