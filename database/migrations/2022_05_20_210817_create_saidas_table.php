<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->text('descricao');
            $table->double('valor', 9, 2)->default(0.00);
            $table->bigInteger('id_usuario')->unsigned();;
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->bigInteger('id_categoria')->unsigned();;
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->datetime('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saidas');
    }
}
