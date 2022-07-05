<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_categorias')->insert([
            'id' => 2,
            'nome_tipo' => 'entrada',
        ]);
        DB::table('tipos_categorias')->insert(
        ['id' => 1,
        'nome_tipo' => 'saida',
        ]);
    }
}
