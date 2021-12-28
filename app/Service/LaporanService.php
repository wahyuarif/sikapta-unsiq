<?php

namespace App\Service;

use App\Http\Requests\LaporanUploadKPRequest;
use App\Http\Response\LaporanResponse;

interface LaporanService
{

    public function uploadKP(LaporanUploadKPRequest $request): LaporanResponse;

}