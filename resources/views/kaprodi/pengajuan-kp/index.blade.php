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
                                    <td><span class="badge badge-warning">{{ $value->status }}</span></td>
                                    <td>
                                        <a href="{{ route("kaprodi.pengajuan.kp.detail", ["id" => $value->id]) }}" class="btn btn-sm btn-outline-primary"> Detail</a>
                                        <a href="" class="btn btn-sm btn-primary"> Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2"> Dosen : {{ $value->nip }}</th>
                                    <td colspan="2">Masa Belaku : {{ $value->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                </div>
            </div>
        </div>
    </div>

@endsection
