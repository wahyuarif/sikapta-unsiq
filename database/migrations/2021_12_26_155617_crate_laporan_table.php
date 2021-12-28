<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nim");
            $table->foreign("nim")
                ->references('nim')
                ->on('mahasiswa');
            $table->enum("jenis_pengajuan", ["KP", "TA"]);
            $table->string("file_pdf");
            $table->string("file_doc");
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
        Schema::dropIfExists('migration');
    }
}
