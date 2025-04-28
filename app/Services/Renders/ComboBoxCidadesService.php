<?php

namespace App\Services\Renders;

use App\Services\DefaultService;
use App\DTOs\Default\ResponseDTO;
use App\Repositories\CidadesRepository;

class ComboBoxCidadesService extends DefaultService
{
    private CidadesRepository $cidades_repository;
    protected string $mensagem_nao_encontrada = 'Cidades não foram encontradas. Tente novamente.';

    public function __construct(CidadesRepository $cidades_repository)
    {
        parent::__construct();
        $this->cidades_repository = $cidades_repository;
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
        $cidades = $this->cidades_repository->consultar_db();

        $options = ['<option value="" selected disabled>Selecione</option>'];

        if (!empty($cidades)) {
            foreach ($cidades as $cidade) {
                $options[] = sprintf(
                    '<option data-uf="%s" value="%s">%s</option>',
                    htmlspecialchars($cidade->estado),
                    htmlspecialchars($cidade->id),
                    htmlspecialchars($cidade->nome)
                );
            }
        }

        return implode('', $options);
    }
}