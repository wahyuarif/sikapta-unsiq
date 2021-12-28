<?php

namespace App\Service;

use App\Http\Requests\PengajuanKPPilihDosenRequest;
use App\Http\Requests\PengajuanKPRequest;
use App\Http\Requests\PengajuanKPTerimaRequest;
use App\Http\Response\PengajuanKPResponse;

interface PengajuanKPService
{
    public function pengajuan(PengajuanKPRequest $request): PengajuanKPResponse;
    public function terima(string $id, string $status) : PengajuanKPResponse;
    public function pilihDosbing(PengajuanKPPilihDosenRequest $request) : PengajuanKPResponse;
    public function selesai(string $id): PengajuanKPResponse;
}