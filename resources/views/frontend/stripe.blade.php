@extends('layouts.frontend')

   @section('content')
   <div class="container">
    <div class="row py-5">
        <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header" >
                        <div>
                            <h3 class="d-inline-block">Payment information</h3>
                        </div>
                        <div class="text-center" >                            
                            <img class="img-responsive pull-right" src="{{ asset('frontend_assets/card.png') }}">
                        </div>                
                </div>
                <div class="card-body">
  
                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ 'sk_test_firDb2BrvwKsLBZBcsv70lWJ00e8vefitV' }}"
                                                    id="payment-form">
                        @csrf
  
                        <div class='form-group'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> 
                                <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-group'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xs-12 pl-5">
                                <input type="hidden" name="billing_fullname" value="{{ $billing_fullname ?? "" }}">
                                <input type="hidden" name="billing_email" value="{{ $billing_email ?? "" }}">
                                <input type="hidden" name="country_id" value="{{ $country_id ?? "" }}">
                                <input type="hidden" name="state_id" value="{{ $state_id ?? "" }}">
                                <input type="hidden" name="city_id" value="{{ $city_id ?? "" }}">
                                <input type="hidden" name="areacode" value="{{ $areacode ?? "" }}">
                                <input type="hidden" name="phone_number" value="{{ $phone_number ?? "" }}">
                                <input type="hidden" name="address" value="{{ $address ?? "" }}">
                                <input type="hidden" name="billing_zipcode" value="{{ $billing_zipcode ?? "" }}">
                                @isset($deposit_amount)
                                    <input type="hidden" name="deposit_amount" value="{{ $deposit_amount/100 }}">
                                @else 
                                <input type="hidden" name="shipping_fullname" value="{{ $shipping_fullname ?? $billing_fullname }}">
                                <input type="hidden" name="shipping_email" value="{{ $shipping_email ?? $billing_email }}">
                                <input type="hidden" name="shipping_country" value="{{ $shipping_country ?? $country_id }}">
                                <input type="hidden" name="shipping_phone_number" value="{{ $shipping_phone_number ?? $phone_number }}">
                                <input type="hidden" name="shipping_address" value="{{ $shipping_address ?? $address }}">
                                <input type="hidden" name="shipping_zipcode" value="{{ $shipping_zipcode ?? $billing_zipcode }}">
                                @endisset
                                <input type="hidden" name="notes" value="{{ $notes ?? "" }}">
                                <input type="hidden" name="sub_total" value="{{ $sub_total ?? "" }}">
                                <input type="hidden" name="coupon_name" value="{{ $coupon_name ?? "" }}">
                                <input type="hidden" name="total" value="{{ $total ?? "" }}">
                                <input type="hidden" name="payment_method" value="{{ $payment_method ?? "" }}">
                                <button class="ps-btn ps-btn--fullwidth" type="submit">Pay Now (${{ $total ?? $deposit_amount/100 }})</button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        </div>
    </div>
      
</div>  
   @endsection

   @section('footer_script')
   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
   <script type="text/javascript">
   $(function() {
       var $form         = $(".require-validation");
     $('form.require-validation').bind('submit', function(e) {
       var $form         = $(".require-validation"),
           inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
           $inputs       = $form.find('.required').find(inputSelector),
           $errorMessage = $form.find('div.error'),
           valid         = true;
           $errorMessage.addClass('d-none');
    
           $('.has-error').removeClass('has-error');
       $inputs.each(function(i, el) {
         var $input = $(el);
         if ($input.val() === '') {
           $input.parent().addClass('has-error');
           $errorMessage.removeClass('d-none');
           e.preventDefault();
         }
       });
     
       if (!$form.data('cc-on-file')) {
         e.preventDefault();
         Stripe.setPublishableKey('pk_live_w9aVjjyCk5dgFZdcoSMKCJGa00486Oq5qC');
        //  Stripe.setPublishableKey('pk_test_JI1oswkOtt37AbIiGwNB6kYC003I2xAVKx');
         Stripe.createToken({
           number: $('.card-number').val(),
           cvc: $('.card-cvc').val(),
           exp_month: $('.card-expiry-month').val(),
           exp_year: $('.card-expiry-year').val()
         }, stripeResponseHandler);
       }
     
     });
     
     function stripeResponseHandler(status, response) {
           if (response.error) {
               $('.error')
                   .removeClass('d-none')
                   .find('.alert')
                   .text(response.error.message);
           } else {
               // token contains id, last4, and card type
               var token = response['id'];
               // insert the token into the form so it gets submitted to the server
               $form.find('input[type=text]').empty();
               $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
               $form.get(0).submit();
           }
       }
     
   });
   </script>
   @endsection