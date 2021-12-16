<?php

use App\Pengajuan;
use Illuminate\Database\Seeder;

class PengajuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pengajuan::truncate();
    }
}
