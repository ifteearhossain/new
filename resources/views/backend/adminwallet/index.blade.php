@extends('layouts.dashboard')

@section('title')
    Ekomalls | Wallet
@endsection

@section('wallet')
    active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Wallet</span>
  </nav>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>All users wallet information</h5>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                           <table class="table tabl-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>${{ $user->balanceFloat }}</td>
                                    </tr>
                                @endforeach
                           </table>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                               <li> {{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-header">
                        Recharge
                    </div>
                    <div class="card-body">
                      <form action="{{ route('user.topup') }}" method="post" class="form-group">
                          @csrf 
                          <div class="py-3">
                              <label for="amount">Recharge amount</label>
                              <input type="number" class="form-control" name="amount">
                          </div>
                          <div class="py-3">
                              <label for="user">User</label>
                              <select name="user" id="user" class="form-control">
                                  <option value="">-Select User-</option>
                                  @foreach ($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="py-3">
                              <button type="submit" class="btn btn-success">Recharge</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>All withdraw requests</h5>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                           <table class="table tabl-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Requested at</th>
                                    <th>Transfer Done</th>
                                </tr>
                                @foreach ($withdraws as $withdraw)
                                    <tr>
                                        <td><a href="{{ route('users.profile', $withdraw->user_id) }}">{{ $withdraw->getuser->name }}</a></td>
                                        <td>{{ $withdraw->method }}</td>
                                        <td>${{ $withdraw->withdraw_amount }}</td>
                                        <td>{{ $withdraw->created_at->format('d-M-Y') }}</td>
                                        <td>
                                           @if($withdraw->transfer == 0)
                                            <a href="{{ route('transfer.done', $withdraw->id) }}" class="btn btn-success">Click Done</a>
                                           @else 
                                              <span class="badge badge-success">transfer made</span>
                                           @endif
                                        </td>
                                    </tr>
                                @endforeach
                           </table>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 py-3">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                               <li> {{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-header">
                        Withdraw
                    </div>
                    <div class="card-body">
                      <form action="{{ route('user.withdraw') }}" method="post" class="form-group">
                          @csrf 
                          <div class="py-3">
                              <label for="amount">Withdraw amount</label>
                              <input type="number" class="form-control" name="amount">
                          </div>
                          <div class="py-3">
                              <label for="user">User</label>
                              <select name="user" id="user" class="form-control">
                                  <option value="">-Select User-</option>
                                  @foreach ($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="py-3">
                              <button type="submit" class="btn btn-success">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection