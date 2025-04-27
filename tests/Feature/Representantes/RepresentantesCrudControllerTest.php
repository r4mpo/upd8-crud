<?php

namespace Tests\Feature;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class RepresentantesCrudControllerTest extends TestCase
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
     * Testa o endpoint de consulta de todos os representantes
     */
    public function test_index_retorna_lista_de_representantes_com_sucesso()
    {
        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get('/api/representantes');

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de criação de um novo representantes
     */
    public function test_store_cria_representantes_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'cpf' => '00000000000',
            'nome' => 'João Teste',
            'data_nascimento' => '1990-01-01',
            'sexo' => 'M',
            'endereco' => 'Rua Teste, 123',
            'estado' => 'SP',
            'cidade_id' => '1',
            'email' => 'gerado@phpunit',
            'telefone' => '(00) 0000-0000'
        ];

        $response = $this->postJson('/api/representantes', $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de buscar um representantes específico
     */
    public function test_show_retorna_representantes_com_sucesso()
    {
        $token = $this->getAuthToken();

        // Suponha que o representantes com ID 1 exista
        $response = $this->getJson('/api/representantes/1', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de atualização de um representantes
     */
    public function test_update_atualiza_representantes_com_sucesso()
    {
        $token = $this->getAuthToken();

        $dados = [
            'nome' => 'João Atualizado',
        ];

        $response = $this->putJson('/api/representantes/1', $dados, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'codigo_resposta' => 111,
        ]);
    }

    /**
     * Testa o endpoint de exclusão de um representantes
     */
    public function test_destroy_exclui_representantes_com_sucesso()
    {
        $token = $this->getAuthToken();

        $response = $this->deleteJson('/api/representantes/1', [], [
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
        ])->get('/api/representantes');

        $response->assertStatus(401);
        $response->assertJson([
            'resposta' => 'Token inválido.',
            'codigo_resposta' => 333,
        ]);
    }
}
