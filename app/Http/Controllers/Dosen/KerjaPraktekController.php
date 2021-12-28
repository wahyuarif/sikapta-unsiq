<?php

namespace App\Http\Controllers\Dosen;

use App\Exceptions\PengajuanKPException;
use App\Model\PengajuanKP;
use App\Service\Impl\PengajuanKPServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Service\PengajuanKPService;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KerjaPraktekController extends Controller
{
    //
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
            return $query->where("nip", "=",$dosen->nip);
        })->orderBy("created_at", "DESC")->paginate(3);

        return view("dosen.kerja-praktek.index",[
            "title" => "Kerja Praktek",
            "pengajuanKP" => $pengajuanKp
        ]);
    }

    public function selesai(string $id)
    {
        try {
            $this->pengajuanKPService->selesai($id);
            return back()->with("success", "Pengajuan diterima");
        }catch (PengajuanKPException $exception){
            return back()->with("error", $exception->getMessage());
        }
    }

}
