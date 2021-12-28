<?php

namespace App\Service\Impl;

use App\Exceptions\PengajuanKPException;
use App\Http\Requests\PengajuanKPPilihDosenRequest;
use App\Http\Requests\PengajuanKPRequest;
use App\Http\Requests\PengajuanKPTerimaRequest;
use App\Http\Response\PengajuanKPResponse;
use App\Model\Dosen;
use App\Model\Pembayaran;
use App\Model\PengajuanKP;
use App\Model\SKS;
use App\Service\PengajuanKPService;
use App\Service\SessionService;
use Illuminate\Support\Facades\DB;

class PengajuanKPServiceImpl implements PengajuanKPService
{

    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function pengajuan(PengajuanKPRequest $request): PengajuanKPResponse
    {

        $this->validasiPengajuan($request);

        $mahasiswa = $this->sessionService->currentMahasiswa();
        // $dosen = Dosen::where("kode_prodi", $mahasiswa->kode_prodi)->where("jabatan", "kaprodi")->first();

        try {
            DB::beginTransaction();

            $kerangkaPikir = $this->saveFile($request, $mahasiswa);

            $pengajuanKP = new PengajuanKP();
            $pengajuanKP->id = "KP-" . strtoupper(str_random(5));
            $pengajuanKP->nim = $mahasiswa->nim;
            $pengajuanKP->nip = null; // $dosen->nip;
            $pengajuanKP->judul = $request->judul;
            $pengajuanKP->lokasi = $request->lokasi;
            $pengajuanKP->alamat = $request->alamat;
            $pengajuanKP->nama_instansi = $request->nama_instansi;
            $pengajuanKP->jumlah_pegawai = $request->jumlah_pegawai;
            $pengajuanKP->bidang_pekerjaan = $request->bidang_pekerjaan;
            $pengajuanKP->deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
            $pengajuanKP->kerangka_pikir = $kerangkaPikir;
            $pengajuanKP->save();

            DB::commit();
        }catch (PengajuanKPException $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new PengajuanKPResponse();
        $response->pengajuanKP = $pengajuanKP;

        return $response;

    }

    private function validasiPengajuan(PengajuanKPRequest $request)
    {
        // cek apakah sudah memnuhi syarat
        // cek jumlah sks
        $sks = SKS::where("nim", $request->nim)->first();

        if ($sks == null ){
            throw new PengajuanKPException("Sks belum memenuhi untuk mendaftar Kerja Praktek , silahkan hubungi admin untuk dapat malanjutkan");
        }

        if ($sks->jumlah_sks <= 10){
            throw new PengajuanKPException("Sks belum memenuhi untuk mendaftar Kerja Praktek");
        }
        // cek pembayaran
        $mahasiswa = $this->sessionService->currentMahasiswa();
        // $pembayaran = Pembayaran::where("nim", $mahasiswa->nim)->where("jenis_pengajuan", "KP")->first();
        // if ($pembayaran == null){
        //     throw new PengajuanKPException("Belum membayarar pengajuan Kerja Praktek");
        // }

        // cek kaprodi
        $dosen = Dosen::where("kode_prodi", $mahasiswa->kode_prodi)->where("jabatan", "kaprodi")->first();
        if ($dosen == null){
            throw new PengajuanKPException("Kaprodi belum ada");
        }
    }

    private function saveFile(PengajuanKPRequest $request, \App\Model\Mahasiswa $mahasiswa): string
    {
        $buktiPembayaran = $request->file('kerangka_pikir');
        $namaFile = uniqid($mahasiswa->nim) . "." . $buktiPembayaran->getClientOriginalExtension();

        $buktiPembayaran->move(storage_path("app/public/kerangka_pikir"),$namaFile);

        return $namaFile;
    }

    public function terima(string $id): PengajuanKPResponse
    {
        $this->validariIdPengajuan($id);

        $pengajuanKP = PengajuanKP::find($id);

        try {
            DB::beginTransaction();

            $pengajuanKP->update(["status" => "DITERIMA"]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $response = new PengajuanKPResponse();
        $response->pengajuanKP = $pengajuanKP;

        return $response;
    }

    private function validariIdPengajuan(string $id)
    {
        if ($id == null){
            throw new PengajuanKPException("id tidak ditemukan");
        }
    }

    public function pilihDosbing(PengajuanKPPilihDosenRequest $request): PengajuanKPResponse
    {
        try {
            DB::beginTransaction();

            $pengajuanKP = PengajuanKP::where("id", $request->id)
                ->update(["nip" => $request->nip]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $pengajuanKP = PengajuanKP::find($request->id);

        $response = new PengajuanKPResponse();
        $response->pengajuanKP = $pengajuanKP;

        return $response;
    }

    public function selesai(string $id): PengajuanKPResponse
    {
        $this->validariIdPengajuan($id);

        $pengajuanKP = PengajuanKP::find($id);

        try {
            DB::beginTransaction();

            $pengajuanKP->update(["selesai" => 1]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }


        $response = new PengajuanKPResponse();
        $response->pengajuanKP = $pengajuanKP;

        return $response;
    }
}