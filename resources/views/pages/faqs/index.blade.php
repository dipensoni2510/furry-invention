@extends('layouts/contentLayoutMaster')
@section('title', 'Faqs List Page')
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
        @foreach($faqs as $faq)
        <div class="card">
{{--          <div class="card-header">--}}
{{--          </div>--}}
          <div class="card-content">
            <div class="card-body card-dashboard">
              <dl>
                <dt>
                  <h4> {{$faq->question}} </h4> </br>
                </dt>
                <dd>
                  {{$faq->answer}}
                </dd>
              </dl>
            </div>
          </div>
        </div>
        @endforeach

          {!! $faqs->links() !!}
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
  <script type="text/javascript">

    var table = $('#announcementTable').DataTable({
      processing: true,
      serverSide: true,
      'language': {
        'loadingRecords': '&nbsp;',
        'processing': '<i class="fa fa-spinner" style="color: #7367f0;"></i>'
      },
      ajax: "{{route('announcements.get')}}",
      columns: [
        { data: 'id' },
        { data: 'title' },
        { data: 'type' },
        { data: 'description' },
        { data: 'date' },
        { data: 'time' },
        { data: 'days' },
        { data: 'actions' },
      ],
    });

    $(document).ready(function(){
      setTimeout(function() {
        $('#successMessage').fadeOut('fast');
      }, 5000); // <-- time in milliseconds
    });

    $(document).on('click', '.button-approve-action', function (e) {
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
        confirmButtonText: 'Yes, Approve it!',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: '/user-approve',
            method: "get",
            data: {
              id:id,
            },
            success: function(response) {
              Swal.fire({
                type: "success",
                title: 'Approved!',
                text: 'Tenant Approved.',
                confirmButtonClass: 'btn btn-success',
              }).then(function (result) {
                if (result.value) {
                  console.log(response);
                  //window.location.reload();
                  $('#usersTable').DataTable().ajax.reload();
                }
              });
            }
          });
        }
      });
    });

    $(document).on('click', '.button-decline-action', function (e) {
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
        confirmButtonText: 'Yes, Decline it!',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {
        if (result.value) {
          //console.log('inside true');
          $.ajax({
            url: '/announcements/'+id,
            method: "get",
            data: {
              id:id,
            },
            success: function(response) {
              Swal.fire({
                type: "success",
                title: 'Delete!',
                text: 'Delete Announcement.',
                confirmButtonClass: 'btn btn-success',
              }).then(function (result) {
                if (result.value) {
                  console.log(response);
                  //window.location.reload();
                  $('#announcementTable').DataTable().ajax.reload();
                }
              });
            }
          });
        }
      });
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
@endsection
