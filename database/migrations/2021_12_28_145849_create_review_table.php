<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pengajuankp_id')
            ->reference('id')
            ->on("pengajuankp");
            $table->string('dosen_id');
            $table->text('review');
            $table->timestamps();
        });
        $table->foreign("user_id")
        ->references("id")
        ->on("user");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
