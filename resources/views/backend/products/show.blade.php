@extends('layouts.dashboard')

@section('title')
   Product
@endsection

@section('products-active')
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
    <span class="breadcrumb-item active">{{ $product->product_name }}</span>
  </nav>

@endsection

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1>{{ $product->product_name }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark">
                        </div>
                            <thead>
                                <th>Name :</th>
                                <td>{{ $product->product_name }}</td>
                            </thead>
                            <tbody>
                                <th>Price</th>
                                <td>${{ $product->product_price }}</td>
                            </tbody>
                            <thead>
                                <th>Brand</th>
                                <td>{{ $product->product_brand }}</td>
                            </thead>
                            <tbody>
                                <th>Category</th>
                                <td>{{ $product->getsubcategory->relationBetweenCategory->category_name }}</td>
                            </tbody>
                            <thead>
                                <th>category</th>
                                <td>{{ $product->getsubcategory->sub_category_name }}</td>
                            </thead>
                            <tbody>
                                <th>Quantity</th>
                                <td>{{ $product->product_quantity }} pcs</td>
                            </tbody>
                            <thead>
                                <th>Shop</th>
                                <td>{{ $product->getshop->shop_name ?? "No shop available for this product" }}</td>
                            </thead>
                            <tbody>
                                <th>Description</th>
                                <td>{!! $product->product_short_description !!}</td>
                            </tbody>
                            <tbody>
                                <th>Long Desc</th>
                                <td>{!! $product->product_long_description !!}</td>
                            </tbody>
                            <tbody>
                                <th>Image</th>
                                
                                <td>
                                    <div class="text-center">
                                        <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="Not found" width="200">
                                    </div>
                                </td>
                            </tbody>
                            <tbody>
                                <th>Images</th>
                                <td>
                                    @foreach ($product->getmultipleimage as $pro)
                                    <img style="margin-left:100px;" src="{{ asset('uploads/products/product_multiple_image') }}/{{ $pro->product_multiple_image }}" alt="Not found" width="200">
                                    @endforeach
                                </td>
                            </tbody>
                          </table>
                          <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection 
