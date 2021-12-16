@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
    
         @if ($errors->has('file'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
          </span>
          @endif
      
          {{-- notifikasi sukses --}}
          @if ($sukses = Session::get('sukses'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $sukses }}</strong>
          </div>
          @endif

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Data SKS Mahasiswa</div>
                <p>
                  <div class="panel-body">
                    <a href="{{ route('sks.exportExcel') }}" class="btn btn-success">Export Excel</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#impotrModal">
                        Import Excel
                    </button>
                  </div>
                </p>

                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Sks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sks as $index=>$datasks)
                        <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td> {{ $datasks['nim'] }} </td>
                            <td> {{ $datasks['nama'] }} </td>
                            <td> {{ $datasks['jml_sks'] }} </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="impotrModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('sks.importExcel') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <a href="{{ asset('file_format_sks/format_excel_sks.xlsx') }}" class="btn btn-success">
        <i class="fas fa-download"></i>
        Download Template File
      </a>
      <div class="modal-body">
      {{ csrf_field() }}

        
        <label> Pilih File Excel </label>
        <div class="form-group">
            <input type="file" name="file" required="required">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>