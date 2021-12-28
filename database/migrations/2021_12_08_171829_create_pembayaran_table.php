<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->enum('jenis_pengajuan', ["KP","TA"]);
            $table->string('bukti_pembayaran'); //files(img)
            $table->date('tanggal_bayar')->default(DB::raw('NOW()'));
            $table->string('nim');
            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswa');
            $table->enum('status_pembayaran', ["AKTIF","NONAKTIF", "PROSES"])->default("PROSES"); //non-aktif atau aktif
            $table->timestamps();
            $table->date('masa_berlaku')->default(DB::raw('NOW()'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
