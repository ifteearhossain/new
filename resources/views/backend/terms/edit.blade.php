@extends('layouts.dashboard')

@section('title')
  Frequently Asked Question
@endsection

@section('toc')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <a class="breadcrumb-item" href="{{ route('toc.index') }}">All Term's</a>
    <span class="breadcrumb-item active">{{ $toc->toc_heading }}</span>
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
            <h1 class="text-center">Edit T&C</h1>
          </div>
          <div class="card-body">
            <form class="form-group" action="{{ route('toc.update', $toc->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
              <div class="py-3">
                <input type="hidden" name="id" value="{{ $toc->id }}">
                <input class="form-control" type="text" name="toc_heading" placeholder="Enter toc?" value="{{ $toc->toc_heading }}">

              </div>
              <div class="py-3">
                <input class="form-control" type="text" name="toc_details" placeholder="Answer" value="{{ $toc->toc_details }}">

              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">Update Terms & Conditions</button>
              </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
