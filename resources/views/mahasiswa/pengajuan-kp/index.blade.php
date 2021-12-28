@extends('layouts.app')

@section('content')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body table-responsive">
                    @if($pengajuanKP->first() != null)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID Pengajuan</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Status Pengajuan</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pengajuanKP as $value)
                        <tr>
                            <th scope="row">{{ $value->id }}</th>
                            <td>{{ $value->judul }}</td>
                            <td>{{ $value->created_at }}</td>
                            @if($value->selesai)
                                <td><span class="badge badge-success">Selesai</span></td>
                            @else
                                <td><span class="badge badge-warning">{{ $value->status }}</span></td>
                            @endif

                            <td>
                                 <a href="{{ route('mahasiswa.pengajuan.kp.detail', ['id' => $value->id]) }}" class="btn btn-sm btn-outline-primary"> Detail</a>
                                @if($value->selesai)
                                    <a href="{{ route('mahasiswa.laporan.upload-kp') }}" class="btn btn-sm btn-primary"> Upload Laporan</a>
                                @endif
                                @if($value->status == "PENGAJUAN")
                                    <a href="" class="btn btn-sm btn-primary"> Edit</a>
                                @elseif($value->status == "DITOLAK")
                                    <a href="{{route('mahasiswa.pengajuan.kp.pengajuan')}}" class="btn btn-sm btn-warning"> Pengajuan Ulang</a>
                                @endif

                            </td>
                        </tr>

                        @if($value->status == "DITERIMA")
                        <tr>
                            <th colspan="3"> Dosen Pembimbing: {{ $value->dosen->nama }}</th>
                            <td colspan="2">Masa Belaku : {{ $value->created_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <a href="{{ route('mahasiswa.pengajuan.kp.surat-tugas') }}" class="btn btn-sm btn-info">Cetak Surat Tugas</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Lengkapi persyaratan terlebih dahulu untuk dapat melakukan pengajuan kerja praktek</h4>
                            <hr>
                            <a href="{{ route("mahasiswa.pengajuan.kp.pengajuan") }}" class="btn btn-success btn-sm">
                                Pengajuan Kerja Praktek
                            </a>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
