<?php

namespace App\Service\Impl;

use App\Exceptions\PembayaranException;
use App\Http\Requests\PembayaranRequest;
use App\Http\Response\PembayaranResponse;
use App\Model\Pembayaran;
use App\Service\PembayaranService;
use App\Service\SessionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranServiceImpl implements PembayaranService
{

    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }

    public function bayar(PembayaranRequest $request): PembayaranResponse
    {

        $this->validasiPembayaran($request);

        $mahasiswa = $this->sessionService->currentMahasiswa();


        try {
            DB::beginTransaction();

            $buktiPembayaran = $this->saveFile($request, $mahasiswa);

            $pembayaran = new Pembayaran();
            $pembayaran->id = uniqid("bayar-");
            $pembayaran->jenis_pengajuan =  $request->jenis_pengajuan;
            $pembayaran->bukti_pembayaran = $buktiPembayaran;
            $pembayaran->nim = $mahasiswa->nim;
            $pembayaran->status_pembayaran = "AKTIF";
            $pembayaran->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new PembayaranResponse();
        $response->pembayaran = $pembayaran;

        return $response;
    }

    private function validasiPembayaran(PembayaranRequest $request){
        // validasi mahasiswa login
        $mahasiswa = $this->sessionService->currentMahasiswa();


        if ($mahasiswa == null)
        {
            throw new PembayaranException("error : mahasiswa tidak diketahui");
        }
        // apakah sudah pernah membayar
        $pembayaran = Pembayaran::where("nim" , $mahasiswa->nim)
            ->where("jenis_pengajuan", $request->jenis_pengajuan)
            ->where("status_pembayaran", "AKTIF")->first();

        if ($pembayaran != null)
        {
            throw new PembayaranException("Pengajuan " . $pembayaran->jenis_pengajuan . " Sudah terbayar");
        }
    }

    private function saveFile(PembayaranRequest $request, \App\Model\Mahasiswa $mahasiswa): string
    {
        $buktiPembayaran = $request->file('bukti_pembayaran');
        $namaFile = uniqid($mahasiswa->nim) . "." . $buktiPembayaran->getClientOriginalExtension();

        $buktiPembayaran->move(storage_path("app/public/bukti_bayar"),$namaFile);

        return $namaFile;
    }

}