@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Transaksi</h4>
            </div>
            <div class="card-body">
                <table id="transaksi-table" class="table table-striped table-bordered table-sm"> 
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Id</th>
                            <th>Id Mahasiswa</th>
                            <th>Jns Pembayaran</th>
                            <th>Bukti Bayar</th>
                            <th>tanggal</th>
                            <th>status</th>
                            <th>Action</th>             
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    // $('#button-add').click(function () {
    //     $('#button-simpan').val("create-post"); //valuenya menjadi create-post
    //     $('#id').val(''); //valuenya menjadi kosong
    //     $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
    //     $('#modal-judul').html("Tambah Pegawai Baru"); //valuenya tambah pegawai baru
    //     $('#tambah-edit-modal').modal('show'); //modal tampil
    // });

    $(document).ready(function(){
        $('#transaksi-table').DataTable({
            processing  :true,
            serverSide  :true,
            ajax        :{
            url : "{{route('transaksi.index')}}",
            type: 'GET'
            },

        columns:[
           {data: 'id' ,name: 'id'},
           {data: 'id_mahasiswa' ,name: 'id_mahasiswa'},
           {data: 'jns_pengajuan' ,name: 'jns_pengajuan'},
           {data: 'bukti_pembayaran' ,name: 'bukti_pembayaran'},
           {data: 'tanggal_bayar' ,name: 'tanggal_bayar'},
           {data: 'status_pembayaran' ,name: 'status_pembayaran'}
        ],
        order: [[0, 'asc']]

        });
    });
</script>   
@endsection
     