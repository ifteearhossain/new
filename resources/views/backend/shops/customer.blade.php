@extends('layouts.dashboard')

@section('title')
   Shops
@endsection

@section('shops-active')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('customer.index') }}"> Customer Dashboard</a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Shop</span>
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
                    <div class="card-body">
                    <h5 class="card-title">Here user will be redirected to frontend become a vendor page</h5>
                    <p class="card-text">This is a temporary Add Shop button for development purpose</p>
                  <div class="py-3">
                   <a href="{{ route('shops.create') }}" class="btn btn-success">Create Your Shop</a>
                  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection