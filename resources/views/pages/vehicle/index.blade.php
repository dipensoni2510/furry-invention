@extends('layouts/contentLayoutMaster')
@section('title', 'Vehicle List Page')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="vendors/css/extensions/sweetalert2.min.css">
@endsection

@section('datatable-css')
<link rel="stylesheet" href="vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('content')
@if( session('message'))
<div id="successMessage">
  <p class="alert {{ session('alert-class', 'alert-success') }}">{{ session('message') }}</p>
</div>
@endif

<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        @if(auth()->user()->role === "admin")
        <div class="card-header">
          <a href="{{route('vehicles.create')}}" class="btn btn-primary">Add Vehicle</a>
        </div>
        @endif
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <div class="form-group">
                <label><strong>Gear Type :</strong></label>
                <select id='status' class="form-control" style="width: 200px">
                    <option value="">--Select Type--</option>
                    <option value="with">With Gear</option>
                    <option value="without">Gear Less</option>
                </select>
                </div>
            </div>
              <table id="vehicleTable" class="table zero-configuration data-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Model</th>
                    <th>Vehicle Type</th>
                    <th>Wheels</th>
                    <th>Gear Type</th>
                    <th>Specifications</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('datatable-js')
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script> --}}

<script src="vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="vendors/js/tables/datatable/datatables.min.js"></script>
<script src="vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
      var table = $("#vehicleTable").DataTable({
          processing: true,
          serverSide: true,
          'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<i class="fa fa-spinner" style="color: #7367f0;"></i>'
          },
          ajax: {
            url: "{{ route('vehicles.index') }}",
            data: function (d) {
                  d.status = $('#status').val(),
                  d.search = $('input[type="search"]').val()
              }
          },
          columns: [{
            data: 'DT_RowIndex',
            name: 'id'
          },
          {
            data: 'name'
          },
          {
            data: 'model'
          },
          {
            data: 'vehicle_type'
          },
          {
            data: 'wheels'
          },
          {
            data: 'gear_type'
          },
          {
            data: 'specifications'
          },
          {
            data: 'price'
          },
          {
            data: 'actions'
          }
        ],
        "bDestroy": true
      });
    
      
      $('#status').change(function(){
        table.draw();
      });
    });

  // var fun = $('#vehicleTable').DataTable({
  //   processing: true,
  //   serverSide: true,
  //   'language': {
  //     'loadingRecords': '&nbsp;',
  //     'processing': '<i class="fa fa-spinner" style="color: #7367f0;"></i>'
  //   },
  //   ajax: "{{route('vehicles.index')}}",
  //   data: function (d) {
  //               d.status = $('#status').val(),
  //               d.search = $('input[type="search"]').val()
  //           },
  //   columns: [{
  //       data: 'DT_RowIndex',
  //       name: 'id'
  //     },
  //     {
  //       data: 'name'
  //     },
  //     {
  //       data: 'model'
  //     },
  //     {
  //       data: 'vehicle_type'
  //     },
  //     {
  //       data: 'wheels'
  //     },
  //     {
  //       data: 'gear_type'
  //     },
  //     {
  //       data: 'specifications'
  //     },
  //     {
  //       data: 'price'
  //     },
  //     {
  //       data: 'actions'
  //     }
  //   ],
  // });

  // $('#status').change(function(){
  //       fun.draw();
  //   });

  $(document).ready(function() {
    setTimeout(function() {
      $('#successMessage').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
  });
</script>

@endsection
@section('vendor-script')
<!-- vendor files -->
<script src="vendors/js/extensions/sweetalert2.all.min.js"></script>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/datatables/datatable.js')) }}"></script>

<script>
  $(document).on('click', '.button-delete-action', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    //document.getElementById("user_id").value = id;
    console.log(id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger ml-1',
      buttonsStyling: false,
    }).then(function(result) {
      if (result.value) {
        //console.log('inside true');
        $.ajax({
          url: 'vehicles/' + id,
          type: 'post',
          data: {
            "_method": 'delete',
            "_token": "{{csrf_token()}}",
            id: id,
          },
          success: function(response) {
            Swal.fire({
              type: "success",
              title: 'Deleted!',
              text: 'Vehicle Deleted Successfully.',
              confirmButtonClass: 'btn btn-success',
            }).then(function(result) {
              if (result.value) {
                console.log(response);
                //window.location.reload();
                $('#vehicleTable').DataTable().ajax.reload();
              }
            });
          }
        });
      }
    });
  });

</script>

@endsection

<!--
// $(document).on('click', '.button-approve-action', function (e) {
  //           e.preventDefault();
  //           let id = $(this).data('id');
  //           //document.getElementById("user_id").value = id;
  //           console.log(id);
  //           Swal.fire({
  //             title: 'Are you sure?',
  //             text: "You won't be able to revert this!",
  //             type: 'warning',
  //             showCancelButton: true,
  //             confirmButtonColor: '#3085d6',
  //             cancelButtonColor: '#d33',
  //             confirmButtonText: 'Yes, Approve it!',
  //             confirmButtonClass: 'btn btn-primary',
  //             cancelButtonClass: 'btn btn-danger ml-1',
  //             buttonsStyling: false,
  //           }).then(function (result) {
  //               if (result.value) {
  //                 $.ajax({
  //                   url: '/user-approve',
  //                   method: "get",
  //                   data: {
  //                     id:id,
  //                   },
  //                   success: function(response) {
  //                                 Swal.fire({
  //                                   type: "success",
  //                                   title: 'Approved!',
  //                                   text: 'Tenant Approved.',
  //                                   confirmButtonClass: 'btn btn-success',
  //                                 }).then(function (result) {
  //                                 if (result.value) {
  //                                   console.log(response);
  //                                 //window.location.reload();
  //                                 $('#usersTable').DataTable().ajax.reload();
  //                                 }
  //                                 });
  //                               }
  //                         });
  //                     }
  //                   });
  //               });

  // $(document).on('click', '.button-decline-action', function (e) {
  //           e.preventDefault();
  //           let id = $(this).data('id');
  //           //document.getElementById("user_id").value = id;
  //           console.log(id);
  //           Swal.fire({
  //             title: 'Are you sure?',
  //             text: "You won't be able to revert this!",
  //             type: 'warning',
  //             showCancelButton: true,
  //             confirmButtonColor: '#3085d6',
  //             cancelButtonColor: '#d33',
  //             confirmButtonText: 'Yes, Decline it!',
  //             confirmButtonClass: 'btn btn-primary',
  //             cancelButtonClass: 'btn btn-danger ml-1',
  //             buttonsStyling: false,
  //           }).then(function (result) {
  //               if (result.value) {
  //                 //console.log('inside true');
  //                 $.ajax({
  //                   url: '/user-decline',
  //                   method: "get",
  //                   data: {
  //                     id:id,
  //                   },
  //                   success: function(response) {
  //                                 Swal.fire({
  //                                   type: "success",
  //                                   title: 'Declined!',
  //                                   text: 'Tenant Declined.',
  //                                   confirmButtonClass: 'btn btn-success',
  //                                 }).then(function (result) {
  //                                 if (result.value) {
  //                                   console.log(response);
  //                                 //window.location.reload();
  //                                 $('#usersTable').DataTable().ajax.reload();
  //                                 }
  //                                 });
  //                               }
  //                         });
  //                     }
  //                   });
  //               });
  -->