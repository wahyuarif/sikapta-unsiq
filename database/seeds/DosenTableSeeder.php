<?php

use Illuminate\Database\Seeder;

class DosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = new \App\Model\Dosen();
        $dosen->truncate();

        $dosen->nip = "3325051607010001";
        $dosen->nama = "Hidayatus Sibyan";
        $dosen->kode_prodi = "TI";
        $dosen->status = "aktif";
        $dosen->jabatan = "kaprodi";

        $dosen->save();
    }
}
