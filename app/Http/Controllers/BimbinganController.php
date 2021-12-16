<?php

namespace App\Http\Controllers;

use App\Bimbingan;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class BimbinganController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:dosen')->only(['indexDosen', 'bimbinganMahasiswa']);
        $this->middleware('auth:web')->only(['indexMahasiswa']);
        
    }

    public function indexMahasiswa()
    {
        $id = Auth::user()->mahasiswa_id;

        $bimbinganKP =  Bimbingan::whereHas('pengajuan', function($query){
            return $query->where('jns_pengajuan','=','KP');
        })->where('mahasiswa_id' , $id)->get();

        $bimbinganTA =  Bimbingan::whereHas('pengajuan', function($query){
            return $query->where('jns_pengajuan','=','TA');
        })->where('mahasiswa_id' , $id)->get();

      
        $selesai =  Bimbingan::where([
            'mahasiswa_id'=> $id,
            'status' => 'Selesai'
            ])->count();



        if ($selesai > 0) {
            return view('bimbingan.index', ['bimbingans' => $bimbinganTA, 'selesai' => $selesai]);
        }else{
            return view('bimbingan.index', ['bimbingans' => $bimbinganKP , 'selesai' => $selesai]);
        }

    }

    public function indexDosen()
    {
        $dosen_id = Auth::user()->id;

        $data['bimbingans'] = Bimbingan::where([
            'dosen_id' => $dosen_id,
            'status' => 'Bimbingan'
            ])
            ->whereNotNull('file_bimbingan')
            ->groupBy('pengajuan_id')
            ->get();
        // dd($dosen_id);
        // dd($data['bimbingans']);
        return view('bimbingan.indexDosen', $data);
    }

    public function bimbinganMahasiswa($mahasiswa_id)
    {
        // dd(Auth::user());
        $data['bimbingans'] =  Bimbingan::where([
            'mahasiswa_id'=> $mahasiswa_id,
            'dosen_id' => Auth::user()->id,
            ])->whereNotNull('file_bimbingan')->get();
        
        return view('bimbingan.mahasiswa', $data);
    }

    public function uploadBab(Request $request, $id)
    {
        $this->validate($request, [
            'file_upload' => 'required|mimes:pdf,docs'
        ]);

        $file = $request->file('file_upload');

       
        $file_name = time();

        $tujuan_upload = 'file/file_bimbingan';
	    $file->move($tujuan_upload,$file->getClientOriginalName());

        $bimbingan = Bimbingan::find($id);
        $bimbingan->file_bimbingan = $file_name;
        $bimbingan->save();

        Session::flash('msg', 'Berhasil Upload File');

        return redirect(route('bimbingan.mahasiswa'));       
    }

    public function uploadRevisi(Request $request, $id)
    {
        $this->validate($request, [
            'file_upload' => 'required|mimes:pdf,docs'
        ]);

        $file = $request->file('file_upload');

       
        $file_name = 'revisi-'.time();

        $tujuan_upload = 'file/file_bimbingan';
	    $file->move($tujuan_upload,$file->getClientOriginalName());

        $bimbingan = Bimbingan::find($id);
        $bimbingan->file_bimbingan = $file_name;
        $bimbingan->save();

        Session::flash('msg', 'Berhasil Upload File');

        return redirect(route('bimbingan.mahasiswa'));       
    }
    

    public function terima($id)
    {
        
        $bimbingan0 = Bimbingan::where('id', $id)->first();

        if ($bimbingan0->bab == 5) {
            $bimbingan1 = Bimbingan::find($id);
            $bimbingan1->status = 'Selesai';
            $bimbingan1->save();
            Session::flash('msg', 'Pengajuan Berhasil Diterima');

            return redirect(route('bimbingan.mahasiswa.show', $bimbingan0->mahasiswa_id));
        }else{

            $bimbingan1 = Bimbingan::find($id);
            $bimbingan1->status = 'Terima';
            $bimbingan1->save();
            $bimbingan2 = [
                'kd_bimbingan' => rand(),
                'pengajuan_id' => $bimbingan0->pengajuan_id,
                'dosen_id' => $bimbingan0->dosen_id,
                'mahasiswa_id' => $bimbingan0->mahasiswa_id,
                'bab' => $bimbingan0->bab+1,
                'tgl_bimbingan' => null,
                'status' => 'Bimbingan',
            ];
    
            Bimbingan::create($bimbingan2);
    
            Session::flash('msg', 'Pengajuan Berhasil Diterima');
    
            return redirect()->back();
        }
        

    }

    public function revisi(Request $request)
    {
            
        $this->validate($request, [
            'catatan' => 'required',
            'file_revisi' => 'required|mimes:pdf,docs'
        ]);

        $file = $request->file('file_revisi');

       
        $file_name = time();

        $tujuan_upload = 'file/file_revisi';

	    $file->move($tujuan_upload,$file->getClientOriginalName());

        $bimbingan = Bimbingan::findOrFail($request->id_bimbingan);

        $bimbingan->revisi()->create([
            'file_revisi' => $file_name,
            'catatan' => $request->catatan
        ]);

        $bimbingan->status = 'Revisi';
        $bimbingan->save();
        
        Session::flash('msg', 'Berhasil Membuat Revisi');

        return redirect()->back();
    }
}
