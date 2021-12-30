<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exceptions\PembayaranException;
use App\Http\Requests\PembayaranRequest;
use App\Service\Impl\PembayaranServiceImpl;
use App\Service\PembayaranService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    private PembayaranService $pembayaranService;

    public function __construct()
    {
        $this->pembayaranService = new PembayaranServiceImpl();
    }

    public function bayar()
    {
        return view("mahasiswa.pembayaran.bayar", [
            "title" => "Pembayaran Pengajuan"
        ]);
    }
    public function postBayar(PembayaranRequest $request)
    {
        try {
            $response = $this->pembayaranService->bayar($request);
            return back()->with("success", "Berhasil membayar pengajuan " . $response->pembayaran->jenis_pengajuan);
        }catch (PembayaranException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }

    }
    // public function statusPembayaran()
    // {
    //     $query = App\Model\Pembayaran::all()->where('nim', '2015150128')->add('status_pembayaran', 'Aktif');
    //     return $query;
    // }

}
