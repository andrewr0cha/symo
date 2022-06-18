<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'id' => 1,
            'nome' => 'entrada',
            'id_tipo' => 1,
            'id_usuario' => null,
        ]);
        DB::table('categorias')->insert([
            'id' => 2,
            'nome' => 'saida',
            'id_tipo' => 2,
            'id_usuario' => null,
        ]);
    }
}
