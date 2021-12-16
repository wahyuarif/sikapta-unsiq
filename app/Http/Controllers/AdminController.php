<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// wahyu
use App\Mahasiswa;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
// end wahyu
class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function viewDataMahasiswa(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $mahasiswa = Mahasiswa::select(['nim', 'nama']);
            return Datatables::of($mahasiswa)->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama']);

        return view('user.mahasiswa')->with(compact('html'));
    }

    // public function viewDataDosen(Request $request, Builder $htmlBuilder)
    // {
    //     if($request->ajax()) {
    //         $dosen = Dosen::select(['nm_dosen', 'fakultas', 'prodi', 'jabatan']);
    //         return Datatables::of($dosen)->make(true);
    //     }

    //     $html = $htmlBuilder
    //             ->addColumn(['data' => ])
    // }
}

