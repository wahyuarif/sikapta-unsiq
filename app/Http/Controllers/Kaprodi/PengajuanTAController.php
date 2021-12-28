<?php

namespace App\Http\Controllers\Kaprodi;

use App\Exceptions\PengajuanTAException;
use App\Model\Dosen;
use App\Model\PengajuanTA;
use App\Service\Impl\PengajuaTAServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanTAService;
use App\Service\SessionService;
use App\Http\Controllers\Controller;

class PengajuanTAController extends Controller
{

    private SessionService $sessionService;
    private PengajuanTAService $pengajuanTAService;
    //
    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
        $this->pengajuanTAService = new PengajuaTAServiceImpl();
    }

    public function index()
    {

        $pengajuanTA = PengajuanTA::whereHas("dosen", function ($query){
            $dosen = $this->sessionService->currentDosen();
            return $query->where("kode_prodi", "=",$dosen->kode_prodi);
        })->where("status", "PENGAJUAN")
            ->get();

        return view("kaprodi.pengajuan-ta.index",[
            "title" => "Pengajuan Tugas Akhir ",
            "pengajuanTA" => $pengajuanTA
        ]);
    }

    public function detail(string $id)
    {
        $prodiId = $this->sessionService->currentDosen()->kode_prodi;
        $pengajuanTA = PengajuanTA::find($id);
        $dosen = Dosen::all();
        return view("kaprodi.pengajuan-ta.detail", [
            "title" => "Detail pengajuan Tugas Akhir",
            "pengajuanTA" => $pengajuanTA,
            "dosen" => $dosen
        ]);
    }

    public function terima($id)
    {
        try {
            $this->pengajuanTAService->terima($id);
            return back()->with("success", "Pengajuan diterima");
        }catch (PengajuanTAException $exception){
            return back()->with("error", $exception->getMessage());
        }
    }



}
