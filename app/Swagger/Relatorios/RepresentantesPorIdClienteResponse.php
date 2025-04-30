<?php

namespace App\Swagger\Relatorios;

/**
 * @OA\Get(
 *     path="/relatorios/representantes-por-id-cliente/{id}",
 *     summary="Listar representantes por ID do cliente",
 *     tags={"Relatórios"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do cliente",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Representantes encontrados para o cliente informado",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="nome", type="string", example="José Representante 1"),
 *                     @OA\Property(property="endereco", type="string", example="Rua A, 100"),
 *                     @OA\Property(property="telefone", type="string", example="(11) 91111-1111"),
 *                     @OA\Property(property="email", type="string", example="jose.rep1@exemplo.com"),
 *                     @OA\Property(property="cidade", type="string", example="São Paulo")
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

class RepresentantesPorIdClienteResponse
{
}