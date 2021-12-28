<?php

namespace App\Service;

use App\Http\Requests\PengajuanTAPilihDosbingRequest;
use App\Http\Requests\PengajuanTARequest;
use App\Http\Response\PengajuanTAPilihDosbing;
use App\Http\Response\PengajuanTAResponse;

interface PengajuanTAService
{
    public function pengajuan(PengajuanTARequest $request) : PengajuanTAResponse;
    public function terima(string $id): PengajuanTAResponse;
    public function pilihDosbing(PengajuanTAPilihDosbingRequest $request) : PengajuanTAResponse;
    public function selesai(string $id): PengajuanTAResponse;
}