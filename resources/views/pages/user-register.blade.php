@extends('layouts/contentLayoutMaster')
@section('title', 'User | Add New User')
@section('vendor-style')
        <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">

         <!-- file uploder vendor css files -->
         <link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
         <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
        <!-- File Uploder Page css files -->
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
@endsection
@section('content')
<section class="row flexbox-container">
  <div class="col-xl-8 col-10 d-flex justify-content-center">
      <div class="card flex-fill">
          <div class="row m-0">
              <div class="col-lg-6 col-12 p-0">
                  <div class="card rounded-0 mb-0 p-2">
                      <div class="card-header pt-50 pb-1">
                          <div class="card-title">
                              <h4 class="mb-0">Add New User</h4>
                          </div>
                      </div>
                      <div class="card-content">
                          <div class="card-body pt-0">
                            <form method="POST" action="/user-register" enctype="multipart/form-data">
                              @csrf
                                <div class="form-label-group">
                                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    <label for="first_name">First Name</label>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                    <label for="last_name">Last Name</label>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email" required> -->
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email">Email</label>
                                    @error('email')
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
                                <div class="form-label-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>

                                <div class="form-label-group">
                                    <label for="avatar" class="custom-control-label">Upload Image</label>    
                                    <div class="flex">
                                        <input id="avatar" type="file" class="form-control" name="avatar" autocomplete="avatar" autofocus>
                                        {{-- <img id="avatar" src="{{ $user->avatar }}" alt="{{ $user->name }}" height="40" width="40" /> --}}
                                    </div>
                                </div>
                                <a href="/user-dashboard" class="btn btn-outline-primary mr-1 mb-1">Cancel</a>
                                <button type="submit" class="btn btn-primary float-right">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>

        <!-- File Uploder vendor files -->
        <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
        <!-- End File Uploder vendor files -->
@endsection
@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/pickers/dateTime/pick-a-datetime.js')) }}"></script>

        <!-- File Uploder Page js files -->
        <script src="{{ asset(mix('js/scripts/extensions/dropzone.js')) }}"></script>
        <!-- End File Uploder Page js files -->

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