<?php

namespace App\Http\Controllers;

use Session;
use App\Bimbingan;
use App\Dosen;
use App\Mahasiswa;
use App\Pengajuan;
use App\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Session\Session;

class PengajuanKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth:dosen')->except(['formPengajuan', 'kpSubmit', 'status']);
         $this->middleware('auth:web')->only(['formPengajuan', 'kpSubmit', 'status']);
     }

    public function status()
    {
        $id = Auth::user()->mahasiswa_id;
        $data['ditolak'] = Pengajuan::where([
            'mahasiswa_id'=> $id,
            'status' => 'Ditolak'
        ])->get();
        $data['terima'] = Pengajuan::where([
            'mahasiswa_id'=> $id,
            'status' => 'Diterima'
        ])->get();
        
        $id = Auth::user()->mahasiswa_id;
        $data['pengajuans'] = Pengajuan::where('mahasiswa_id', $id)->get();

        return view('pengajuanKP.status', $data);
    }

    public function index()
    {
        $dosenId = Auth::user()->id;

        if (Auth::user()->jabatan == 'kaprodi' OR Auth::user()->jabatan == 'dekan') {
            
            $data['pengajuans'] =  Pengajuan::where([
                ['dosen_id' ,'=', $dosenId],
                ['selesai' ,'=', 0],
                ['status', '=', 'Pengajuan'],
            ])->get();
    
            // dd($pengajuan);
            return view('pengajuanKP.index', $data);
        }else{
            return "Page not found";
        }
        
        
    }
    

    public function formPengajuan()
    {
        $id = Auth::user()->mahasiswa_id;
        $pengajuan = Pengajuan::where('mahasiswa_id', $id)->count();

        $data['pengajuans'] = Pengajuan::where('mahasiswa_id', $id)->get();
 
        $data['ditolak'] = Pengajuan::where([
            'mahasiswa_id'=> $id,
            'status' => 'Ditolak'
        ])->get();
        $data['terima'] = Pengajuan::where([
            'mahasiswa_id'=> $id,
            'status' => 'Diterima'
        ])->get();


        if ($pengajuan == null) {
            return view('pengajuanKP.formPengajuan');
        }else{
            return view('pengajuanKP.status' , $data);
        }
    }

    public function kpSubmit(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'bidang_pekerjaan' => 'required',
            'deskripsi' => 'required',
            'jml_pegawai' => 'required',
            'kompleksitas_pekerjaan' => 'required',
            'lokasi' => 'required',
            'nm_instansi' => 'required',
            'phone' => 'required',
            'kerangka_pikir' => 'required|mimes:pdf,docs'
        ]);

        // dd($request->file('kerangka_pikir')->getClientOriginalName());
        $nim = Auth::user()->mahasiswa->nim;

        $kerangkaPikir = $this->_uploadFile($nim, $request->file('kerangka_pikir'));

        // dd($kerangkaPikir);

        $mhs = Mahasiswa::where('nim', $nim)->first();
        $kaprodi = Dosen::where([
            'jabatan' => 'kaprodi', 
            'prodi_id'=> $mhs['prodi_id']
            ])->first();

        // dd($kaprodi);
        $kaprodiId = $kaprodi['id'];
        $mahasiswaId = $mhs['id'];
        

        // dd($kaprodiId);
        // dd($request);
        
        $prodi = Prodi::where('id', $mhs['prodi_id'])->first();
        $kdProdi = $prodi['kode_prodi'];

        $date = getdate();

        $year = $date['year'];
        $mon = $date['mon'];
        $back = Pengajuan::count() + 1;




        $noPengajuan = $kdProdi.'KP'.$mon.$year.'00'.$back;

                

        $pengajuan = [
            'dosen_id' => $kaprodiId,
            'mahasiswa_id' => $mahasiswaId,
            'no_pengajuan' => $noPengajuan,
            'judul' => $request->judul,
            'bidang_pekerjaan' => $request->bidang_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'jml_pegawai' => $request->jml_pegawai,
            'jns_pengajuan' => 'KP',
            'kompleksitas_pekerjaan' => $request->kompleksitas_pekerjaan,
            'lokasi' => $request->lokasi,
            'nm_instansi' => $request->nm_instansi,
            'phone' => $request->phone,
            'kerangka_pikir' => $kerangkaPikir,
            'status' => 'Pengajuan',
            'ket' => null,
            'selesai' => 0
        ];

        Pengajuan::create($pengajuan);

        Session::flash('msg', 'Berhasil Ditambah');

        return redirect(route('pengajuanKP.status'));
    }

    private function _uploadFile($nim, $kerangkaPikir)
    {

        $nama = $nim.rand(). '.' . $kerangkaPikir->getClientOriginalExtension();

        $tujuan_upload = 'file_pengajuan/kerangkapikir';

        $kerangkaPikir->move($tujuan_upload, $nama);

        return $nama;

    }

    public function show($id)
    {

        $data['dosens'] = Dosen::all();
        $data['pengajuan'] = Pengajuan::where('id', $id)->first();
        
        return view('pengajuanKP.show', $data);
    }

    public function terima(Request $request, $id)
    {
        $this->validate($request, [
            'dosen_id' => 'required'
        ]);

        $pengajuan = Pengajuan::find($id);
        $pengajuan->status = 'Diterima';
        $pengajuan->save();

        $bimbingan = [
            'kd_bimbingan' => rand(),
            'pengajuan_id' => $request->pengajuan_id,
            'dosen_id' => $request->dosen_id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'bab' => 1,
            'tgl_bimbingan' => null,
            'status' => 'Bimbingan',
        ];

        Bimbingan::create($bimbingan);

        Session::flash('msg', 'Pengajuan Berhasil Diterima');

        return redirect(route('pengajuanKP'));

    }
    public function tolak($id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->status = 'Ditolak';
        $pengajuan->save();

        Session::flash('msg', 'Pengajuan Berhasil Ditolak');

        return redirect(route('pengajuanKP'));

    }
    public function terimaSyarat(Request $request, $id)
    {
        $this->validate($request, [
            'syarat' => 'required',
            'dosen_id' => 'required'
        ]);


        $pengajuan = Pengajuan::find($id);
        $pengajuan->syarat = $request->syarat;
        $pengajuan->status = 'Terima Syarat';
        $pengajuan->save();


        $bimbingan = [
            'kd_bimbingan' => rand(),
            'pengajuan_id' => $request->pengajuan_id,
            'dosen_id' => $request->dosen_id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'bab' => 1,

            'tgl_bimbingan' => null,
            'status' => 'Bimbingan',
        ];

        Bimbingan::create($bimbingan);



        Session::flash('msg', 'Pengajuan Berhasil Diterima');

        return redirect(route('pengajuanKP'));
    }

}
