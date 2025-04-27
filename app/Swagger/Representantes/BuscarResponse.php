<?php

namespace App\Swagger\Representantes;

/**
 * @OA\Get(
 *     path="/representantes/{id}",
 *     summary="Buscar um representante específico",
 *     tags={"Representantes"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do representante",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Representante encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=4),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-27T18:54:25.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-27T18:54:25.000000Z"),
 *                 @OA\Property(property="cpf", type="string", example="12398457103"),
 *                 @OA\Property(property="nome", type="string", example="Alex Sandro"),
 *                 @OA\Property(property="data_nascimento", type="string", format="date", example="2002-01-01"),
 *                 @OA\Property(property="sexo", type="string", example="M"),
 *                 @OA\Property(property="email", type="string", example="exemplo@swagger"),
 *                 @OA\Property(property="telefone", type="string", example="(16) 3661-4912"),
 *                 @OA\Property(property="endereco", type="string", example="R. Teste de Software"),
 *                 @OA\Property(property="estado", type="string", example="SP"),
 *                 @OA\Property(property="cidade_id", type="integer", example=1),
 *                 @OA\Property(property="deleted_at", type="string", nullable=true, example=null)
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
class BuscarResponse
{
}