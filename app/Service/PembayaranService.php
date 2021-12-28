<?php

namespace App\Service;

use App\Http\Requests\KonfirmasiPembayaranRequest;
use App\Http\Requests\PembayaranRequest;
use App\Http\Response\PembayaranResponse;
use App\Model\Pembayaran;

interface PembayaranService
{
    public function bayar(PembayaranRequest $request): PembayaranResponse;
    public function konfirmasiPembayaran(string $id) : PembayaranResponse;
}