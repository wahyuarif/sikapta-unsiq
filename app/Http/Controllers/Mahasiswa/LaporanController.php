<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exceptions\LaporanException;
use App\Http\Requests\LaporanUploadKPRequest;
use App\Model\Laporan;
use App\Service\Impl\LaporanServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\LaporanService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    //

    private LaporanService $laporanService;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->laporanService = new LaporanServiceImpl();
        $this->sessionService = new SessionServiceImpl();
    }


    public function kerjaPraktek()
    {
        $laporan = Laporan::where("nim", $this->sessionService->currentMahasiswa()->nim)->first();

        return view("mahasiswa.laporan.index",[
            "title" => "Laporan Kerja Praktek",
            "laporan" => $laporan
        ]);
    }

    public function uploadKP()
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();
        return view("mahasiswa.laporan.upload-kp", [
            "title" => "Upload Laporan Kerja Praktek",
            "mahasiswa" => $mahasiswa
        ]);
    }

    public function postUploadKP(LaporanUploadKPRequest $request)
    {

        try {
            $response = $this->laporanService->uploadKP($request);
            return back()->with("success", "Berhasil upload laporan");
        }catch (LaporanException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }

}
