@extends('layouts.dashboard')

@section('title')
  Frequently Asked Question
@endsection

@section('policy')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <a class="breadcrumb-item" href="{{ route('policies.index') }}">All policy's</a>
    <span class="breadcrumb-item active">{{ $policy->policy_heading }}</span>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 m-auto">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">Edit policy</h1>
          </div>
          <div class="card-body">
            <form class="form-group" action="{{ route('policies.update', $policy->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
              <div class="py-3">
                <input type="hidden" name="id" value="{{ $policy->id }}">
                <input class="form-control" type="text" name="policy_heading" placeholder="Enter policy?" value="{{ $policy->policy_heading }}">

              </div>
              <div class="py-3">
                <input class="form-control" type="text" name="policy_details" placeholder="Answer" value="{{ $policy->policy_details }}">

              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">Update policy</button>
              </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
