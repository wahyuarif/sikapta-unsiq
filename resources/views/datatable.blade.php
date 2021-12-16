<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5 - Implementing datatables tutorial using yajra package</title>
    <link href="{{ asset('vendor/bootstrap/js/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    
</head>
<body>


<div class="container">
  <table id="users" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Tag</th>
        </tr>
    </thead>
  </table>
</div>


<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('datatable.getposts') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'tag', name: 'tag'}
        ]
    });
});
</script>
</body>
</html>