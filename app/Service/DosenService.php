<?php

namespace App\Service;

use App\Http\Requests\DosenTambahRequest;
use App\Http\Response\DosenTambahResponse;

interface DosenService
{

    public function tambah(DosenTambahRequest $request): DosenTambahResponse;

}