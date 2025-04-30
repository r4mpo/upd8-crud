<?php

namespace App\Swagger\Representantes;

/**
 * @OA\Get(
 *     path="/representantes",
 *     summary="Listar todos os representantes com filtros opcionais",
 *     tags={"Representantes"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="cpf",
 *         in="query",
 *         description="Filtrar por CPF",
 *         required=false,
 *         @OA\Schema(type="string", example="111.111.111-11")
 *     ),
 *     @OA\Parameter(
 *         name="nome",
 *         in="query",
 *         description="Filtrar por nome",
 *         required=false,
 *         @OA\Schema(type="string", example="João")
 *     ),
 *     @OA\Parameter(
 *         name="endereco",
 *         in="query",
 *         description="Filtrar por endereço",
 *         required=false,
 *         @OA\Schema(type="string", example="Rua das Flores")
 *     ),
 *     @OA\Parameter(
 *         name="data_nascimento",
 *         in="query",
 *         description="Filtrar por data de nascimento",
 *         required=false,
 *         @OA\Schema(type="string", format="date", example="2001-01-01")
 *     ),
 *     @OA\Parameter(
 *         name="sexo",
 *         in="query",
 *         description="Filtrar por sexo",
 *         required=false,
 *         @OA\Schema(type="string", example="Masculino")
 *     ),
 *     @OA\Parameter(
 *         name="estado",
 *         in="query",
 *         description="Filtrar por estado",
 *         required=false,
 *         @OA\Schema(type="string", example="SP")
 *     ),
 *     @OA\Parameter(
 *         name="cidade_id",
 *         in="query",
 *         description="Filtrar por cidade_id",
 *         required=false,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="telefone",
 *         in="query",
 *         description="Filtrar por telefone",
 *         required=false,
 *         @OA\Schema(type="string", example="(11) 11111-1111")
 *     ),
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="Filtrar por email",
 *         required=false,
 *         @OA\Schema(type="string", example="teste@teste.com")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de representantes",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=8),
 *                     @OA\Property(property="nome", type="string", example="Teste"),
 *                     @OA\Property(property="endereco", type="string", example="Rua do Teste"),
 *                     @OA\Property(property="cpf", type="string", example="111.111.111-11"),
 *                     @OA\Property(property="data_nascimento", type="string", example="01/01/2001"),
 *                     @OA\Property(property="sexo", type="string", example="Masculino"),
 *                     @OA\Property(property="estado", type="string", example="SP"),
 *                     @OA\Property(property="cidade", type="string", example="Batatais"),
 *                     @OA\Property(property="telefone", type="string", example="(11) 11111-1111"),
 *                     @OA\Property(property="email", type="string", example="teste.teste@teste.com")
 *                 )
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Token inválido ou não enviado",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Não autorizado."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno no servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Erro ao processar a requisição."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */
class ConsultarResponse
{
}