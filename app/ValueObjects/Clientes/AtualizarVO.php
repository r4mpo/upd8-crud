<?php

namespace App\ValueObjects\Clientes;

use App\DTOs\Clientes\AtualizarDTO;
use App\Helpers\MensagensValidacao;
use App\Http\Requests\Clientes\AtualizarRequest;
use Illuminate\Support\Facades\Validator;

class AtualizarVO
{
    protected $valor;
    private $atualizar_request;
    private $mensagens_validacao;

    public function __construct($requisicao)
    {
        $this->atualizar_request = new AtualizarRequest();
        $this->mensagens_validacao = new MensagensValidacao();
        $this->valor = new AtualizarDTO($requisicao);
        $this->validar($requisicao);
    }

    public function valor(): AtualizarDTO
    {
        return $this->valor;
    }

    protected function validar($requisicao): void
    {
        $regras = $this->atualizar_request->rules();
        $mensagens_validacao = $this->mensagens_validacao->mensagens();

        $validacao_regras = Validator::make($requisicao, $regras, $mensagens_validacao);

        if ($validacao_regras->fails()) {
            throw new \Exception(implode(',', $validacao_regras->errors()->all()));
        }
    }
}