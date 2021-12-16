<?php

namespace App\Service\Impl;

use App\Http\Requests\SKSImportExcelRequest;
use App\Http\Response\SKSImportExcelResponse;
use App\Imports\SKSImport;
use App\Service\SKSService;
use Maatwebsite\Excel\Facades\Excel;

class SKSServiceImpl implements SKSService
{

    public function importExcel(SKSImportExcelRequest $request): SKSImportExcelResponse
    {

        Excel::import(new SKSImport(), $request->file('file_excel'));

        $response = new SKSImportExcelResponse();
        $response->sks = null;
        return $response;
    }
}