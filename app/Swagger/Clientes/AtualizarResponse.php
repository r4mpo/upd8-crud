<?php

namespace App\Swagger\Clientes;

/**
 * @OA\Put(
 *     path="/clientes/{id}",
 *     summary="Atualizar informações de um cliente",
 *     tags={"Clientes"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do cliente",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nome", type="string", example="Alex Sandro Atualizado"),
 *             @OA\Property(property="endereco", type="string", example="Nova Rua Atualizada, 100")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente atualizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Sucesso na operação."),
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
class AtualizarResponse
{
}