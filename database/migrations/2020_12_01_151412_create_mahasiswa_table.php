<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->string("alamat")->nullable();
            $table->enum("jenis_kelamin", ["L","P"])->nullable();
            $table->string("foto")->nullable();
            $table->string('nomer_hp')->nullable();
            $table->string('kode_prodi')->nullable();
            $table->foreign('kode_prodi')
                ->references('kode_prodi')
                ->on('prodi');
            $table->enum('status', ['active', 'unactive'])->nullable();
            $table->string("user_id")->nullable();
            $table->foreign("user_id")
                ->references("id")
                ->on("user");
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
        Schema::dropIfExists('mahasiswa');
    }
}
