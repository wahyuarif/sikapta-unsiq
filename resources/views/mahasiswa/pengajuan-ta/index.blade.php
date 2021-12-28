@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body table-responsive">
                    @if($pengajuanTA->first() != null)
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
                        @foreach($pengajuanTA as $value)
                        <tr>
                            <th scope="row">{{ $value->id }}</th>
                            <td>{{ $value->judul }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td><span class="badge badge-warning">{{ $value->status }}</span></td>
                            <td>
                                <a href="{{ route('mahasiswa.pengajuan.kp.detail', ['id' => $value->id]) }}" class="btn btn-sm btn-outline-primary"> Detail</a>
                                @if($value->status == "PENGAJUAN")
                                    <a href="" class="btn btn-sm btn-primary"> Edit</a>
                                @elseif($value->status == "DITOLAK")
                                    <a href="" class="btn btn-sm btn-warning"> Pengajuan Ulang</a>
                                @elseif($value->status == "DITERIMA")
                                    <a href="" class="btn btn-sm btn-primary"> Bimbingan</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"> Dosen Pembimbing: {{ $value->dosen->nama }}</th>
                            <td colspan="2">Masa Belaku : {{ $value->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Lengkapi persyaratan terlebih dahulu untuk dapat melakukan pengajuan Tugas Akhir</h4>
                            <hr>
                            <a href="{{ route("mahasiswa.pengajuan.ta.pengajuan") }}" class="btn btn-success btn-sm">
                                Pengajuan Tugas Akhir
                            </a>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
