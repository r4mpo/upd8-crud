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
        ];

        DB::table('clientes')->insert($clientes);
    }
}