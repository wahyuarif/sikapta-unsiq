<?php

namespace App\Http\Controllers;

use App\Sks;
use App\Imports\SksImport;
use App\Exports\SksExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class SksController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        $data['sks'] = Sks::all();

        return view('sks.index', $data);
    }

    public function exportExcel(){
        return Excel::download(new SksExport, 'sks.xlsx');
    }

    public function importExcel( Request $request ){

        Sks::truncate();
        // dd($request);

        $this->validate($request, [
            'file' => 'required|mimes:cvs,xls,xlsx'
        ]);

        $file = $request->file;

        // dd($file);

        // Membuat nama file
        $namaFile = rand().$file->getClientOriginalName();

        $file->move('file_siswa', $namaFile);

        Excel::import(new SksImport, public_path('/file_siswa/' . $namaFile));

        Session::flash('sukses', 'Data SKS berhasil di import');

        return redirect()->back();

    }
    
}
