@extends('layouts.frontend')

@section('title')
    Ekomalls | Phone Verification
@endsection

@section('content')
 <div class="container">
     <div class="row py-5">
         <div class="col-lg-6 col-sm-12 col-md-12 m-auto">
             <div class="card">
                 <div class="card-header">
                     <h5 class="text-center">Verification code has been sent to your phone number.</h5>
                 </div>
                 <div class="card-body">
                    <div class="form-group">
                        <div class="py-3">
                          <form action="{{ route('paypal.verify') }}" method="POST">
                            @csrf
                            <label for="verify">Verify Your Phone number</label>
                            <input type="hidden" name="billing_fullname" value="{{ $billing_fullname }}">
                            <input type="hidden" name="billing_email" value="{{ $billing_email }}">
                            <input type="hidden" name="country_id" value="{{ $country_id }}">
                            <input type="hidden" name="state_id" value="{{ $state_id }}">
                            <input type="hidden" name="city_id" value="{{ $city_id }}">
                            <input type="hidden" name="areacode" value="{{ $areacode }}">
                            <input type="hidden" name="phone_number" value="{{ $phone_number }}">
                            <input type="hidden" name="address" value="{{ $address }}">
                            <input type="hidden" name="billing_zipcode" value="{{ $billing_zipcode }}">
                            <input type="hidden" name="shipping_fullname" value="{{ $shipping_fullname ?? $billing_fullname }}">
                            <input type="hidden" name="shipping_email" value="{{ $shipping_email ?? $billing_email }}">
                            <input type="hidden" name="shipping_country" value="{{ $shipping_country ?? $country_id }}">
                            <input type="hidden" name="shipping_phone_number" value="{{ $shipping_phone_number ?? $phone_number }}">
                            <input type="hidden" name="shipping_address" value="{{ $shipping_address ?? $address }}">
                            <input type="hidden" name="shipping_zipcode" value="{{ $shipping_zipcode ?? $billing_zipcode }}">
                            <input type="hidden" name="notes" value="{{ $notes ?? "" }}">
                            <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                            <input type="hidden" name="coupon_name" value="{{ $coupon_name ?? "" }}">
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="payment_method" value="{{ $payment_method }}">
                            <input id="verify" type="number" class="form-control mb-3" name="otp">
                            <button type="submit" class="btn btn-success btn-lg py-3 text-center">Proceed to checkout</button>
                          </form>
                        </div>
                    </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection