<?php

namespace App\Swagger\Cidades;

/**
 * @OA\Put(
 *     path="/cidades/{id}",
 *     summary="Atualizar uma cidade",
 *     tags={"Cidades"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nome", "estado"},
 *             @OA\Property(property="nome", type="string", example="Santana"),
 *             @OA\Property(property="estado", type="string", example="BA")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cidade atualizada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Sucesso na operação."),
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

class AtualizarResponse
{
}