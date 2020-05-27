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
                            <h5 class="card-title">Deposit funds to your wallet</h5>
                        </div>
                        <div class="card-body">
                            <p>Eko wallet is secure and you can shop, withdraw  in ekomalls with your ekowallet balances</p>
                            <p>Sellers must have minimum 0.20 USD in wallet to list a product.</p>
                            <p>Minimum recharge amount is 5.00 USD</p>

                            <form class="form-group" action="{{ route('deposit.post') }}" method="POST">
                                @csrf
                                <div class="py-3">
                                    <label for="deposit">Deposit Amount</label>
                                    <input id="deposit" type="text" class="form-control" name="deposit_amount" value="5">
                                </div>
                                <div class="py-3 text-center">
                                    <button type="submit" class="btn btn-success">Deposit now</button>
                                </div>
                            </form>
                        </div>
                          @if (session('success'))
                              <div class="alert alert-success">
                                  {{ session('success') }}
                              </div>
                          @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection