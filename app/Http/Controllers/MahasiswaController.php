<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('user.mahasiswa');
    }

    public function getPosts()
    {
    	$mhs = DB::table('mahasiswa')->select('*');
        return Datatables::of($mhs)
            ->make(true);
    }
}
