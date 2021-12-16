<?php


use App\Model\Prodi;
use Illuminate\Database\Seeder;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Prodi::truncate();


        $listProdi = ["Teknik Informatika", "Teknik Sipil", "Arsitektur", "Teknik Mesin", "Managemen Informatika"];
        $listKode = ["TI", "TS", "ARS", "TM", "MI"];

        for ($i = 0 ; $i < count($listProdi); $i++){
            $prodi = new Prodi();
            $prodi->prodi = $listProdi[$i];
            $prodi->kode_prodi = $listKode[$i];
            $prodi->save();
        }
    }
}
