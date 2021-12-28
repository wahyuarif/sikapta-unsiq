<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuankpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuankp', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("nim");
            $table->foreign("nim")
                ->references("nim")
                ->on("mahasiswa");
            $table->string("nip")->nullable();
            $table->foreign("nip")
                ->references("nip")
                ->on("dosen");
            $table->string('judul');
            $table->string('lokasi');
            $table->string('nama_instansi');
            $table->string('alamat');
            $table->integer('jumlah_pegawai');
            $table->string('bidang_pekerjaan');
            $table->string('deskripsi_pekerjaan');
            $table->enum('status', ['DITERIMA', 'DITOLAK', 'PENGAJUAN', 'DITERIMA DENGAN SYARAT'])->default("PENGAJUAN");
            $table->boolean('selesai');
            $table->string('kerangka_pikir');
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
        Schema::dropIfExists('pengajuankp');
    }
}
