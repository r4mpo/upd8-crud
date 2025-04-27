<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RepresentantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Instanciando o Faker para gerar dados falsos
        $faker = Faker::create('pt_BR'); // Definindo o local para gerar dados no padrão brasileiro

        // Gerando 5 representantes
        for ($i = 0; $i < 5; $i++) {
            DB::table('representantes')->insert([
                'cpf' => $faker->unique()->numerify('###########'), // CPF fictício
                'nome' => $faker->name(),
                'data_nascimento' => $faker->date('Y-m-d', '1990-01-01'), // Data de nascimento fictícia
                'sexo' => $faker->randomElement(['M', 'F']), // Sexo aleatório
                'telefone' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'endereco' => $faker->streetAddress(),
                'estado' => $faker->randomElement(['SP', 'RJ', 'MG', 'BA', 'RS']),
                'cidade_id' => $faker->numberBetween(1, 5), // Supondo que já existam cidades com IDs 1 a 5
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}