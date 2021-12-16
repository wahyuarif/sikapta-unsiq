<?php

namespace App\Imports;

use App\Sks;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;


class SksImport implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        $jml_sks = 0;

        for ($i=3; $i < 46 ; $i++) { 
            $jml_sks += (int)$row[$i];
        }
        return new Sks([
            'nim' => $row[1],
            'nama' => $row[2],
            'jml_sks' => $jml_sks
        ]);

    }
    
    public function startRow():int {
        return 7;
    }
}
