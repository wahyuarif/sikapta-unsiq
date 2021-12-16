@extends('layouts.admin')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <a href="{{ route("admin.dosen.index") }}" class="btn btn-sm btn-success">Kembalii</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.dosen.post.buat-akun-dosen', ['nip' => $dosen->nip]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input name="nip" type="hidden" value="{{ $dosen->nip }}">

                        <div class="form-group">
                            <label for="email"  class="font-weight-bold">Email</label>
                            @if($dosen->user_id != null)
                                <input type="email" name="email" class="form-control" value="{{ $dosen->user->email }}" disabled>
                            @else
                                <input type="email" name="email" class="form-control" value="{{ old("email") }}" placeholder="Email">
                            @endif
                        </div>

                        <button class="btn btn-sm btn-primary">Buat User</button>

                    </form>
                </div>
            </div>
        </div>

@endsection
