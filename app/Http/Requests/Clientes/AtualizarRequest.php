<?php

namespace App\Http\Requests\Clientes;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has("cpf")) {
            $this->merge([
                "cpf" => preg_replace("/\D/", "", $this->cpf),
            ]);
        }
    }

    public function rules()
    {
        $regras_resposta = [
            "cpf" => "string|size:11|unique:clientes,cpf",
            "nome" => "string|max:100",
            "data_nascimento" => "date|date_format:Y-m-d",
            "sexo" => "in:M,F",
            "endereco" => "string|max:60",
            "estado" => "string|size:2|in:" . implode(",", array_keys(config("estados"))),
            "cidade_id" => "exists:cidades,id",
        ];

        return $regras_resposta;
    }
}
