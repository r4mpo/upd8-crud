<?php

namespace App\Services\Representantes;

use App\DTOs\Default\ResponseDTO;
use App\Helpers\FormatarRetornosHelper;
use App\Repositories\RepresentantesRepository;
use App\Services\DefaultService;

class ConsultarService extends DefaultService
{
    protected RepresentantesRepository $representantes_repository;
    protected string $mensagem_nao_encontrada = 'Representantes não foram encontrados. Tente novamente.';

    public function __construct(RepresentantesRepository $representantes_repository)
    {
        parent::__construct();
        $this->representantes_repository = $representantes_repository;
    }

    public function consultar(): ResponseDTO
    {
        try {
            $resposta_db = $this->representantes_repository->consultar_db($_GET);
            $resposta_db = empty($resposta_db) ? false : $this->formatar_dados($resposta_db);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta([]);
        }
    }

    private function formatar_dados($dados): mixed
    {
        return $dados->map(function ($representante) {
            return [
                'id'                =>  $representante->id,
                'nome'              =>  $representante->nome,
                'cpf'               =>  FormatarRetornosHelper::formatarCPF($representante->cpf),
                'data_nascimento'   =>  FormatarRetornosHelper::formatarDataNascimento($representante->data_nascimento),
                'sexo'              =>  FormatarRetornosHelper::formatarSexo($representante->sexo),
                'estado'            =>  $representante->estado,
                'cidade'            =>  $representante->nome_cidade,
                'telefone'          =>  $representante->telefone,
                'email'             =>  $representante->email,
            ];
        });
    }
}