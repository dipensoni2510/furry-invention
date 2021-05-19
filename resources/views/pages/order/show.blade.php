@extends('layouts/contentLayoutMaster')
@section('title', 'Order View Page')
@section('page-style')
<style>
  table td {
    padding-bottom: 0.8rem;
    min-width: 140px;
    word-break: break-word;
  }
</style>
@endsection
@section('content')
<div class="row">
  @if(auth()->user()->role === 'admin')
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title pb-1"><b>User Details</b></h5>
        <div class="col-sm-6 col-12 pl-0">
          <table>
            <tr>
              <td class="font-weight-bold">First Name</td>
              <td> {{ $order->user->first_name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Email</td>
              <td>{{ $order->user->email }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12 pl-0">
          <table>
            <tr>
              <td class="font-weight-bold">Last Name</td>
              <td> {{ $order->user->last_name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Mobile Number</td>
              <td> {{ $order->user->mobile }} </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title pb-1"><b>Order Details</b></h5>
        <div class="col-sm-6 col-12 pl-0">
          <table>
            <tr>
              <td class="font-weight-bold">Date & Time</td>
              <td> {{ $order->created_at }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Take Date</td>
              <td>{{ $order->take_date }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12 pl-0">
          <table>
            <tr>
              <td class="font-weight-bold">Total Rent</td>
              <td> {{ $order->total_amount }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Return Date</td>
              <td> {{ $order->return_date }} </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- account start -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title pb-1">Vehicle Details</div>
        <div class="row">
          <div class="col-sm-6 col-12">
            <table>
              <tr>
                <td class="font-weight-bold">Type</td>
                <td> {{ $order->vehicle->name }} </td>
              </tr>
              <tr>
                <td class="font-weight-bold">Modle</td>
                <td>{{ $order->vehicle->model }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">Wheels</td>
                <td> {{ $order->vehicle->wheels }} </td>
              </tr>
              <tr>
              <tr>
                <td class="font-weight-bold">price</td>
                <td>{{ $order->vehicle->price}}</td>
              </tr>
            </table>
          </div>
          <div class="col-md-6 col-12">
            <table>
              <tr>
                <td class="font-weight-bold">Company</td>
                <td> {{ $order->vehicle->company->name }} </td>
              </tr>
              <tr>
                <td class="font-weight-bold">Type</td>
                <td> {{ $order->vehicle->vehicle_type }} </td>
              </tr>
              <tr>
                <td class="font-weight-bold">Gear Type</td>
                <td>{{ $order->vehicle->gear_type }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">Specifications</td>
                <td>{{ $order->vehicle->specifications }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/orders" class="btn btn-outline-dark">Back</a>
  </div>
</div>
<!-- account end -->
@endsection