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
            <div class="row">
                <div class="col-md-6">
                    <form method="get" action="{{ route("admin.mahasiswa.index") }}">
                        <div class="form-group row">
                            <label for="prodi" class="col-md-2 col-form-label">Prodi</label>
                            <div class="col-md-5">
                                <select name="prodi" class="form-control" id="prodi">
                                    @foreach($prodi as $value)
                                        <option value="{{ $value->kode_prodi }}">{{ $value->kode_prodi }} - {{ $value->prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn mb-2 btn-success btn-sm col-form-label">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn float-right btn-sm btn-outline-success mx-2" data-toggle="modal" data-target="#impotrModal">
                        Import Excel
                    </button>
                    <a href="" class="btn btn-success btn-sm float-right mx-2">Export Excel</a>
                    <a href="{{ route("admin.mahasiswa.tambah") }}" class="btn btn-primary btn-sm float-right mx-2">Tambah Data</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Nomer Handphone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nomer = 1 ?>
                    @foreach($mahasiswa as $value)

                    <tr>
                        <td>{{ $nomer }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->nim }}</td>
                        <td>{{ $value->prodi->prodi }}</td>
                        <td>{{ $value->nomer_hp }}</td>
                        <td><a class="btn btn-sucess"></a></td>
                    </tr>
                    <?php $nomer++ ?>
                    @endforeach

                    </tbody>
                </table>
                {{ $mahasiswa->render() }}
            </div>
        </div>
    </div>
@endsection

