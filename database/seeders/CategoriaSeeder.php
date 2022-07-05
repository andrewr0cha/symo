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
            'nome' => 'Essencial',
            'id_tipo' => 1,
        ]);
        DB::table('categorias')->insert([
            'id' => 2,
            'nome' => 'Objetivos',
            'id_tipo' => 1,
        ]);
        DB::table('categorias')->insert([
            'id' => 3,
            'nome' => 'Aposentadoria',
            'id_tipo' => 1,
        ]);
        DB::table('categorias')->insert([
            'id' => 4,
            'nome' => 'Educação',
            'id_tipo' => 1,
        ]);
        DB::table('categorias')->insert([
            'id' => 5,
            'nome' => 'A gosto',
            'id_tipo' => 1,
        ]);
        DB::table('categorias')->insert([
            'id' => 6,
            'nome' => 'entrada',
            'id_tipo' => 2,
        ]);
        
    }
}
