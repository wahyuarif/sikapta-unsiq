<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exceptions\PengajuanTAException;
use App\Http\Requests\PengajuanTARequest;
use App\Model\PengajuanKP;
use App\Model\PengajuanTA;
use App\Service\Impl\PengajuaTAServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanTAService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanTAController extends Controller
{
    private PengajuanTAService $pengajuanTAService;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->pengajuanTAService = new PengajuaTAServiceImpl();
        $this->sessionService = new SessionServiceImpl();
    }
    public function index()
    {
        $pengajuanTA = PengajuanTA::where("nim", $this->sessionService->currentMahasiswa()->nim)
            ->get();

        return view("mahasiswa.pengajuan-ta.index", [
            "title" => "Pengajuan Tugas Akhir",
            "pengajuanTA" => $pengajuanTA
        ]);

    }

    public function postPengajuan(PengajuanTARequest $request)
    {
        try {
            $response = $this->pengajuanTAService->pengajuan($request);
            return redirect()->route("mahasiswa.pengajuan.ta.index")->with("success", "Berhasil melakukan pengajuan Tugas Akhir");
        }catch (PengajuanTAException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }


    public function pengajuan()
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();
        return view("mahasiswa.pengajuan-ta.pengajuan", [
            "title" => "Form Pengajuan Tugas Akhir",
            "mahasiswa" => $mahasiswa
        ]);
    }
}
