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
            $table->text('descricao')->nullable();
            $table->double('valor', 9, 2)->default(0.00);
            $table->bigInteger('user_id')->unsigned();;
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('cofre')->default(false);
            $table->bigInteger('categorias_id')->unsigned();;
            $table->foreign('categorias_id')->references('id')->on('categorias');
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
