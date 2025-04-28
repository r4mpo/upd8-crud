<?php

namespace App\Services\Renders;

use App\DTOs\Default\ResponseDTO;
use App\Services\DefaultService;

class ComboBoxEstadosService extends DefaultService
{
    protected string $mensagem_nao_encontrada = 'Estados não foram encontrados. Tente novamente.';

    public function __construct()
    {
        parent::__construct();
    }

    public function renderizar(): ResponseDTO
    {
        try {
            $resposta_db = $this->montar_combo();
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }

    private function montar_combo(): string
    {
        $estados = config('estados');
    
        $options = array_map(function ($estado, $uf) {
            return sprintf('<option value="%s">%s</option>', $uf, $estado);
        }, $estados, array_keys($estados));
    
        array_unshift($options, '<option value="" selected disabled>Selecione</option>');
    
        return implode('', $options);
    }
}