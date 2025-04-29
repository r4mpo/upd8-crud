<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'cpf' => '12345678901',
                'nome' => 'João Silva',
                'data_nascimento' => '1990-05-15',
                'sexo' => 'M',
                'endereco' => 'Rua das Flores, 123',
                'estado' => 'SP',
                'cidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '98765432100',
                'nome' => 'Maria Oliveira',
                'data_nascimento' => '1985-11-23',
                'sexo' => 'F',
                'endereco' => 'Av. Brasil, 456',
                'estado' => 'RJ',
                'cidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '11122233344',
                'nome' => 'Carlos Pereira',
                'data_nascimento' => '1978-02-08',
                'sexo' => 'M',
                'endereco' => 'Praça Central, 789',
                'estado' => 'MG',
                'cidade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '55566677788',
                'nome' => 'Ana Souza',
                'data_nascimento' => '1992-07-19',
                'sexo' => 'F',
                'endereco' => 'Rua Alegre, 321',
                'estado' => 'SP',
                'cidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '44433322211',
                'nome' => 'Pedro Lima',
                'data_nascimento' => '1988-09-30',
                'sexo' => 'M',
                'endereco' => 'Av. Paulista, 654',
                'estado' => 'SP',
                'cidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '99988877766',
                'nome' => 'Fernanda Gomes',
                'data_nascimento' => '1995-04-12',
                'sexo' => 'F',
                'endereco' => 'Rua da Paz, 789',
                'estado' => 'RJ',
                'cidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '22233344455',
                'nome' => 'Marcos Dias',
                'data_nascimento' => '1982-01-05',
                'sexo' => 'M',
                'endereco' => 'Travessa Sol, 12',
                'estado' => 'MG',
                'cidade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '77766655544',
                'nome' => 'Patrícia Andrade',
                'data_nascimento' => '1991-03-18',
                'sexo' => 'F',
                'endereco' => 'Rua das Palmeiras, 50',
                'estado' => 'BA',
                'cidade_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '88877766655',
                'nome' => 'Ricardo Mota',
                'data_nascimento' => '1987-10-11',
                'sexo' => 'M',
                'endereco' => 'Av. Atlântica, 900',
                'estado' => 'CE',
                'cidade_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '33322211100',
                'nome' => 'Luciana Castro',
                'data_nascimento' => '1993-12-22',
                'sexo' => 'F',
                'endereco' => 'Rua Verde, 77',
                'estado' => 'RS',
                'cidade_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // A partir daqui, dados variados para chegar a 50
        ];
        
        for ($i = 11; $i <= 50; $i++) {
            $clientes[] = [
                'cpf' => str_pad($i, 11, '0', STR_PAD_LEFT),
                'nome' => "Cliente {$i}",
                'data_nascimento' => now()->subYears(rand(20, 50))->format('Y-m-d'),
                'sexo' => rand(0, 1) ? 'M' : 'F',
                'endereco' => "Rua Cliente {$i}, " . rand(1, 999),
                'estado' => ['SP', 'RJ', 'MG', 'BA', 'CE', 'RS', 'PE', 'PR', 'SC', 'GO'][array_rand(['SP', 'RJ', 'MG', 'BA', 'CE', 'RS', 'PE', 'PR', 'SC', 'GO'])],
                'cidade_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
                
        DB::table('clientes')->insert($clientes);
    }
}