<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CidadeSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $cidades = [
            ['nome' => 'São Paulo', 'estado' => 'SP'],
            ['nome' => 'Rio de Janeiro', 'estado' => 'RJ'],
            ['nome' => 'Belo Horizonte', 'estado' => 'MG'],
            ['nome' => 'Salvador', 'estado' => 'BA'],
            ['nome' => 'Fortaleza', 'estado' => 'CE'],
            ['nome' => 'Curitiba', 'estado' => 'PR'],
            ['nome' => 'Manaus', 'estado' => 'AM'],
            ['nome' => 'Recife', 'estado' => 'PE'],
            ['nome' => 'Porto Alegre', 'estado' => 'RS'],
            ['nome' => 'Belém', 'estado' => 'PA'],
            ['nome' => 'Goiânia', 'estado' => 'GO'],
            ['nome' => 'Guarulhos', 'estado' => 'SP'],
            ['nome' => 'Campinas', 'estado' => 'SP'],
            ['nome' => 'São Luís', 'estado' => 'MA'],
            ['nome' => 'Maceió', 'estado' => 'AL'],
            ['nome' => 'Natal', 'estado' => 'RN'],
            ['nome' => 'Teresina', 'estado' => 'PI'],
            ['nome' => 'Campo Grande', 'estado' => 'MS'],
            ['nome' => 'São Bernardo do Campo', 'estado' => 'SP'],
            ['nome' => 'Nova Iguaçu', 'estado' => 'RJ'],
            ['nome' => 'João Pessoa', 'estado' => 'PB'],
            ['nome' => 'São José dos Campos', 'estado' => 'SP'],
            ['nome' => 'Santo André', 'estado' => 'SP'],
            ['nome' => 'Jaboatão dos Guararapes', 'estado' => 'PE'],
            ['nome' => 'Osasco', 'estado' => 'SP'],
        ];

        foreach ($cidades as &$cidade) {
            $cidade['created_at'] = $now;
            $cidade['updated_at'] = $now;
        }

        DB::table('cidades')->insert($cidades);
    }
}