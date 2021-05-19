@extends('layouts/contentLayoutMaster')
@section('title', 'Edit Order Page')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">

<!-- file uploder vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<!--{{asset('css/jquery-ui.css')}} -->
<!-- File Uploder Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
<style>
  .ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
    float: left;

  }

  ,
  .ui-priority-secondary,
  .ui-widget-content .ui-priority-secondary,
  .ui-widget-header .ui-priority-secondary {
    opacity: .7;
    filter: Alpha(Opacity=70);
    /* support: IE8 */
    font-weight: normal;
    display: none !important;
  }
</style>
@endsection
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
            <div class="card-header pt-50 pb-1">
              <div class="card-title">
                <h4 class="mb-0">Vehicle Rent Detials</h4>
              </div>
            </div>
            <div class="card-content">
              <form method="POST" action="/orders/{{$order->id}}">
                @csrf
                @method('PUT')
                <div class="card-body pt-1 pb-0 pr-0 pl-0">
                  <div class="form-label-group">
                    <input type='text' class="form-control @error('start_date1') is-invalid @enderror" id="start_date1" name="start_date1" placeholder="Start Date" value="{{ $order->take_date }}" autocomplete="off" readonly />
                    <label for="start_date1">Take Date</label>
                    @error('start_date1')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-label-group">
                    <input type='text' class="form-control
                                  @error('end_date1') is-invalid @enderror" id="end_date1" name="end_date1" placeholder="End Date" value="{{  $order->return_date }}" readonly />
                    <label for="end_date1">Return Date</label>
                    @error('end_date1')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <div class="form-label-group mb-0">
                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                        <input id="total_amount" type="text" class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" placeholder="Total Amount" value="{{ $order->total_amount }}" autocomplete="total_amount" readonly>
                        <label for="total_amount">Total Amount</label>
                        @error('total_amount')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <div class="form-group">
                        {{-- <label for="status">Setect Status</label>--}}
                        <select class="custom-select form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('company_id') }}">
                          <option value="">Select Status</option>
                          <option value="returned" {{$order->status == "returned" ? 'selected' : ''}}>Returned</option>
                          <option value="not_return" {{$order->status == "not_return" ? 'selected' : ''}}>Not Return</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" id="resellerError" role="alert">
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
    </div>
  </div>
</section>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/orders" class="mr-1 btn btn-outline-warning">Cancel</a>
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

<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  // Month and Year Select Picker
  $(function() {
    $('.exp-date-picker').datepicker({
      dateFormat: "mm-yy",
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,

      onClose: function(dateText, inst) {


        function isDonePressed() {
          return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
        }

        if (isDonePressed()) {
          var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
          var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');

          $('.exp-date-picker').focusout() //Added to remove focus from datepicker input box on selecting date
        }
      },
      beforeShow: function(input, inst) {

        inst.dpDiv.addClass('month_year_datepicker')

        if ((datestr = $(this).val()).length > 0) {
          year = datestr.substring(datestr.length - 4, datestr.length);
          month = datestr.substring(0, 2);
          $(this).datepicker('option', 'defaultDate', new Date(year, month - 1, 1));
          $(this).datepicker('setDate', new Date(year, month - 1, 1));
          $(".ui-datepicker-calendar").hide();
        }
      }
    })
  });
</script>
<script>
  // Month and Year Select Picker

  // $(document).ready(function() {
  //   $('#start_date').pickadate({
  //     yearSelector: true,
  //     monthSelector: true,
  //     format: 'yyyy-mm-dd'
  //   });
  // });
  $(function() {
    $("#start_date").datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  $(function() {
    $("#end_date").datepicker({
      dateFormat: "yy-mm-dd",
      onSelect: function() {
        myfunc();
      }
    });
  });

  function myfunc() {
    var start = $("#start_date").datepicker("getDate");
    var end = $("#end_date").datepicker("getDate");
    days = (end - start) / (1000 * 60 * 60 * 24);
    $("#calculate_amount").val($("#vehicle_price").val() + " * " + Math.round(days) + "(Days)");
    var total_price = ($("#vehicle_price").val()) * (Math.round(days));
    console.log(total_price);
    $("#total_amount").val(total_price);
    //alert(Math.round(days));
  }

  // $(document).ready(function() {
  //   $('#end_date').pickadate({
  //     yearSelector: true,
  //     monthSelector: true,
  //     format: 'yyyy-mm-dd'
  //   });
  // });
</script>
@endsection