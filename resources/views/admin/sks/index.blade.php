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
                {{-- only layout --}}
            </div>
            <div class="col-md-6">
                <div class="btn-group float-right">
                    <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#impotrModal"><i class="far fa-file-excel"></i> 
                        Import Excel
                    </button>
                </div>
            </div>
        </div>
        <br>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jumlah SKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nomer = 1 ?>
                    @foreach($sks as $value)

                        <tr>
                            <td>{{ $nomer }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->mahasiswa->nama }}</td>
                            <td>{{ $value->jumlah_sks }}</td>
                        </tr>
                        <?php $nomer++ ?>
                    @endforeach

                    </tbody>
                </table>
                {{ $sks->render() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="impotrModal" tabindex="-1" aria-labelledby="import" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route("admin.sks.post.import.excel") }}" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="import">Import Data Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ asset('file_format_sks/format_excel_sks.xlsx') }}" class="btn btn-success">
                                    <i class="fas fa-download"></i>
                                    Download Template File
                                </a>
                            </div>
                        </div>

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="nama"  class="font-weight-bold">Pilih File Excel</label>
                            <input type="file" name="file_excel" class="form-control" value="{{ old("file_excel") }}" placeholder="File Excel">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection

