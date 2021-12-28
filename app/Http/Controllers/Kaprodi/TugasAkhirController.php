<?php

namespace App\Http\Controllers\Kaprodi;

use App\Model\PengajuanTA;
use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TugasAkhirController extends Controller
{

    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function index()
    {

        $pengajuanTA = PengajuanTA::whereHas("dosen", function ($query){
            $dosen = $this->sessionService->currentDosen();
            return $query->where("nip", "=",$dosen->nip);
        })->orderBy("created_at", "DESC")->paginate(3);

        return view("kaprodi.tugas-akhir.index",[
            "title" => "Tugas Akhir",
            "pengajuanTA" => $pengajuanTA
        ]);
    }

}
