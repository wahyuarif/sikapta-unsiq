@extends('layouts.dosen')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 col-md-offset-2">
                @if ($msg = Session::get('msg'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $msg }}</strong>
                </div>
                @endif
                @if ($errors->has('file_revisi'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $errors->first('file_revisi') }}</strong>
                    </div>
                @endif
                @if ($errors->has('catatan'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $errors->first('catatan') }}</strong>
                    </div>
                @endif

                @foreach($bimbingans as $bimbingan)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bab {{ $bimbingan->bab }} </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Dosen Pembimbing</td>
                                    <td>:</td>
                                    <td>{{ $bimbingan->dosen->nm_dosen }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $bimbingan->dosen->email }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ $bimbingan->status }} pada {{$bimbingan->updated_at}}</td>
                                </tr>
                                <tr>
                                    <td>File Bimbingan</td>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ asset('file/file_revisi') }}/{{ $bimbingan->file_bimbingan }}">File Bimbingan</a>
                                    </td>
                                </tr>
                            </table>
                            
                            @if($bimbingan->status == 'Bimbingan' OR $bimbingan->status == 'Revisi')
                                <a 
                                href="{{ route('bimbingan.terima', ['id' => $bimbingan->id ]) }}" 
                                class="btn btn-success"
                                >
                                Terima 
                            </a>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#revisi{{$bimbingan->id}}">
                                Revisi
                            </button>
                            @endif
                            
                            <!-- Modal Revsi-->
                            <div class="modal fade" id="revisi{{$bimbingan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Revisi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('bimbingan.revisi') }}" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}


                                        <input type="hidden" name="id_bimbingan" value="{{ $bimbingan->id }}">

                                        <div class="mb-3">
                                            <label for="validationTextarea">Catatan</label>
                                            <textarea class="form-control" name="catatan" id="validationTextarea" placeholder="Required example textarea"></textarea>
                                    
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="file_revisi" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">File Document</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
@endsection
