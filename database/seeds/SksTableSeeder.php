<?php

use App\Model\SKS;
use Illuminate\Database\Seeder;

class SksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sks::truncate();

        $sks1 = 
        [
            'id' => uniqid(),
            'nim' => '2019150080',
            'jumlah_sks' => 110
        ];
            
        $sks2 =
        [
            'id' => uniqid(),
            'nim' => '2015150128',
            'jumlah_sks' => 110
        ];
        

        Sks::create($sks1);
        Sks::create($sks2);
    }

}
