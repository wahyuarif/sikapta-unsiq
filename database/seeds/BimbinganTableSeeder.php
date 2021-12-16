<?php

use Illuminate\Database\Seeder;
use App\Bimbingan;

class BimbinganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bimbingan::truncate();
    }
}
