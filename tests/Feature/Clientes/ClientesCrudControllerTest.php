<?php

namespace Tests\Feature;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class ClientesCrudControllerTest extends TestCase
{
    /**
     * Cria um usuário e retorna o token de autenticação
     */
    private function getAuthToken()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    /**
     * Testa o endpoint de consulta de todos os clientes
     */
    public function test_index_retorna_lista_de_clientes_com_sucesso()
    {
        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get('/api/clientes');

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de criação de um novo cliente
     */
    public function test_store_cria_cliente_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'cpf' => '12345678901',
            'nome' => 'João Teste',
            'data_nascimento' => '1990-01-01',
            'sexo' => 'M',
            'endereco' => 'Rua Teste, 123',
            'estado' => 'SP',
            'cidade_id' => 1
        ];

        $response = $this->postJson('/api/clientes', $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de buscar um cliente específico
     */
    public function test_show_retorna_cliente_com_sucesso()
    {
        $token = $this->getAuthToken();

        // Suponha que o cliente com ID 1 exista
        $response = $this->getJson('/api/clientes/1', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de atualização de um cliente
     */
    public function test_update_atualiza_cliente_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'nome' => 'João Atualizado',
        ];

        $response = $this->putJson('/api/clientes/1', $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de exclusão de um cliente
     */
    public function test_destroy_exclui_cliente_com_sucesso()
    {
        $token = $this->getAuthToken();

        $response = $this->deleteJson('/api/clientes/1', [], [
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
        ])->get('/api/clientes');

        $response->assertStatus(401);
        $response->assertJson([
            'resposta' => 'Token inválido.',
            'codigo_resposta' => 333,
        ]);
    }
}
