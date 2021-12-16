<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('nama');
            $table->string('kode_prodi');
            $table->foreign('kode_prodi')
                ->references('kode_prodi')
                ->on('prodi');
            $table->string('status');
            $table->enum('jabatan', ['kaprodi', 'dosen', 'dekan']);
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
        Schema::dropIfExists('dosen');
    }
}
