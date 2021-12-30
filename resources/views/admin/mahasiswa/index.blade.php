@extends('layouts.admin')

@section('content')
        <!-- DataTales Example -->
    <div class="card shadow-sm mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="get" action="{{ route("admin.mahasiswa.index") }}">
                        <div class="form-row">
                            {!! Form::open(['url' => 'admin/mahasiswa', 'method'=>'get', 'class'=>'form-inline']) !!}
                                <div class="col-3 {!! $errors->has('q') ? 'has-error' : '' !!}">
                                    {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'Nama']) !!}
                                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-4 {!! $errors->has('status') ? 'has-error' : ''!!}">
                                    {!! Form::select('status', [''=>'Semua status'], isset($status) ? $status : null, ['class'=>'form-control']) !!}
                                    {!! $errors->first('status', '<p class="help-block">:message</p>')!!}
                                </div>
                            {!! Form::submit('Cari', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="btn-group float-right">
                        <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#importModal"><i class="far fa-file-excel"></i> Export</button>
                        <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target=""><i class="far fa-file-excel"></i> Import</button>
                        <a href="{{ route("admin.mahasiswa.tambah") }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
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

