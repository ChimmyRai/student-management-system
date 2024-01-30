@extends('layouts.app2')

    @section('content')

    <div class="container mt-2">
        <table class="table table-bordered data-table" id="data-table" >
          <div id="showsuccess"  class='alert alert-success' style="display: none;"></div>
          <div id="showfailure" class="alert alert-danger" style="display: none;"></div>
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
    <!--bootstrap model-->
    <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success modal-sm" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" style="background: #47c9a2;">
         <p class="heading lead">Success!</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
					<i class="material-icons" style="color:green;font-size:50px;">&#xE876;</i>
           <p>The record has been successfully deleted</p>
         </div>
       </div>

       <!--Footer-->

     </div>
     <!--/.Content-->
   </div>
 </div>
<!--end of bootstrap model-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#d27979;">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> Are you sure you want to delete this record? </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <a href="#delete" id="delete" class="btn btn-danger">YES</a> </div>
    </div>
  </div>
</div>
  <script src="{{ asset('js/jquery.validate.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>

    @endsection



  @section('extrajs')


  $(document).ready(function() {
    var id;
    var token;
    var url;
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('staffsdetailsforauthenticateduser.index') }}",

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


    $('.data-table').on( 'click', '.delete', function () {
  var row  = $(this).parents('tr')[0];
  id=$('.data-table').DataTable().row( row ).id();
  token = $("meta[name='csrf-token']").attr("content");
  url="staffdetail/"+id,

    $('#deleteModal').modal('show');
          });


  $( document ).on( "click", "#delete", function()
  {
    $.ajax(
       {
           url: url,
            type: 'DELETE',
            data: {
              "id": id,
              "_token": token,
          },
          success: function (data) {
     $('#centralModalSuccess').modal('show');
         table.draw();
        },
        error: function (data) {
          $("#showfailure").show().text("Your Requested operation could not be completed");
            $('div.alert').delay(3000).slideUp(300);
        }

       });

        $('#deleteModal').modal('hide');
    })


    $('.data-table').on( 'click', '.edit', function () {
  var row  = $(this).parents('tr')[0];
  id=$('.data-table').DataTable().row( row ).id();
  token = $("meta[name='csrf-token']").attr("content");
  url="staffdetail/"+id+"/edit";
$(location).attr('href',url);

          });
  $('div.alert').delay(3000).slideUp(300);
  });


  @endsection
