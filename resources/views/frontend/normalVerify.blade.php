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
                          <form action="{{ route('verify.done') }}" method="POST">
                            @csrf
                            <label for="verify">Verify Your Phone number</label>
                            <input type="hidden" name="areacode" value="{{ $areacode }}">
                            <input type="hidden" name="phone_number" value="{{ $phone_number }}">
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