<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CortesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cortes')->insert([
            'nome' => 'Corte Padrão',
            'descricao' => 'Descrição do corte padrão',
            'preco' => 20.00,
            'barbeiro_id' => 1, // Replace with the actual barbeiro_id
            'intervalo' => '01:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
