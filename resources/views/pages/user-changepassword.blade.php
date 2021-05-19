@extends('layouts/contentLayoutMaster')
@section('title', 'Change Password Page')
@section('vendor-style')
        <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
        <link rel="stylesheet" href="vendors/css/extensions/sweetalert2.min.css">
         <!-- file uploder vendor css files -->
         <link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
         <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
        <!-- File Uploder Page css files -->
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
        <style>
          .btn-primary-cancel {
              /* background-color: #7367f0 !important; */
              /* color: #fff; */
              color: royalblue;
              background: white;
          }
        </style>
@endsection
@section('content')

@section('content')
@if( session('message'))
<div id="successMessage">
  <p class="alert {{ session('alert-class', 'alert-danger') }}">{{ session('message') }}</p>
</div>
@endif

<section class="row flexbox-container">
  <div class="col-xl-6 col-8 d-flex justify-content-center">
      <div class="card flex-fill">
          <div class="row m-0">
              <div class="col-lg-12 col-12 p-0">
                  <div class="card rounded-0 mb-0 p-2">
                      {{-- <div class="card-header pt-50 pb-1">
                          <div class="card-title">
                              <h4 class="mb-0">Update User</h4>
                          </div>
                      </div> --}}
                      <div class="card-content">
                          <div class="card-body pt-0 pb-0 pr-0 pl-0">
                            <form method="POST" action="{{ route('changepassword') }}">
                              @csrf
                              @method('PUT')
                              <div class="form-label-group">
                                <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
                                <input id="old-password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old-password" placeholder="Old Password" required autocomplete="old-password">
                                <label for="old-password">Password</label>
                                @error('old-password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <div class="form-label-group">
                              <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                              <label for="password">Password</label>
                              @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                          <div class="form-label-group mb-0">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                              <label for="password-confirm">Confirm Password</label>
                          </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/home" class="btn btn-outline-warning mr-1">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</form>
@endsection
@section('vendor-script')
        <!-- vendor files -->
        <script src="vendors/js/extensions/sweetalert2.all.min.js"></script>
@endsection
@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>
        <script>
          $( document ).ready(function() {

              // Month and Year Select Picker
              $('.pickadate-months-year').pickadate({
                  selectYears: true,
                  selectMonths: true,
                  formatSubmit: 'yyyy/mm/dd'
              });

          });
      </script>
@endsection