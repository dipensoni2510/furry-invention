@extends('layouts/contentLayoutMaster')
@section('title', 'Vehicle View Page')
@section('page-style')
<style>

  table td{ 
    vertical-align: baseline;
    padding-bottom: 0.8rem;
    min-width: 140px;
    word-break: break-word;  
  } 
  .card-img-top {
    width: 100% !important;
  }
  .card .img {
    width: 50% !important;
  }
</style>
@endsection
@section('content')
<div class="row">
  <!-- account start -->
  <div class="col-12">
    {{-- <div class="card-title">Account</div> --}}
    <div class="row">
    <div class="col-xl-6 col-sm-12">
      <div class="card img">
        <div class="card-content">
        <img class="card-img-top img-fluid" src="{{ $vehicle->image }}" class="w-100 rounded mb-2"
        alt="image">
          {{-- <div class="card-body">
            <h4 class="card-title">{{ $service->title }}</h4>
          </div> --}}
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        {{-- <div class="card-title">Account</div> --}}
        <div class="row">
          {{-- <div class="col-2 users-view-image">
            <img src="{{ $user->avatar }}" class="w-100 rounded mb-2"
          alt="avatar">
          <!-- height="150" width="150" -->
        </div> --}}
        <div class="col-sm-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Vehicle Name</td>
              <td> {{ $vehicle->name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Modle</td>
              <td>{{ $vehicle->model }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Wheels</td>
              <td> {{ $vehicle->wheels }} </td>
            </tr>
            <tr>
            <tr>
              <td class="font-weight-bold">price</td>
              <td>{{ $vehicle->price}}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Company</td>
              <td> {{ $vehicle->company->name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Type</td>
              <td> {{ $vehicle->vehicle_type }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Gear Type</td>
              <td>{{ $vehicle->gear_type }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Specifications</td>
              <td>{{ $vehicle->specifications }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title"><b>Features</b></h5> -->
        <table border="0">
          <thead>
            <th> Features </th>
          </thead>
          <tbody>
            @foreach($vehicle->features as $feature)
            <tr>
              <td>{{ $feature->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/vehicles" class="btn btn-outline-dark">Back</a>
    @if(auth()->user()->role !== "admin")
    <a href="/orders/{{$vehicle->id}}/rent" class="btn btn-primary">Rent</a>
    @endif
  </div>
</div>
<!-- account end -->
@endsection