<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->string('nomer_hp');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['L','P']);
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
        Schema::dropIfExists('admin');
    }
}
