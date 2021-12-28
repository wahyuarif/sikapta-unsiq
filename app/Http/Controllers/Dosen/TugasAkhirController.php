<?php

namespace App\Http\Controllers\Dosen;

use App\Exceptions\PengajuanTAException;
use App\Model\PengajuanTA;
use App\Service\Impl\PengajuaTAServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanTAService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TugasAkhirController extends Controller
{
    private SessionService $sessionService;
    private PengajuanTAService $pengajuanTAService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
        $this->pengajuanTAService = new PengajuaTAServiceImpl();
    }


    public function index()
    {

        $pengajuanTA = PengajuanTA::whereHas("dosen", function ($query){
            $dosen = $this->sessionService->currentDosen();
            return $query->where("nip", "=",$dosen->nip);
        })->orderBy("created_at", "DESC")->paginate(3);

        return view("dosen.tugas-akhir.index",[
            "title" => "Tugas Akhir",
            "pengajuanTA" => $pengajuanTA
        ]);
    }

    public function selesai(string $id)
    {
        try {
            $this->pengajuanTAService->selesai($id);
            return back()->with("success", "Pengajuan diterima");
        }catch (PengajuanTAException $exception){
            return back()->with("error", $exception->getMessage());
        }
    }

}
