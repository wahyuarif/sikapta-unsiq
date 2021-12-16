@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-12">
        <h4>Pengajuan Tugas Akhir</h4>
        <hr>
    </div>
</div>


@if(count($terima) >= 1)

<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Pengajuan Diterima</h4>
  <p>
    Pengajuan dengan judul <b>{{ $terima[0]->judul }}</b> telah diterima oleh kaprodi silahkan ke menu bimbinan untuk melakukan bimbingan
  </p>                 
  <hr>
    <a href="{{ route('bimbingan.mahasiswa') }}" class="btn btn-primary btn-sm">Bimbingan</a>
    </a>
  
</div>

@elseif(count($ditolak) >= 1)

<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Pengajuan Ditolak ditolak</h4>
  <p>
    Pengajuan dengan judul <b>{{ $ditolak[0]->judul }}</b> telah ditolak oleh kaprodi silahkan mengajukan bimbingan kembali
  </p>                 
  <hr>
    <a href="{{ route('pengajuan.kerjaPraktekSecond') }}" class="btn btn-primary btn-sm">Pengajuan Kembali</a>
    </a>
  
</div>
@endif

<div class="row mt-3">
    <div class="col-12">
        @foreach($pengajuans as $pengajuan)
        <div class="card alert-{{ ($pengajuan->status == 'Ditolak') ? 'danger' : 'success' }}">
            <div class="card-body">
                <h5> {{$pengajuan->judul}} </h5>
                <hr>
                <table width="100%" class="table">
                    <tr>
                        <td>No Pengajuan</td>
                        <td>:</td>
                        <td>{{ $pengajuan->no_pengajuan }}</td>
                    </tr>
                    <tr>
                        <td>Nama Instansi</td>
                        <td>:</td>
                        <td>{{ $pengajuan->nm_instansi }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <span class="badge badge-{{ ($pengajuan->status == 'Ditolak') ? 'danger' : 'primary' }}">
                                {{ $pengajuan->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Detail</a>
                        </td>      
                        
                    </tr>
                </table>
                <hr>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection