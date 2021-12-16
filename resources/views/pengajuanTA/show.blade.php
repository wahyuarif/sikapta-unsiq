@extends('layouts.dosen')

@section('content')
<div class="container">
    <div class="row">
    
         @if ($errors->has('file'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
          </span>
          @endif
      
          {{-- notifikasi sukses --}}
          @if ($sukses = Session::get('sukses'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $sukses }}</strong>
          </div>
          @endif

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pengajuan {{ $pengajuan->mahasiswa->nama }}</div>

                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>No Pengajuan</td>
                            <td>:</td>
                            <td>{{ $pengajuan->no_pengajuan }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $pengajuan->mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nim</td>
                            <td>:</td>
                            <td>{{ $pengajuan->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>:</td>
                            <td>{{ $pengajuan->mahasiswa->prodi->prodi }}</td>
                        </tr>
                        <tr>
                            <td>Bidang Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $pengajuan->bidang_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td>{{ $pengajuan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah pegawai</td>
                            <td>:</td>
                            <td>{{ $pengajuan->jml_pegawai }}</td>
                        </tr>
                        <tr>
                            <td>Kerangka Pikir</td>
                            <td>:</td>
                            <td>
                            <a href="{{ asset('file_pengajuan/kerangkapikir') }}/{{ $pengajuan->kerangka_pikir }}">Filepengajuan</a>
                            </td>
                            <!-- <td>
                                <iframe src="{{ asset('file_pengajuan/kerangkapikir') }}/{{ $pengajuan->kerangka_pikir }}" width="200" height="300">
                                </iframe>
                            </td> -->
                        </tr>

                    </table>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#terimaModal">
                        Terima
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#syaratModal">
                        Terima Syarat
                    </button>
                    <a href="{{ route('pengajuanTA.tolak', ['id' => $pengajuan->id]) }}" class="btn btn-danger">Tolak</a>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection


<!-- Modal Terima Syaray-->
<div class="modal fade" id="syaratModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('pengajuanTA.terimaSyarat', ['id' => $pengajuan->id]) }}" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Syarat Diterima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        
        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
        <input type="hidden" name="mahasiswa_id" value="{{ $pengajuan->mahasiswa_id }}">

        <label> Syarat  </label>
        <div class="form-group">
           <textarea name="syarat" class="form-control is-invalid" id="validationTextarea" required value="{{ old('syarat') }}" ></textarea>
        </div>
        <label> Dosen  </label>
        <div class="form-group">
           <select name="dosen_id" id="" class="form-control">
             <option>Dosen Pembimbing</option>
             @foreach($dosens as $dosen)
              <option value="{{ $dosen->id }}">{{ $dosen->nm_dosen }}</option>
             @endforeach
           </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal Terima-->
<div class="modal fade" id="terimaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('pengajuanTA.terima', ['id' => $pengajuan->id]) }}" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Diterima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        
        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
        <input type="hidden" name="mahasiswa_id" value="{{ $pengajuan->mahasiswa_id }}">

        <label> Dosen  </label>
        <div class="form-group">
           <select name="dosen_id" id="" class="form-control">
             <option value="">Dosen Pembimbing</option>
             @foreach($dosens as $dosen)
              <option value="{{ $dosen->id }}">{{ $dosen->nm_dosen }}</option>
             @endforeach
           </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>