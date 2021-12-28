<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuantaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuanta', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("nim")
                ->references("nim")
                ->on("mahasiswa");
            $table->string('judul');
            $table->string("nip");
            $table->foreign("nip")
                ->references("nip")
                ->on("dosen");
            $table->enum('status', ['DITERIMA', 'DITOLAK', 'PENGAJUAN'])->default("PENGAJUAN");
            $table->boolean('selesai');
            $table->string('proposal');
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
        Schema::dropIfExists('pengajuanta');
    }
}
