<!DOCTYPE html>
<html>
<head>
    <title>Punakha SMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" >

</head>
<body>

<div class="container mt-2">
    <h3 class="text-center">Student Details Searchsdfasdf</h3>
    <table class="table table-bordered data-table">
      <thead>
               <th>SL</th>
              <th>ID</th>
              <th>Citizen ID</th>
              <th>Employee ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Qualification</th>
              <th width="100px">Action</th>
          </tr>
      </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!--script for datatables and its ajax functions-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
</body>

<script type="text/javascript">
  $(document).ready(function() {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('staffs.index'  ) }}",

        columns: [

          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'id', name: 'id', 'visible': false},
          {data: 'cid', name: 'cid'},
          {data: 'eid', name: 'eid'},
          {data: 'Name', name: 'Name'},
          {data: 'email', name: 'email'},
          {data: 'Qualification', name: 'Qualification'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $('.data-table').on( 'click', '.view', function () {
  var row  = $(this).parents('tr')[0];
  var id=$('.data-table').DataTable().row( row ).id();
  //alert( 'Clicked row id '+id );
  var url = '{{ route("stafffs.show", ":id") }}';
  url = url.replace(':id',id);
  window.location.href=url;

});



  });
</script>
</html>
