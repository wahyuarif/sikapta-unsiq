<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exceptions\PengajuanKPException;
use App\Http\Requests\PengajuanKPRequest;
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

<<<<<<< HEAD
    public function edit($id){

    $pengajuanKp = PengajuanKP::find($id);
    // return view('pengajuan.edit')->with(compact('book'));

=======
    public function edit($id)
    {
        $pengajuanKp = PengajuanKP::find($id);
        return view('mahasiswa.pengajuan-kp.edit')->with(compact('pengajuanKp'));
>>>>>>> fe669a934186f47ef999bd370e62bce5db19afa5
    }

    

    public function update(Request $request, $id)
    {
        
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

    public function detail(string $id)
    {
        $pengajuanKp = PengajuanKP::find($id);
        return view("mahasiswa.pengajuan-kp.detail", [
            "title" => "Detail pengajuan KP",
            "pengajuanKp" => $pengajuanKp,
        ]);
    }

    public function cekPembayaran() {

    }

    public function suratTugas()
    {
        $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bulan = $array_bulan[date('n')];
        $tahun = date('Y');
        $mahasiswa = $this->sessionService->currentMahasiswa();
        $pengajuanKp = PengajuanKP::where('nim', $mahasiswa->nim)
                                    ->where('status', 'DITERIMA')
                                    ->firstOrFail();
        $dosen = Dosen::where("nip", $pengajuanKp->nip)->firstOrFail();
        return view('mahasiswa.pengajuan-kp.surat-tugas', [
           "title" => "Surat Tugas",
           "mahasiswa" => $mahasiswa,
           "tahun"     => $tahun,
           "bulan"     => $bulan,
            "dosen" => $dosen
        ]);
    }
}
