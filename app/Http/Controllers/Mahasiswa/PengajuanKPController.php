<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exceptions\PengajuanKPException;
use App\Http\Requests\PengajuanKPRequest;
use App\Model\PengajuanKP;
use App\Service\Impl\PengajuanKPServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanKPService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanKPController extends Controller
{
    //

    private PengajuanKPService $pengajuanKPService;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->pengajuanKPService = new PengajuanKPServiceImpl();
        $this->sessionService = new SessionServiceImpl();
    }


    public function index()
    {
        $pengajuanKP = PengajuanKP::where("nim", $this->sessionService->currentMahasiswa()->nim)
            ->get();

        return view("mahasiswa.pengajuan-kp.index", [
            "title" => "Pengajuan Kerja Praktek",
            "pengajuanKP" => $pengajuanKP
        ]);
    }

    public function pengajuan()
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();
        return view("mahasiswa.pengajuan-kp.pengajuan", [
            "title" => "Form Pengajuan Kerja Praktek",
            "mahasiswa" => $mahasiswa
        ]);
    }

    public function postPengajuan(PengajuanKPRequest $request)
    {
        try {
            $response = $this->pengajuanKPService->pengajuan($request);
            return redirect()->route("mahasiswa.pengajuan.kp.index")->with("success", "Berhasil melakukan pengajuan Kerja Praktek");
        }catch (PengajuanKPException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }
}
