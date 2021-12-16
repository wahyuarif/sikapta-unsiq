@extends('layouts.admin')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow-sm mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route("admin.dosen.tambah") }}" class="btn btn-primary btn-sm mx-2">Tambah Data</a>
                    <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#impotrModal">
                        Import Excel
                    </button>
                    <a href="" class="btn btn-outline-success btn-sm mx-2">Export Excel</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Prodi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nomer = 1 ?>
                    @foreach($dosen as $value)

                        <tr>
                            <td>{{ $nomer }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->nip }}</td>
                            <td>{{ $value->jabatan }}</td>
                            <td>{{ $value->prodi->prodi }}</td>
                            <td>
                                <a href="{{ route('admin.dosen.buat-akun-dosen', ['nip' => $value->nip]) }}" class="btn btn-sm btn-success">Buatkan User</a>
                                <a class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        <?php $nomer++ ?>
                    @endforeach

                    </tbody>
                </table>
                {{ $dosen->render() }}
            </div>
        </div>
    </div>
@endsection

