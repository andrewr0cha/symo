<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->double('saldo',12,2)->default(0.00);
            $table->double('cofre',12,2)->default(0.00);
            $table->double('cofreMeta',12,2)->default(0.00);
            $table->string('usuario')->unique();
            $table->string('foto')->default('/images/user.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
