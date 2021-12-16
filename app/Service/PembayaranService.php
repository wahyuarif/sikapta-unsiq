<?php

namespace App\Service;

use App\Http\Requests\PembayaranRequest;
use App\Http\Response\PembayaranResponse;

interface PembayaranService
{
    public function bayar(PembayaranRequest $request): PembayaranResponse;
}