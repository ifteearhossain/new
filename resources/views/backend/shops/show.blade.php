@extends('layouts.dashboard')

@section('title')
   Product
@endsection

@section('shops-active')
  active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    <a class="breadcrumb-item" href="{{ route('products.index') }}">Product</a>
    <span class="breadcrumb-item active">{{ $shop->shop_name }}</span>
  </nav>

@endsection

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1>{{ $shop->shop_name }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark">
                        </div>

                            <thead>
                                <th>Name :</th>
                                <td>{{ $shop->shop_name }}</td>
                            </thead>
                            <tbody>
                                <th>Description</th>
                                <td>{!! $shop->shop_short_description !!}</td>
                            </tbody>
                            <thead>
                                <th>Description</th>
                                <td>{!! $shop->shop_long_description !!}</td>
                            </thead>
                            <tbody>
                                <th>Address</th>
                                <td>{!! $shop->shop_address !!}</td>
                            </tbody>
                            <thead>
                                <th>Phone</th>
                                <td>{{ $shop->shop_phone_number }}</td>
                            </thead>
                            <thead>
                                <th>Shop Owner</th>
                                <td>{{ $shop->getowner->name  }}</td>
                            </thead>
                            <tbody>
                                <th>Sellers Balance</th>
                                <td>{{ $shop->getowner->balance }}</td>
                            </tbody>
                            <tbody>
                                <th>Shop status</th>
                                <td>{{ $shop->is_active  }}</td>
                            </tbody>
                            <thead>
                                <th><a href="{{ route('products.index') }}">Total Products</a></th>
                                <td>{{ $shop->getproduct->count()  }}</td>
                            </thead>
                            <tbody>
                                <th>Shop licence number :</th>
                                <td><a href="{{ asset('uploads/shops/documents') }}/{{ $shop->shop_license }}">View documents</a></td>
                            </tbody>
                            <thead>
                                <th>Shop Registration number</a></th>
                                <td>{{ $shop->shop_registration_number }}</td>
                            </thead>
                            <tbody>
                                <th>Bank name</th>
                                <td>{{ $shop->bank_name }}</td>
                            </tbody>
                            <thead>
                                <th>Bank account number</th>
                                <td>{{ $shop->bank_account_number }}</td>
                            </thead>
                            <tbody>
                                <th>PayPal</th>
                                <td>{{ ($shop->paypal_account_number) ? $shop->paypal_account_number : 'Not available' }}</td>
                            </tbody>
                            <tbody>
                                <th>Image</th>
                                
                                <td>
                                    <div class="text-center">
                                        <img src="{{ asset('uploads/shops/logo') }}/{{ $shop->shop_logo }}" alt="Not found" width="200">
                                    </div>
                                </td>
                            </tbody>
                            <tbody>
                                <th>Images</th>
                                <td>
                                    <div class="text-center">
                                        <img src="{{ asset('uploads/shops/cover') }}/{{ $shop->shop_cover_image }}" alt="Not found" width="200">
                                    </div>
                                </td>
                            </tbody>
                          </table>
                          <a href="{{ route('shops.index') }}" class="btn btn-primary btn-lg">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection 
