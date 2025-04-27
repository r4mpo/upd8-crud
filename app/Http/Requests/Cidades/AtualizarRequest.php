<?php

namespace App\Http\Requests\Cidades;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regras_resposta = [
            "nome" => "string|unique:cidades,nome",
            "estados" => "string|in:" . implode(',', array_keys(config('estados'))),
        ];

        return $regras_resposta;
    }
}
