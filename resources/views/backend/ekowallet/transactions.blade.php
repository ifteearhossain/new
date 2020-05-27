@extends('layouts.dashboard')


@section('title')
   Ekomalls | Transactions
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Transaction History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach ($transactions as $transaction)
                                 <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ ($transaction->payable_type == 'App\User') ? $transaction->type : 'Products Ordered' }}</td>
                                    <td>{{ $transaction->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $transaction->amount/100 }}</td>
                                  </tr>
                                 @endforeach
                                  <tr>
                                    <th scope="row">#</th>
                                    <th colspan="2">Total : </th>
                                    <th>{{ Auth::user()->balance/100 }}</th>
                                  </tr>
                                </tbody>
                              </table>
                           </div>
                    </div>
                    <div class="card-footer">
                        Here you can view all the transactions you have made through Ekowallet.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection