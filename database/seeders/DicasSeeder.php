<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dicas')->insert([
            'id' => 1,
            'dica' => 'Reflita se é realmente necessário gastar o seu dinheiro antes de possuí-lo.'
        ]);
        DB::table('dicas')->insert([
            'id' => 2,
            'dica' => 'Sucesso, seja ele financeiro ou não, é resultado de pequenos esforços.'
        ]);
        DB::table('dicas')->insert([
            'id' => 3,
            'dica' => 'Problemas para organizar suas contas?! Deixe que a Symo te ajuda! 
            Leia nossas dicas e descubra o poder da Organização.'
        ]);
        DB::table('dicas')->insert([
            'id' => 4,
            'dica' => 'Por mais que pareçam irrelevantes, os valores pequenos podem ser a chave da organização financeira.'
        ]);
        DB::table('dicas')->insert([
            'id' => 5,
            'dica' => 'Ao olharmos para nossos grandes problemas, os interpretamos como monstros, mas podemos dividir esse 
            monstro em vários menores e os derrotar um por um. O mesmo vale para seus grandes problemas financeiros.'
        ]);
        DB::table('dicas')->insert([
            'id' => 6,
            'dica' => 'A Symo está disposta a te ajudar!!! :)'
        ]);
        DB::table('dicas')->insert([
            'id' => 7,
            'dica' => 'Não seja obstinado pela Economia, seja consciente.'
        ]);
        DB::table('dicas')->insert([
            'id' => 8,
            'dica' => 'Não sabe bem por onde começar? Nós te mostramos!'
        ]);
        DB::table('dicas')->insert([
            'id' => 9,
            'dica' => 'O dinheiro pode não ser o que traz felicidade, porém ajuda na busca dela.'
        ]);
        DB::table('dicas')->insert([
            'id' => 10,
            'dica' => 'Organize suas finanças diariamente, aproveite suas pausas e descanse por tê-las organizado.'
        ]);
        DB::table('dicas')->insert([
            'id' => 11,
            'dica' => 'Pensando no futuro, sempre guarde dinheiro para emergências.'
        ]);
        DB::table('dicas')->insert([
            'id' => 12,
            'dica' => 'Anotando todas as suas despesas, é possível construir um futuro mais orgnaizado.'
        ]);
        DB::table('dicas')->insert([
            'id' => 13,
            'dica' => 'Comprando à vista, você evita surpresas indesejadas, livra-se dos juros e pode ganhar descontos.'
        ]);
        DB::table('dicas')->insert([
            'id' => 14,
            'dica' => 'Evite longos parcelamentos para desenvolver uma liberdade financeira.'
        ]);
        DB::table('dicas')->insert([
            'id' => 15,
            'dica' => 'Sempre pesquise e compare preços para encontrar a melhor economia.'
        ]);
        DB::table('dicas')->insert([
            'id' => 16,
            'dica' => 'Evite o uso de cheques especiais.'
        ]);
        DB::table('dicas')->insert([
            'id' => 17,
            'dica' => 'Anote quanto você ganha e planeje a partir disso.'
        ]);
        DB::table('dicas')->insert([
            'id' => 18,
            'dica' => 'Não se esqueça de que diversão também é importante.'
        ]);
    }
}
