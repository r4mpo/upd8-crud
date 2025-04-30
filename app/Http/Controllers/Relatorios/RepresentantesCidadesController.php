<?php

namespace App\Http\Controllers\Relatorios;

use App\DTOs\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Relatorios\RepresentantesCidadesService;
use Illuminate\Http\JsonResponse;

class RepresentantesCidadesController extends Controller
{
    private RepresentantesCidadesService $representantes_cidades_service;

    private ResponseDTO $resposta_dto;

    public function __construct(RepresentantesCidadesService $representantes_cidades_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->representantes_cidades_service = $representantes_cidades_service;
    }

    public function index($id): JsonResponse
    {
        $this->resposta_dto = $this->representantes_cidades_service->buscar($id);
        return $this->resposta($this->resposta_dto);
    }
}
