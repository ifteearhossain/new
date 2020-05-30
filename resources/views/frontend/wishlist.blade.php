@extends('layouts.frontend')

@section('title')
    Ekomalls | Wishlist
@endsection

@section('content')
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Whishlist</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-whishlist">
        <div class="container">
            <div class="ps-section__header">
                <h1>Wishlist</h1>
            </div>
            @if(session('failed'))
               <div class="alert alert-danger">
                {{ session('failed') }}    
               </div> 
            @endif
            @if($errors->all())
               <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach    
               </div> 
            @endif
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--whishlist">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product name</th>
                                <th>Unit Price</th>
                                <th>Stock Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlists as $wishlist)
                            <tr>
                                <td><a href="{{ route('remove.wish', $wishlist->id) }}"><i class="icon-cross"></i></a></td>
                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="{{ route('product.details', $wishlist->get_product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $wishlist->get_product->product_thumbnail_image }}" alt=""></a></div>
                                        <div class="ps-product__content"><a href="{{ route('product.details', $wishlist->get_product->product_slug) }}">{{ $wishlist->get_product->product_name }}</a></div>
                                    </div>
                                </td>
                                <td class="price">$ {{ ($wishlist->get_product->discount_price != null) ? number_format($wishlist->get_product->discount_price) : number_format($wishlist->get_product->product_price) }}</td>
                                <td>
                                    @if($wishlist->get_product->product_quantity > 0)
                                    <span class="ps-tag ps-tag--in-stock">In-stock</span>
                                    @else 
                                    <span class="ps-tag ps-tag--out-stock">Out of stock</span>
                                    @endif
                                </td>
                                <td>

                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $wishlist->get_product->id }}" name="product_id">
                                        <button class="ps-btn" type="submit">Add to cart</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection