<?php

namespace App\Http\Controllers\Relatorios;

use App\DTOs\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Relatorios\RepresentantesClientesService;
use Illuminate\Http\JsonResponse;

class RepresentantesClientesController extends Controller
{
    private RepresentantesClientesService $representantes_clientes_service;

    private ResponseDTO $resposta_dto;

    public function __construct(RepresentantesClientesService $representantes_clientes_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->representantes_clientes_service = $representantes_clientes_service;
    }

    public function index($id): JsonResponse
    {
        $this->resposta_dto = $this->representantes_clientes_service->buscar($id);
        return $this->resposta($this->resposta_dto);
    }
}
