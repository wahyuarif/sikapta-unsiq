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
          @if ($msg = Session::get('msg'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $msg }}</strong>
          </div>
          @endif

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Data SKS Mahasiswa</div>

                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuans as $pengajuan)
                        <tr>
                            <th scope="row">-</th>
                            <td> {{ $pengajuan->mahasiswa->nim }} </td>
                            <td> {{ $pengajuan->mahasiswa->nama }} </td>
                            <td> {{ $pengajuan->mahasiswa->prodi->prodi }} </td>
                            <td> 
                                <span class="badge badge-primary">
                                    {{ $pengajuan->status }} 
                                </span>
                            </td>
                            <td> 
                                <a href="{{ route('pengajuanKP.show', ['id' => $pengajuan->id]) }}" class="btn btn-primary btn-sm">Lihat Pengajuan</a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
@endsection