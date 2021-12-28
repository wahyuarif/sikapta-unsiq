<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\PembayaranException;
use App\Http\Requests\KonfirmasiPembayaranRequest;
use App\Model\Pembayaran;
use App\Service\Impl\PembayaranServiceImpl;
use App\Service\PembayaranService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    //

    private PembayaranService $pembayaranService;

    public function __construct()
    {
        $this->pembayaranService = new PembayaranServiceImpl();
    }


    public function pembayaranKP()
    {
        $pembayaran = Pembayaran::where("jenis_pengajuan", "KP")->orderBy("created_at", "DESC")->paginate(10);

        return view("admin.pembayaran.index", [
            "title" => "Pembayaran Pengajuan KP",
            "pembayaran" => $pembayaran
        ]);
    }

    public function konfirmasiPembayaran(string $id)
    {
        try {
            $this->pembayaranService->konfirmasiPembayaran($id);
            return back()->with("success", "Berhasil Konfirmasi Pembayaran");
        }catch (\Exception $exception){
            return back()->with("error", $exception->getMessage());
        }
    }
}
