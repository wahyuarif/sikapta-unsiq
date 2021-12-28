@extends('layouts.admin')

@section('content')
    <div class="row mt-3">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <a href="{{ route("admin.mahasiswa.index") }}" class="btn btn-sm btn-success">Kembalii</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.mahasiswa.post.tambah') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nim" class="font-weight-bold">Nomer Induk Mahasiswa</label>
                            <input type="text" name="nim" class="form-control" value="{{ old("nim") }}" placeholder="Nomer Induk Mahasiswa">
                        </div>

                        <div class="form-group">
                            <label for="nama"  class="font-weight-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old("nama") }}" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="prodi" class="font-weight-bold">Prodi</label>
                            <select name="prodi" class="form-control" id="prodi">
                                @foreach($prodi as $value)
                                    <option value="{{ $value->kode_prodi }}">{{ $value->kode_prodi }} - {{ $value->prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-sm btn-primary">Tambah</button>

                    </form>
                </div>
            </div>
        </div>

@endsection
