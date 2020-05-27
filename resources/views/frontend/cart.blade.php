@extends('layouts.frontend')

@section('title')
    Ekomalls | Cart
@endsection

@section('content')
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop-default.html">Shop</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>Shopping Cart</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart">
                        <thead>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->all())
                                <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                                </div>
                            @endif
                            @if(request('msg'))
                                <div class="alert alert-danger">
                                   {{ request('msg') }}
                                </div>
                            @endif
                            <tr>
                                <th>Product name</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach (cartItems() as $item)
                           <tr>
                            <td>
                                <div class="ps-product--cart">
                                    <div class="ps-product__thumbnail"><a href="{{ route('product.details', $item->cartProduct->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $item->cartProduct->product_thumbnail_image }}" alt=""></a></div>
                                    <div class="ps-product__content"><a href="{{ route('product.details', $item->cartProduct->product_slug) }}">{{ $item->cartProduct->product_name }}</a>
                                        <p>Sold By:<strong>
                                                @if($item->cartProduct->shop_id != null)
                                                    {{ $item->cartProduct->getshop->shop_name }}
                                                @else 
                                                    Ekomalls
                                                @endif
                                              </strong></p>
                                    </div>
                                </div>
                            </td>
                            <td class="price">${{ ($item->cartProduct->discount_price != null) ? $item->cartProduct->discount_price : $item->cartProduct->product_price }}</td>
                            <td>
                                <div class="form-group--number">
                                    <button type="button" onclick="incrementValue({{ $item->id }})" class="up">+</button>
                                    <button type="button" onclick="incrementNegativeValue({{ $item->id }})" class="down">-</button>
                                    <form action="{{ route('cart.update', $item->id)}}" method="post">
                                        @csrf
                                        {{ method_field('PUT') }}
                                    <input name="id[]" type="hidden" value="{{ $item->cartProduct->id }}">
                                    <input name="quantity[]" id="number{{ $item->id }}" class="form-control" type="text" value="{{ $item->quantity }}">
                                </div>
                            </td>
                            <td>
                                @if($item->cartProduct->discount_price != null)
                                    ${{ ($item->quantity * $item->cartProduct->discount_price) }}
                                @else 
                                ${{ ($item->quantity * $item->cartProduct->product_price) }}
                                @endif
                            </td>
                            <td><a href="{{ route('cart.remove', $item->id) }}"><i class="icon-cross"></i></a></td>
                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ps-section__cart-actions">
                    <a class="ps-btn" href="{{ route('front.product') }}"><i class="icon-arrow-left"></i> Back to Shop</a>
                    <button class="ps-btn ps-btn--outline" type="submit"><i class="icon-sync"></i> Update cart</button>
                </form>
                </div>
            </div>
            <div class="ps-section__footer">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>Coupon Discount</figcaption>
                            <div class="form-group">
                                <input id="couponName" class="form-control" type="text" placeholder="Have a coupon?" value="{{ $coupon_discount->coupon_name ?? "" }}">
                            </div>
                            <div class="form-group">
                                <button type="button" id="applyCoupon" class="ps-btn ps-btn--outline">Apply</button>
                            </div>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--shopping-total">
                            <div class="ps-block__header">
                                <p>Subtotal <span> ${{ subTotal() }}</span></p>
                            </div>
                            <div class="ps-block__content">
                                <ul class="ps-block__product">
                                  @foreach (cartItems() as $item)
                                  <li>
                                    <span class="ps-block__shop">
                                        @if($item->cartProduct->shop_id != null)
                                            {{ $item->cartProduct->getshop->shop_name }}
                                        @else 
                                            Ekomalls
                                        @endif
                                    </span>
                                    <span class="ps-block__shipping">Free Shipping</span>
                                    <span><a href="{{ route('product.details',  $item->cartProduct->product_slug) }}">{{ $item->cartProduct->product_name }} ×{{ $item->quantity }}</a></span>
                                </li>
                                  @endforeach
                                </ul>

                                @isset($coupon_discount)
                                  <h3 class="pb-3">Coupon: <span style="font-size: 18px; color:green;">{{ $coupon_discount->coupon_discount }}%</span></h3>
                                  <h3>Total <span>${{ $total = subTotal() - (($coupon_discount->coupon_discount / 100) * subTotal()) }}</span></h3>
                                @else
                                  <h3>Total <span>${{ $total = subTotal() }}</span></h3>
                                @endisset

                               
                            </div>
                        </div>
                        <form action="{{ route('checkout.index') }}" method="POST">
                            @csrf
                            <input type="hidden" name="coupon_name" value="{{ (isset($coupon_discount)) ?  $coupon_discount->coupon_name : "" }}">
                           <button type="submit" class="ps-btn ps-btn--fullwidth">Proceed to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

@section('footer_script')
    <script>
        $(document).ready(function(){
            $('#applyCoupon').click(function(){
               var couponName = $('#couponName').val();
               window.location.href = "{{ url('cart') }}" +'/' + couponName + '/' + 'coupon-trxID029'

            })
        })
    </script>
    <script>
        function incrementValue(id)
        {
            var value = parseInt(document.getElementById('number' + id).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number' + id).value = value;
        }
        function incrementNegativeValue(id)
        {
            var value = parseInt(document.getElementById('number' + id).value, 10);
            value = isNaN(value) ? 0 : value;
            value--;
            document.getElementById('number' + id).value = value;
        }
    </script>
@endsection