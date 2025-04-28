<?php

namespace App\Http\Controllers\Renders;

use App\Interfaces\renderTemplate;
use Illuminate\Http\JsonResponse;
use App\DTOs\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Renders\ComboBoxEstadosService;

class ComboBoxEstadosController extends Controller implements renderTemplate
{
    private ComboBoxEstadosService $combo_box_estados_service;
    private ResponseDTO $resposta_dto;

    public function __construct(ComboBoxEstadosService $combo_box_estados_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->combo_box_estados_service = $combo_box_estados_service;
    }

    public function renderizar(): JsonResponse
    {
        $this->resposta_dto = $this->combo_box_estados_service->renderizar();
        return $this->resposta($this->resposta_dto);
    }
}