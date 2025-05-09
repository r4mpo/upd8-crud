<?php

namespace Tests\Feature;

use DB;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\CidadeSeeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class CidadesCrudControllerTest extends TestCase
{
    /**
     * Cria um usuário e retorna o token de autenticação
     */
    private function getAuthToken()
    {
        // Crie um usuário usando factory
        $user = User::factory()->create();  // Supondo que você tenha um factory para usuários

        // Gere o token JWT
        $token = JWTAuth::fromUser($user);  // Usando o método da facade para gerar o token

        return $token;
    }

    /**
     * Testa o endpoint de consulta de todas as cidades
     */
    public function test_index_retorna_lista_de_cidades_com_sucesso()
    {
        $token = $this->getAuthToken();

        // Adicionar manualmente os dados antes de realizar o teste
        $this->seed(CidadeSeeder::class);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get('/api/cidades');

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de criação de uma nova cidade
     */
    public function test_store_cria_cidade_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'nome' => 'Santana',
            'estado' => 'BA',
        ];

        $response = $this->postJson('/api/cidades', $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de buscar uma cidade específica
     */
    public function test_show_retorna_cidade_com_sucesso()
    {
        $token = $this->getAuthToken();

        $response = $this->getJson('/api/cidades/' . DB::getPdo()->lastInsertId(), [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de atualização de uma cidade
     */
    public function test_update_atualiza_cidade_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'nome' => 'Cidade Atualizada',
        ];

        $response = $this->putJson('/api/cidades/' . DB::getPdo()->lastInsertId(), $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de exclusão de uma cidade
     */
    public function test_destroy_exclui_cidade_com_sucesso()
    {
        $token = $this->getAuthToken();

        // Suponha que a cidade com ID 1 exista
        $response = $this->deleteJson('/api/cidades/' . DB::getPdo()->lastInsertId(), [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de erro com token inválido
     */
    public function test_401_token_invalido()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . 'token-invalido',
            'Accept' => 'application/json'
        ])->get('/api/cidades');

        $response->assertStatus(401);
        $response->assertJson([
            'resposta' => 'Token inválido.',
            'codigo_resposta' => 333,
        ]);
    }
}
