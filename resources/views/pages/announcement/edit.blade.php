@extends('layouts/contentLayoutMaster')
@section('title', 'Announcement Edit')
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
                  <form method="POST" action="/announcements/{{ $announcement->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-label-group mt-1">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{ $announcement->title }}" autocomplete="title" autofocus>
                      <label for="title">Title</label>
                      @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group">
                      <select class="custom-select form-control @error('type') is-invalid @enderror" id="type" name="type">
                        <option value="" selected>Select Company Type</option>
                        <option value="event" {{ $announcement->type === "event" ? 'selected' : '' }}>Event</option>
                        <option value="maintenance" {{ $announcement->type === "maintenance" ? 'selected' : '' }}>Maintenance</option>
                      </select>
                      @error('type')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" value="{{ $announcement->description }}" autocomplete="description" autofocus>
                        {{ $announcement->description }}
                      </textarea>
                      <label for="description">Description</label>
                      @error('description')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <input id="date" type="text" class="form-control flatpickr-basic flatpickr-input active @error('date') is-invalid @enderror" name="date" placeholder="Date" value="{{ $announcement->date }}" autocomplete="date" autofocus>
                      <label for="date">Date</label>
                      @error('date')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <input id="time" type="text" class="form-control flatpickr-time text-left flatpickr-input active @error('time') is-invalid @enderror" name="time" placeholder="Time" value="{{ $announcement->time }}" autocomplete="time" autofocus>
                      <label for="time">Time</label>
                      @error('time')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group mb-0">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" placeholder="Days" value="{{ $announcement->days }}" autocomplete="days" autofocus>
                      <label for="days">Days</label>
                      @error('days')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
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
      <a href="/announcements" class="btn btn-outline-warning mr-1">Cancel</a>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
  </form>
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
