<?php

namespace App\Swagger\Renders;

/**
 * @OA\Get(
 *     path="/renders/combo-box-cidades",
 *     summary="Renderizar combo box de cidades",
 *     tags={"Renders"},
 *     security={{"bearerAuth": {}}}, 
 *     @OA\Response(
 *         response=200,
 *         description="HTML do combo box com todas as cidades",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="<option value='' selected disabled>Selecione</option><option data-uf='SP' value='1'>São Paulo</option><option data-uf='RJ' value='2'>Rio de Janeiro</option><option data-uf='MG' value='3'>Belo Horizonte</option><option data-uf='BA' value='4'>Salvador</option><option data-uf='CE' value='5'>Cidade Atualizada</option><option data-uf='AM' value='7'>Manaus</option><option data-uf='PE' value='8'>Recife</option><option data-uf='RS' value='9'>Porto Alegre</option><option data-uf='PA' value='10'>Belém</option><option data-uf='GO' value='11'>Goiânia</option><option data-uf='SP' value='12'>Guarulhos</option><option data-uf='SP' value='13'>Campinas</option><option data-uf='MA' value='14'>São Luís</option><option data-uf='AL' value='15'>Maceió</option><option data-uf='RN' value='16'>Natal</option><option data-uf='PI' value='17'>Teresina</option><option data-uf='MS' value='18'>Campo Grande</option><option data-uf='SP' value='19'>São Bernardo do Campo</option><option data-uf='RJ' value='20'>Nova Iguaçu</option><option data-uf='PB' value='21'>João Pessoa</option><option data-uf='SP' value='22'>São José dos Campos</option><option data-uf='SP' value='23'>Santo André</option><option data-uf='PE' value='24'>Jaboatão dos Guararapes</option><option data-uf='SP' value='25'>Osasco</option><option data-uf='BA' value='26'>Santana</option>"),
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
class ComboBoxCidadesResponse
{
}
