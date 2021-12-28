<?php

namespace App\Http\Controllers\Dosen;

use App\Model\PengajuanKP;
use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanKPController extends Controller
{
    //
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function index()
    {

        $pengajuanKp = PengajuanKP::whereHas("dosen", function ($query){
            $dosen = $this->sessionService->currentDosen();
            return $query->where("nip", "=",$dosen->nip);
        })->get();

        return view("dosen.kerja-praktek.index",[
            "title" => "Kerja Praktek",
            "pengajuanKP" => $pengajuanKp
        ]);
    }

    public function selesaiKp()
    {

    }

}
