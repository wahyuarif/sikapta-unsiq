<?php

namespace App\Exports;

use App\Sks;
use Maatwebsite\Excel\Concerns\FromCollection;

class SksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sks::all();
    }
}
