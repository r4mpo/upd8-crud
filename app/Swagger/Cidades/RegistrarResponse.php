<?php

namespace App\Swagger\Cidades;

/**
 * @OA\Post(
 *     path="/cidades",
 *     summary="Registrar uma nova cidade",
 *     tags={"Cidades"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nome", "estado"},
 *             @OA\Property(property="nome", type="string", example="Santana"),
 *             @OA\Property(property="estado", type="string", example="BA")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Cidade registrada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=33),
 *                 @OA\Property(property="nome", type="string", example="Santana"),
 *                 @OA\Property(property="estado", type="string", example="BA"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-27T14:13:58.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-27T14:13:58.000000Z")
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Campos obrigatórios ausentes",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="array",
 *                 @OA\Items(type="string", example="O campo nome é obrigatório.")
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro ao processar a requisição",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Erro ao processar a requisição"),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */

class RegistrarResponse
{
}