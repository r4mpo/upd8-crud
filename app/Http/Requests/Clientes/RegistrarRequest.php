<?php

namespace App\Http\Requests\Clientes;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarRequest extends FormRequest
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
            "cpf" => "required|string|size:11",
            "nome" => "required|string|max:100",
            "data_nascimento" => "required|date|date_format:Y-m-d",
            "sexo" => "required|in:M,F",
            "endereco" => "required|string|max:60",
            "estado" => "required|string|size:2|in:" . implode(",", array_keys(config("estados"))),
            "cidade_id" => "required|exists:cidades,id",
        ];

        return $regras_resposta;
    }
}
