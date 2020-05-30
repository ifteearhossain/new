@extends('layouts.dashboard')

@section('title')
 Ekomalls | Phone Verification
@endsection

@section('verify')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Phone Pending Verification</span>
  </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        Failed Phone Verification
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Sl</th>
                                    <th>User name</th>
                                    <th>Phone number</th>
                                    <th>OTP</th>
                                    <th>Created at</th>
                                </tr>
                                @forelse ($verifies as $verify)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $verify->getUser->name }}</td>
                                        <td>+{{ $verify->areacode }} {{ $verify->phone_number }}</td>
                                        <td>****</td>
                                        <td>{{ $verify->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty 
                                      <tr>
                                          <td>You have no failed verification</td>
                                      </tr>  
                                @endforelse
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        Ekomalls
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection