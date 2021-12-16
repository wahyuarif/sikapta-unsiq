<?php

namespace App\Service;

use App\Http\Requests\MahasiswaTambahRequest;
use App\Http\Response\MahasiswaTambahResponse;

interface MahasiswaService
{

    public function tambah(MahasiswaTambahRequest $request) : MahasiswaTambahResponse;

}