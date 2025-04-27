<?php

namespace App\Swagger\Cidades;

/**
 * @OA\Get(
 *     path="/cidades",
 *     summary="Consultar todas as cidades",
 *     tags={"Cidades"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de todas as cidades",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="resposta",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="nome", type="string", example="São Paulo"),
 *                     @OA\Property(property="estado", type="string", example="SP"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-27T13:23:42.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-27T13:23:42.000000Z"),
 *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, example=null)
 *                 )
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Token inválido",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Token inválido."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */

class ConsultarResponse
{
}