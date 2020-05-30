@extends('layouts.frontend')

@section('title')
    Ekomalls | Bank Transfer
@endsection

@section('content')
  <div class="container">
      @if(session('success'))
        <div class="alert alert-success py-3">
            {{ session('success') }}
        </div>
      @endif
      <div class="row" style="padding:100px 0;">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Bank Transfer (Nigeria)</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Polaris Bank Nigeria limited</h5>
                    <p class="card-text">Account name : Chijioke Christian Akuneziri </p>
                    <p class="card-text">Account no : 1700076136 </p>
                </div>
                <div class="card-footer">
                  Thank you for shopping with Ekomalls.
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Bank Transfer (Norway)</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">DNB</h5>
                    <p class="card-text">Account name : Asgnorge Akuneziri</p>
                    <p class="card-text">Account no : 15035684383</p>
                </div>
                <div class="card-footer">
                  Thank you for shopping with Ekomalls.
                </div>
            </div>
        </div>
      </div>
      <div class="alert alert-info py-3">
          <p>Please Note: Send us a copy of ur payment and order number to email info@ekomalls.com or tele/ whatsaap no  004792117840 or contact us via live chat with your copy of payment and order number to confirm the order</p>
      </div>
      <div class="text-center">
          <a href="{{ url('/') }}" class="btn primary">Back to Home</a>
      </div>
  </div>
@endsection