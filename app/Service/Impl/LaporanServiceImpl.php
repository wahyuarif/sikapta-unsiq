<?php

namespace App\Service\Impl;

use App\Exceptions\LaporanException;
use App\Http\Requests\LaporanUploadKPRequest;
use App\Http\Requests\LaporanUploadRequest;
use App\Http\Response\LaporanResponse;
use App\Model\Laporan;
use App\Model\Mahasiswa;
use App\Model\PengajuanKP;
use App\Service\LaporanService;
use Illuminate\Support\Facades\DB;

class LaporanServiceImpl implements LaporanService
{


    public function uploadKP(LaporanUploadKPRequest $request): LaporanResponse
    {

        $this->validasiUploadKP($request);

        $mahasiswa = Mahasiswa::where("nim", $request->nim)->first();

        try {
            DB::beginTransaction();

            $filePdf = $this->saveFilePdf($request, $mahasiswa);
            $fileDoc = $this->saveFileDoc($request, $mahasiswa);

            $laporan = new Laporan();
            $laporan->nim = $request->nim;
            $laporan->jenis_pengajuan = "KP";
            $laporan->file_pdf = $filePdf;
            $laporan->file_doc = $fileDoc;
            $laporan->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new LaporanResponse();
        $response->laporan = $laporan;
        return $response;
    }
    
    private function validasiUploadKP(LaporanUploadKPRequest $request){
        $pengajuanKP = PengajuanKP::where("nim", $request->nim)
            ->where("selesai", 1)->first();

        $laporan = Laporan::where("nim", $request->nim)->where("jenis_pengajuan", "KP")->first();

        if ($pengajuanKP == null){
            throw new LaporanException("Gagal upload laporan, Kerja Praktek belum selesai");
        }

        if ($laporan != null){
            throw new LaporanException("Sudah pernah upload laporan");
        }
    }


    private function saveFilePdf(LaporanUploadKPRequest $request, \App\Model\Mahasiswa $mahasiswa): string
    {
        $filePdf = $request->file('file_pdf');
        $namaFile = uniqid($mahasiswa->nim) . "." . $filePdf->getClientOriginalExtension();

        $filePdf->move(storage_path("app/public/laporan/pdf"),$namaFile);

        return $namaFile;
    }

    private function saveFileDoc(LaporanUploadKPRequest $request, \App\Model\Mahasiswa $mahasiswa): string
    {
        $fileDoc = $request->file('file_doc');
        $namaFile = uniqid($mahasiswa->nim) . "." . $fileDoc->getClientOriginalExtension();

        $fileDoc->move(storage_path("app/public/laporan/doc"),$namaFile);

        return $namaFile;
    }
}