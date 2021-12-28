@extends('layouts.kaprodi')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID Pengajuan</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pengajuanTA as $value)
                            <tr>
                                <th scope="row">{{ $value->id }}</th>
                                <td>{{ $value->judul }}</td>
                                <td>{{ $value->created_at }}</td>
                                @if($value->selesai)
                                    <td><span class="badge badge-warning">Kerja Praktek Selesai</span></td>
                                @else
                                    <td><span class="badge badge-warning">Belum Selesai</span></td>
                                @endif
                                <td>
                                    <a href="{{ route("kaprodi.pengajuan.ta.detail", ["id" => $value->id]) }}" class="btn btn-sm btn-outline-primary"> Detail</a>
                                    @if(!$value->selesai)
                                        <a href="{{ route('dosen.tugas-akhir.selesai', ['id' => $value->id]) }}" class="btn btn-sm btn-success"> Selesai</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2"> Mahasiswa : {{ $value->mahasiswa->nama }}</th>
                                <td colspan="2"> NIM : {{ $value->mahasiswa->nim }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
