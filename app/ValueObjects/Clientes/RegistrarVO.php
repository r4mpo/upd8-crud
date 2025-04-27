<?php

namespace App\ValueObjects\Clientes;

use App\DTOs\Clientes\RegistrarDTO;
use App\Helpers\MensagensValidacao;
use App\Http\Requests\Clientes\RegistrarRequest;
use Illuminate\Support\Facades\Validator;

class RegistrarVO
{
    protected $valor;
    private $registrar_request;
    private $mensagens_validacao;

    public function __construct($requisicao)
    {
        $this->registrar_request = new RegistrarRequest();
        $this->mensagens_validacao = new MensagensValidacao();
        $this->valor = new RegistrarDTO($requisicao);
        $this->validar($requisicao);
    }

    public function valor(): RegistrarDTO
    {
        return $this->valor;
    }

    protected function validar($requisicao): void
    {
        $regras = $this->registrar_request->rules();
        $mensagens_validacao = $this->mensagens_validacao->mensagens();

        $validacao_regras = Validator::make($requisicao, $regras, $mensagens_validacao);

        if ($validacao_regras->fails()) {
            throw new \Exception(implode(',', $validacao_regras->errors()->all()));
        }
    }
}