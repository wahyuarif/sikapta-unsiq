<?php

namespace App\Http\Controllers\Kaprodi;

use App\Exceptions\PengajuanKPException;
use App\Http\Requests\PengajuanKPPilihDosenRequest;
use App\Model\Dosen;
use App\Model\PengajuanKP;
use App\Service\Impl\PengajuanKPServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanKPService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanKPController extends Controller
{
    private SessionService $sessionService;
    private PengajuanKPService $pengajuanKPService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
        $this->pengajuanKPService = new PengajuanKPServiceImpl();
    }

    public function index()
    {

        $pengajuanKp = PengajuanKP::whereHas("dosen", function ($query){
            $dosen = $this->sessionService->currentDosen();
            return $query; // ->where("kode_prodi", "=",$dosen->kode_prodi);
        })->where("status", "PENGAJUAN")
            ->get();

        return view("kaprodi.pengajuan-kp.index",[
            "title" => "Pengajuan Kerja Praktek ",
            "pengajuanKP" => $pengajuanKp
        ]);
    }

    public function detail(string $id)
    {
        $prodiId = $this->sessionService->currentDosen()->kode_prodi;
        $pengajuanKp =PengajuanKP::find($id);
        $dosen = Dosen::all();
        return view("kaprodi.pengajuan-kp.detail", [
            "title" => "Detail pengajuan KP",
            "pengajuanKp" => $pengajuanKp,
            "dosen" => $dosen
        ]);
    }

    public function terima($id)
    {
        try {
            $this->pengajuanKPService->terima($id);
            return back()->with("success", "Pengajuan diterima");
        }catch (PengajuanKPException $exception){
            return back()->with("error", $exception->getMessage());
        }
    }

    public function pilihDosbing(PengajuanKPPilihDosenRequest $request)
    {
        try {
            $this->pengajuanKPService->pilihDosbing($request);
            return back()->with("success", "Berhasil membilih dosen pembimbing");
        }catch (PengajuanKPException $exception){
            return back()->with("error", $exception->getMessage());
        }
    }
}
