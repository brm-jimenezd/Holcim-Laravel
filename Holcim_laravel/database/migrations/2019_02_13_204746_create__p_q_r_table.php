<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePQRTable extends Migration
{
    /**
     * Run the migrations.
     * run specific migrations: php artisan migrate --path=/database/migrations/my_migration.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_p_q_r', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question', 200);
            $table->string('answer', 200);
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
        Schema::dropIfExists('_p_q_r');
    }
}
