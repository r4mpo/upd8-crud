<?php

namespace App\Swagger\Relatorios;

/**
 * @OA\Get(
 *     path="/relatorios/representantes-por-id-cidade/{id}",
 *     summary="Listar representantes por ID da cidade",
 *     tags={"Relatórios"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID da cidade",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Representantes encontrados para a cidade informada",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=4),
 *                     @OA\Property(property="nome", type="string", example="Fernanda Representante 1"),
 *                     @OA\Property(property="endereco", type="string", example="Av. Leste, 400"),
 *                     @OA\Property(property="telefone", type="string", example="(21) 94444-4444"),
 *                     @OA\Property(property="email", type="string", example="fernanda.rep1@exemplo.com"),
 *                     @OA\Property(property="cidade", type="string", example="Rio de Janeiro")
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

class RepresentantesPorIdCidadeResponse
{
}