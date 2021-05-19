@extends('layouts/contentLayoutMaster')
@section('title', 'User View')
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
              <td class="font-weight-bold">First Name</td>
              <td> {{ $user->first_name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Email</td>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Role</td>
              <td>{{ $user->role }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Last Name</td>
              <td> {{ $user->last_name }} </td>
            </tr>

            <tr>
              <td class="font-weight-bold">Mobile</td>
              <td>{{ $user->mobile }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Created At</td>
              <td>{{ $user->created_at }}</td>
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
    <a href="/users" class="btn btn-outline-dark mr-1">Back</a>
  </div>
</div>
<!-- account end -->
@endsection
