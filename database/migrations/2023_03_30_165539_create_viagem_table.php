<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viagem', function (Blueprint $table) {
            $table->id();
            $table->double('valor', 9, 2)->default(0.00);
            $table->bigInteger('id_cartao')->unsigned();
            $table->foreign('id_cartao')->references('id')->on('cartaos');
            $table->datetime('data')->nullable()->default(null);
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
        Schema::dropIfExists('viagem');
    }
}
