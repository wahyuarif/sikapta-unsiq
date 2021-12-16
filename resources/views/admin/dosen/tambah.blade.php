@extends('layouts.admin')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <a href="{{ route("admin.dosen.index") }}" class="btn btn-sm btn-success">Kembalii</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.dosen.post.tambah') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nik" class="font-weight-bold">NIP / NPU</label>
                            <input type="text" name="nip" class="form-control" value="{{ old("nip") }}" placeholder="NIP">
                        </div>

                        <div class="form-group">
                            <label for="nama"  class="font-weight-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old("nama") }}" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="prodi" class="font-weight-bold">Prodi</label>
                            <select name="prodi" class="form-control" id="prodi">
                                <option value=""> -- Prodi -- </option>
                                @foreach($prodi as $value)
                                    <option value="{{ $value->kode_prodi }}">{{ $value->kode_prodi }} - {{ $value->prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jabatan" class="font-weight-bold">Jabatan</label>
                            <select name="jabatan" class="form-control" id="prodi">
                                <option value=""> -- Jabatan -- </option>
                                <option value="dosen">Dosen</option>
                                <option value="kaprodi">Kaprodi</option>
                                <option value="dekan">Dekan</option>
                            </select>
                        </div>

                        <button class="btn btn-sm btn-primary">Tambah</button>

                    </form>
                </div>
            </div>
        </div>

@endsection
