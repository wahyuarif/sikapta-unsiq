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
            <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
        </div>
        <div class="card-body">  
            <div class="row">
                <div class="col-md-6">
                    {{-- only layout --}}
                </div>
                <div class="col-md-6">
                    <div class="btn-group float-right">
                        <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#importModal"><i class="far fa-file-excel"></i> Import</button>
                        <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target=""><i class="far fa-file-excel"></i> Export</button>
                        <a href="{{ route("admin.dosen.tambah") }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-hover">
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

