<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sks', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nim');
            $table->foreign("nim")
                ->references("nim")
                ->on("mahasiswa");
            $table->integer('jumlah_sks');
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
        Schema::dropIfExists('sks');
    }
}
