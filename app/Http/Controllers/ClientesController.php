<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\crudTemplate;
use Illuminate\Http\JsonResponse;
use App\DTOs\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Clientes\BuscarService;
use App\Services\Clientes\ExcluirService;
use App\Services\Clientes\AtualizarService;
use App\Services\Clientes\ConsultarService;
use App\Services\Clientes\RegistrarService;

class ClientesController extends Controller implements crudTemplate
{
    private ConsultarService $consultar_service;
    private RegistrarService $registrar_service;
    private BuscarService $buscar_service;
    private AtualizarService $atualizar_service;
    private ExcluirService $excluir_service;

    private ResponseDTO $resposta_dto;

    public function __construct(ConsultarService $consultar_service, RegistrarService $registrar_service, BuscarService $buscar_service, AtualizarService $atualizar_service, ExcluirService $excluir_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->consultar_service = $consultar_service;
        $this->registrar_service = $registrar_service;
        $this->buscar_service = $buscar_service;
        $this->atualizar_service = $atualizar_service;
        $this->excluir_service = $excluir_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->resposta_dto = $this->consultar_service->consultar();
        return $this->resposta($this->resposta_dto);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $requisicao): JsonResponse
    {
        $this->resposta_dto = $this->registrar_service->registrar($requisicao->all());
        return $this->resposta($this->resposta_dto);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $this->resposta_dto = $this->buscar_service->buscar($id);
        return $this->resposta($this->resposta_dto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $requisicao, string $id): JsonResponse
    {
        $this->resposta_dto = $this->atualizar_service->atualizar($requisicao->all(), $id);
        return $this->resposta($this->resposta_dto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->resposta_dto = $this->excluir_service->excluir($id);
        return $this->resposta($this->resposta_dto);
    }
}