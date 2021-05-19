@extends('layouts/contentLayoutMaster')
@section('title', 'Company View Page')
@section('page-style')
<style>
  table td{ 
    padding-bottom: 0.8rem;
    min-width: 140px;
    word-break: break-word;  
  } 
  </style>
  @endsection
  @section('content')
  <div class="row">
  <!-- account start -->
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
              <td class="font-weight-bold">Company Name</td>
              <td> {{ $company->name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Website</td>
              <td>{{ $company->phone }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Description</td>
              <td> {{ $company->description }} </td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Phone</td>
              <td> {{ $company->website }} </td>
            </tr>
            
            <tr>
              <td class="font-weight-bold">Type</td>
              <td>{{ $company->type }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Address</td>
              <td>{{ $company->address }}</td>
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
    <a href="/companies" class="btn btn-outline-dark">Back</a>
  </div>
</div>
<!-- account end -->
@endsection