<?php

namespace App\Http\Controllers\Renders;

use App\Interfaces\renderTemplate;
use Illuminate\Http\JsonResponse;
use App\DTOs\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Renders\ComboBoxCidadesService;

class ComboBoxCidadesController extends Controller implements renderTemplate
{
    private ComboBoxCidadesService $combo_box_cidades_service;
    private ResponseDTO $resposta_dto;

    public function __construct(ComboBoxCidadesService $combo_box_cidades_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->combo_box_cidades_service = $combo_box_cidades_service;
    }

    public function renderizar(): JsonResponse
    {
        $this->resposta_dto = $this->combo_box_cidades_service->renderizar();
        return $this->resposta($this->resposta_dto);
    }
}