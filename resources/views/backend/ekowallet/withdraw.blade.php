@extends('layouts.dashboard')


@section('title')
  Ekomalls | Ekowallet Deposit  
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title">Withdraw funds from your wallet</h5>
                        </div>
                        <div class="card-body">
                            <p>Eko wallet is secure and you can shop, withdraw  in ekomalls with your ekowallet balances</p>
                            <p>Sellers must have minimum 0.20 USD in wallet to list a product.</p>

                            <form class="form-group" action="{{ route('withdraw.post') }}" method="POST">
                                @csrf
                                <div class="py-3">
                                    <label for="withdraw">Withdraw Amount</label>
                                    <input id="withdraw" type="text" class="form-control" name="withdraw_amount" value="5">
                                </div>
                                <label class="rdiobox">
                                    <input name="method" value="bank_transfer" type="radio" checked>
                                    <span>Bank Transfer</span>
                                </label>
                                <label class="rdiobox">
                                    <input name="method" value="paypal" type="radio">
                                    <span>PayPal</span>
                                </label>
                                <div class="py-3 text-center">
                                    <button type="submit" class="btn btn-success">Withdraw now</button>
                                </div>
                            </form>
                        </div>
                          @if (session('success'))
                              <div class="alert alert-success">
                                  {{ session('success') }}
                              </div>
                          @endif
                          @if ($errors->all())
                              <div class="alert alert-danger">
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </div>
                          @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection