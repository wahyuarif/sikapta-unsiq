<?php

namespace App\Imports;

use App\Model\Mahasiswa;
use App\Model\SKS;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SKSImport implements ToCollection, WithStartRow
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {
            $jmlSks = 0;
            for ($i=3; $i < (count($row) - 1) ; $i++) {
                if ($row[$i] == null ){
                    continue;
                }
                $jmlSks += (int)$row[$i];
            }
            if ($row[0] == null ){
                continue;
            }else{
                $mahasiswa = Mahasiswa::where("nim", $row[1])->first();
                if ($mahasiswa == null){
                    continue;
                }else{
                    SKS::updateOrCreate([
                        'nim' => $row[1]
                    ],[
                        'id' => uniqid("sks"),
                        'nim' => $row[1],
                        'jumlah_sks' => $jmlSks
                    ]);
                }
            }
        }

    }

    public function startRow():int {
        return 7;
    }
}
