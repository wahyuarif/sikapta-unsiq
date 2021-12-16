<?php

use App\Model\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->truncate();

        $mahasiswa->nim = "2019150080";
        $mahasiswa->nama = "Ahmad Rifai";
        $mahasiswa->kode_prodi = "TI";
        $mahasiswa->save();

    }
}
