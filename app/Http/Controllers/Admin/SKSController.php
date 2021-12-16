<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SKSImportExcelRequest;
use App\Model\SKS;
use App\Service\Impl\SKSServiceImpl;
use App\Service\SKSService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SKSController extends Controller
{
    private SKSService $sksService;

    public function __construct()
    {
        $this->sksService = new SKSServiceImpl();
    }

    public function index()
    {
        $sks = SKS::paginate();

        return view("admin.sks.index", [
            "title" => "SKS Mahasiswa",
            "sks" => $sks
        ]);
    }

    public function importExcel(SKSImportExcelRequest $request)
    {
        $this->sksService->importExcel($request);
        return back()->with("success", "Berhasil menambah data SKS mahasiswa");
    }

    public function startRow():int {
        return 7;
    }

}
