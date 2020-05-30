@php
    error_reporting(0);
@endphp
@extends('layouts.dashboard')

@section('title')
 Ekomalls | Banner Productpage Big
@endsection

@section('banner')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Productpage Big Banners</span>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <div class="card-header">
                <h1 class="text-center">Add Productpage Big Banners</h1>
              </div>
              <div class="card-body">
                <form class="form-group" action="{{ route('bannerProduct.bigPost') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="py-3">
                      <label for="banner">Enter Banner Image (Preferred Dimension 1620 X 392)</label>
                    <input class="form-control" type="file" name="banner_image">
                    @error('banner_image')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary">Add Banner</button>
                  </div>
                  @if($errors->all())
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </div>
                  @endif
                </form>
              </div>
            </div>
          </div>
      <div class="col-lg-12 m-auto py-3">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">All Banner's</h1>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>Banner Image</th>
                <th>Created at</th>
                <th>Action</th>
                <th></th>
              </tr>
              @forelse($banners as $banner)
              <tr>
                 <td>{{ $loop->index +1  }}</td>
                 <td>
                     <img src="{{ asset('uploads/banners/productpageBig') }}/{{ $banner->banner_image }}" alt="" width="500">
                 </td>
                 <td>{{ $banner->created_at->diffForHumans() }}</td>
                 <td>
                   <a href="{{ route('bannerProduct.bigDelete', $banner->id) }}" class="btn btn-warning">Delete</a>
                 </td>

              </tr>
            @empty
              <tr>
                <td>No Data Available</td>
              </tr>
            @endforelse
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection