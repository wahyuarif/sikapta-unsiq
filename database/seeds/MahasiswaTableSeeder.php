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

        $mahasiswa->nim = "2015150128";
        $mahasiswa->nama = "Wahyu Arif Kurniawan";
        $mahasiswa->kode_prodi = "TI";
        $mahasiswa->save();

    }
}
