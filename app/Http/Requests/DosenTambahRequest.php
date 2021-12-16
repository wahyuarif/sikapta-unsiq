<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenTambahRequest extends FormRequest
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
            "nip" => "required|unique:dosen",
            "nama" => "required",
            "prodi" => "required",
            "jabatan" => "required"
        ];
    }
}
