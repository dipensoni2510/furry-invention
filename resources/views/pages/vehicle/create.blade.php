@extends('layouts/contentLayoutMaster')
@section('title', 'Vehicle Create')
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
                <form method="POST" enctype="multipart/form-data" action="{{route('vehicles.store')}}">
                  @csrf
                  <div>
                    <div class="form-label-group mb-1">
                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Vehicle Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                      <label for="name">Vehicle Name</label>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-label-group pt-1">    
                      <div class="flex">
                          <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" autofocus>
                              <!-- <img id="image" height="40" width="40" /> -->
                      </div>
                      <label for="image" class="custom-control-label">Upload Image</label>
                      @error('image')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group pt-1 pb-1">
                      {{-- <label for="company_id">Company Type</label>--}}
                      <select class="custom-select form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id" value="{{ old('company_id') }}">
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                        <option value="{{$company->id}}" {{old('$company->id') === $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                        @endforeach
                      </select>
                      @error('company_id')
                      <span class="invalid-feedback" id="resellerError" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-label-group mb-1 pb-1">
                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                    @foreach($features as $feature)
                    <input type="checkbox" class="pl-1 @error('feature_id') is-invalid @enderror" value="{{ $feature->id }}" name="feature_id[]">{{ $feature->name }}</input>
                    @endforeach
                    <label for="feature_id">Features</label>
                    @error('feature_id')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-label-group mb-1">
                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                    <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" placeholder="Model Name" value="{{ old('model') }}" autocomplete="model" autofocus>
                    <label for="model">Model Name</label>
                    @error('model')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div>
                    <div class="form-group pt-1">
                      {{-- <label for="vehicle_type">Vehicle Type</label>--}}
                      <select class="custom-select form-control @error('vehicle_type') is-invalid @enderror" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}">
                        <option value="">Select Vehicle Type</option>
                        <option value="activa" {{old('vehicle_type') === 'activa' ? 'selected' : ''}}>Activa</option>
                        <option value="bike" {{old('vehicle_type') === 'bike' ? 'selected' : ''}}>Bike</option>
                        <option value="car" {{old('vehicle_type') === 'car' ? 'selected' : ''}}>Car</option>
                      </select>
                      @error('vehicle_type')
                      <span class="invalid-feedback" id="resellerError" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div style="display: flex;">
                    <div class="form-group">
                        {{-- <label class="custom-control-label" for="customRadio1">Wheels</label>--}}
                      <div class="demo-inline-spacing" style="display: flex;">
                        <label for="name">Wheels</label>
                        <div class="custom-control custom-radio ml-1 mr-1">
                          <input type="radio"  id="wheels" name="wheels" value="2" checked />
                          <label class="" for="wheels">2</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio"  id="wheels" name="wheels" value="4" />
                          <label class="" for="wheels">4</label>
                        </div>
                      </div>
                    </div>
                    </div>
                  <div style="display: flex;">
                    <div class="form-group">
                      <div class="demo-inline-spacing" style="display: flex;">
                        <label for="name">Gears</label>
                        <div class="custom-control custom-radio ml-1 mr-1">
                          <input type="radio"  id="gear_type" name="gear_type" value="with" checked />
                          <label class="" for="gear_type">With Gear</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio"  id="gear_type" name="gear_type" value="without" />
                          <label class="" for="gear_type">Without Gear</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-label-group mt-0">
                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                    <textarea id="specifications" type="text" class="form-control @error('specifications') is-invalid @enderror" name="specifications" placeholder="Specifications" value="{{ old('specifications') }}" autocomplete="specifications"></textarea>
                    <label for="specifications">Description</label>
                    @error('specifications')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-label-group mt-1 mb-0">
                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price" value="{{ old('price') }}" autocomplete="price" autofocus>
                    <label for="price">Price</label>
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-label-group mt-1 mb-0">
                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                    <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" placeholder="number" value="{{ old('number') }}" autocomplete="number" autofocus>
                    <label for="number">Number</label>
                    @error('number')
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
</section>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/vehicles" class="mr-1 btn btn-outline-warning">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
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
  $(document).ready(function() {
    // Month and Year Select Picker
    $('.pickadate-months-year').pickadate({
      selectYears: true,
      selectMonths: true,
      formatSubmit: 'yyyy/mm/dd'
    });
  });
</script>
@endsection