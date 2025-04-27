<?php

namespace App\Http\Requests\Cidades;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regras_resposta = [
            "nome" => "required|string",
            "estado" => "required|string|in:" . implode(',', array_keys(config('estados'))),
        ];

        return $regras_resposta;
    }
}
