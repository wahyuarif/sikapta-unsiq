<?php

namespace App\Service;

use App\Http\Requests\SKSImportExcelRequest;
use App\Http\Response\SKSImportExcelResponse;

interface SKSService
{
    public function importExcel(SKSImportExcelRequest $request): SKSImportExcelResponse;

}