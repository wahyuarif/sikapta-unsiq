<?php

namespace App\Service\Impl;

use App\Exceptions\PengajuanKPException;
use App\Exceptions\PengajuanTAException;
use App\Http\Requests\PengajuanTAPilihDosbingRequest;
use App\Http\Requests\PengajuanTARequest;
use App\Http\Response\PengajuanTAResponse;
use App\Model\Dosen;
use App\Model\Pembayaran;
use App\Model\PengajuanKP;
use App\Model\PengajuanTA;
use App\Service\PengajuanTAService;
use App\Service\SessionService;
use Illuminate\Support\Facades\DB;

class PengajuaTAServiceImpl implements PengajuanTAService
{

    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function pengajuan(PengajuanTARequest $request): PengajuanTAResponse
    {
        $this->validasiPengajuanTA($request);
        $mahasiswa = $this->sessionService->currentMahasiswa();
        $dosen = Dosen::where("kode_prodi", $mahasiswa->kode_prodi)->where("jabatan", "kaprodi")->first();

        try {
            DB::beginTransaction();

            $proposal = $this->saveFile($request, $mahasiswa);

            $pengajuanTa = new PengajuanTA();
            $pengajuanTa->id = "TA-" . strtoupper(str_random(5));
            $pengajuanTa->nim = $mahasiswa->nim;
            $pengajuanTa->judul = $request->judul;
            $pengajuanTa->nip = $dosen->nip;
            $pengajuanTa->status = "PENGAJUAN";
            $pengajuanTa->proposal = $proposal;
            $pengajuanTa->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new PengajuanTAResponse();
        $response->pengajuanTA = $pengajuanTa;

        return $response;
    }

    private function validasiPengajuanTA(PengajuanTARequest $request)
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();
        // cek apakah kp sudah selesai
        $pengajuanKp = PengajuanKP::where("nim", $mahasiswa->nim)
            ->where("selesai", 1)->first();

        if ($pengajuanKp == null ){
            throw new PengajuanTAException("Kerja Praktek belem selesai");
        }

        // cek pembayaran
        $pembayaran = Pembayaran::where("nim", $mahasiswa->nim)->where("jenis_pengajuan", "KP")
            ->where("status_pembayaran", "AKTIF")->first();
        if ($pembayaran == null){
            throw new PengajuanTAException("Belum membayar pengajuan Kerja Praktek");
        }

        // cek kaprodi
        $dosen = Dosen::where("kode_prodi", $mahasiswa->kode_prodi)->where("jabatan", "kaprodi")->first();
        if ($dosen == null){
            throw new PengajuanKPException("Kaprodi belum ada");
        }
    }


    private function saveFile(PengajuanTARequest $request, \App\Model\Mahasiswa $mahasiswa): string
    {
        $proposal = $request->file('proposal');
        $namaFile = uniqid($mahasiswa->nim) . "." . $proposal->getClientOriginalExtension();

        $proposal->move(storage_path("app/public/proposal"),$namaFile);

        return $namaFile;
    }

    public function terima(string $id): PengajuanTAResponse
    {
        $this->validariIdPengajuan($id);

        $pengajuanTA = PengajuanTA::find($id);

        try {
            DB::beginTransaction();

            $pengajuanTA->update(["status" => "DITERIMA"]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $response = new PengajuanTAResponse();
        $response->pengajuanTA = $pengajuanTA;

        return $response;
    }

    private function validariIdPengajuan(string $id)
    {
        if ($id == null){
            throw new PengajuanKPException("id tidak ditemukan");
        }
    }

    public function pilihDosbing(PengajuanTAPilihDosbingRequest $request): PengajuanTAResponse
    {
        try {
            DB::beginTransaction();

            $pengajuanTA = PengajuanTA::where("id", $request->id)
                ->update(["nip" => $request->nip]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $pengajuanKP = PengajuanKP::find($request->id);

        $response = new PengajuanTAResponse();
        $response->pengajuanTA = $pengajuanTA;

        return $response;
    }

    public function selesai(string $id): PengajuanTAResponse
    {
        $this->validariIdPengajuan($id);

        $pengajuanTA = PengajuanTA::find($id);

        try {
            DB::beginTransaction();

            $pengajuanTA->update(["selesai" => 1]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $response = new PengajuanTAResponse();
        $response->pengajuanTA = $pengajuanTA;
        return $response;
    }
}