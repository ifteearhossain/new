@extends('layouts.frontend')

@section('title')
    Ekomalls | Checkout Page 
@endsection

@section('content')
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop-default.html">Shop</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <div class="ps-checkout ps-section--shopping">
        <div class="container">
            <div class="ps-section__header">
                <h1>Checkout</h1>
            </div>
            <div class="ps-section__content">
                <form id="submission" class="ps-form--checkout" action="{{ route('checkout.order') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12  ">
                             @if($errors->all())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                             @endif
                            <div class="ps-form__billing-info">
                                <h3 class="ps-form__heading">Billing Details</h3>
                                <div class="form-group">
                                    <label>Full Name<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <input name="billing_fullname" class="form-control" type="text" value="{{ Auth::user()->name }}">
                                        @error('billing_fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <input name="billing_email" class="form-control" type="email" value="{{ Auth::user()->email }}">
                                        @error('billing_email')
                                          <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Country<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <select id="country_id" name="country_id" class="form-control">
                                            <option value="{{ Auth::user()->country_id ?? "" }}">{{ (Auth::user()->country_id) ? $user_country->name :" -Select your country-" }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                                @error('country_id')
                                                  <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label>State<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <select name="state_id" class="form-control" id="state_id">
                                            <option value="{{ Auth::user()->state_id ?? "" }}">{{ (Auth::user()->state_id) ? $user_state->name : "-Select Your State-" }}</option>
                                            @error('state_id')
                                              <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
`                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>City<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <select name="city_id" class="form-control" id="city_id">
                                            <option value="{{ Auth::user()->city_id }}">{{ (Auth::user()->city_id) ? $user_city->name : "-Select Your City-" }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <span style="float:left; border:1px solid rgba(0, 0, 0, 0.15); padding:13.5px; color: #000;" >
                                            <select name="areacode" id="areacode" style="border:none;">
                                                <option value="{{ Auth::user()->areacode }}">{{ Auth::user()->areacode ?? "" }}</option>
                                            </select>
                                        
                                        </span>
                                        <input id="phone_number" style="width:87%; margin-bottom:20px;" class="form-control" type="number" name="phone_number" placeholder="Enter Phone number" value="{{ Auth::user()->phone_number }}">
                                        @error('phone_number')
                                           <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <input name="address" class="form-control" type="text" value="{{ (Auth::user()->address) ? Auth::user()->address : ''}}" placeholder="Enter Address">
                                        @error('address')
                                          <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Zipcode<sup>*</sup>
                                    </label>
                                    <div class="form-group__content">
                                        <input name="billing_zipcode" class="form-control" type="text">
                                        @error('billing_zipcode')
                                          <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div style="display: none;" id="shipping" class="ps-form__billing-info">
                                    <h3 class="ps-form__heading">Shipping Details</h3>
                                    <div class="form-group">
                                        <label>Full Name<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input name="shipping_fullname" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input name="shipping_email"  class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Country<sup>*</sup>
                                        </label>
                                        <div  class="form-group__content">
                                            <input name="shipping_country" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input name="shipping_phone_number" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input name="shipping_address" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Zip Code<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input name="shipping_zipcode" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="cb01">
                                        <label for="cb01">Ship to a different address?</label>
                                    </div>
                                </div>
                                <h3 class="mt-40"> Addition information</h3>
                                <div class="form-group">
                                    <label>Order Notes</label>
                                    <div class="form-group__content">
                                        <textarea name="notes" class="form-control" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                             
                            </div>
                       
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12  ">
                            <div class="ps-form__total">
                                <h3 class="ps-form__heading">Your Order</h3>
                                <div class="content">
                                    <div class="ps-block--checkout-total">
                                        <div class="ps-block__header">
                                            <p>Product</p>
                                            <p>Total</p>
                                        </div>
                                        <div class="ps-block__content">
                                            <table class="table ps-block__products">
                                                <tbody>
                                                    @foreach (cartItems() as $item)
                                                    <tr>
                                                        <td><a href="{{ route('product.details', $item->cartProduct->product_slug) }}">{{ $item->cartProduct->product_name }} ×{{ $item->quantity }}</a>
                                                            <p>Sold By:<strong>
                                                                @if($item->cartProduct->shop_id != null)
                                                                    {{ $item->cartProduct->getshop->shop_name }}
                                                                @else 
                                                                    Ekomalls
                                                                @endif    
                                                            </strong></p>
                                                        </td>
                                                        <td>${{ ($item->cartProduct->discount_price != null) ? $item->cartProduct->discount_price : $item->cartProduct->product_price }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <h4 class="ps-block__title">Subtotal <span>${{ subTotal() }}</span></h4>
                                            @isset($coupon_name)
                                            <h5> Coupon : {{ $coupon_name }} </h5>
                                            @endisset
                                            <h3>Total <span>$
                                                @isset($coupon_name)
                                                   @foreach (cartItems() as $item)
                                                     @php
                                                         $disc = $item->cartProduct->discount_price;
                                                     @endphp
                                                   @endforeach
                                                @if($disc != null)
                                                    <script> window.location = "/cart?msg=Coupon code cannot be used on discounted items" </script>   
                                                @else 
                                                  {{ $total = subTotal() - ((coupon($coupon_name)->coupon_discount / 100) * subTotal()) }}
                                                @endif
                                                @else 
                                                    {{ subTotal() }}
                                                @endisset
                                            </span></h3>
                                        </div>
                                          <input type="hidden" name="sub_total" value="{{ subTotal() }}" >
                                          <input type="hidden" name="coupon_name" value="{{ $coupon_name ?? "" }}" >
                                          <input type="hidden" name="total" value="{{ $total ?? subTotal() }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input name="payment_method" value="1" class="form-control" type="radio" id="cod" checked>
                                            <label for="cod">Cash on Delivery</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input  name="payment_method" value="2" class="form-control" type="radio" id="stripe">
                                            <label for="stripe">Pay via Card</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input name="payment_method" value="3" class="form-control" type="radio" id="paypal">
                                            <label id="PayPal" for="paypal">Pay with PayPal</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input name="payment_method" value="4" class="form-control" type="radio" id="ekowallet">
                                            <label id="EkoWallet" for="ekowallet">Pay with Ekowallet</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="ps-btn ps-btn--fullwidth">Proceed to checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function(){
            $("#cb01").click(function(){
                $("#shipping").toggle("show");
            })    
        })
    </script>

<script>
    $(document).ready(function (){
        $('#country_id').change(function(){
            var country_id = $(this).val();

            // Ajax Default Code Starts 

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Ajax Default Code Ends    

            // Ajax Request starts

            $.ajax({

                type: 'POST',
                url: '/get/state',
                data: {country_id:country_id},
                success: function(data)
                {
                   $("#state_id").html(data);
                }

            });

            // Ajax Request ends



        });
    });
</script>
<script>
    $(document).ready(function (){
        $('#country_id').change(function(){
            var country_id = $(this).val();

            // Ajax Default Code Starts 

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Ajax Default Code Ends    

            // Ajax Request starts

            $.ajax({

                type: 'POST',
                url: '/get/code',
                data: {country_id:country_id},
                success: function(data)
                {
                   $("#areacode").html(data);
                }

            });

            // Ajax Request ends



        });
    });
</script>
<script>
    $(document).ready(function (){
        $('#state_id').change(function(){
            var state_id = $('#state_id').val();

            // Ajax Default Code Starts 

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Ajax Default Code Ends    

            // Ajax Request starts

            $.ajax({

                type: 'POST',
                url: '/get/city',
                data: {state_id:state_id},
                success: function(data)
                {
                   $("#city_id").html(data);
                }

            });

            // Ajax Request ends

        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#PayPal").click(function(){
            var form = document.getElementById('submission')
                form.action = "{{ route('create-payment') }}"      
                console.log(form)
        })
        $("#cod").click(function(){
            var form = document.getElementById('submission')
                form.action = "{{ route('checkout.order') }}"      
                console.log(form)
        })
        $("#stripe").click(function(){
            var form = document.getElementById('submission')
                form.action = "{{ route('checkout.order') }}"      
                console.log(form)
        })
        $("#EkoWallet").click(function(){
            var form = document.getElementById('submission')
                form.action = "{{ route('checkout.order') }}"      
                console.log(form)
        })
    })
</script>
@endsection