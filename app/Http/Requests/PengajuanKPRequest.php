<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanKPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "judul" => "required",
            "lokasi" => "required",
            "nama_instansi" => "required",
            "alamat" => "required",
            "jumlah_pegawai" => "required",
            "bidang_pekerjaan" => "required",
            "deskripsi_pekerjaan" => "required",
            "kerangka_pikir" => "required|mimes:pdf",
        ];
    }
}
