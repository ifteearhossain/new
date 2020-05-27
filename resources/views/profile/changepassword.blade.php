@extends('layouts.dashboard')

@section('title')
   Change Password
@endsection

@section('dashboard-active')
  active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="
        @if (Auth::user()->user_role == 0)
          {{ route('home') }}
        @elseif (Auth::user()->user_role == 1)
          {{ route('admin.index') }}
        @elseif (Auth::user()->user_role == 2)
          {{ route('seller.index') }}
        @else
          {{ route('customer.index') }}
        @endif
     ">
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
    {{-- <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a> --}}
    <span class="breadcrumb-item active">Change Password</span>
  </nav>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Change Password</h1>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('password.changed') }}" method="POST">
                            @csrf 
                            <div class="py-3">
                                <input class="form-control" type="password" name="old_password" placeholder="Enter Old Password">
                                @error('old_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @if(session('failed'))
                                    <small class="text-danger">{{ session('failed') }}</small>
                                @endif
                            </div>
                            <div class="py-3">
                                <input class="form-control" type="password" name="password" placeholder="Enter New Password">
                                @error('password')
                                  <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="py-3">
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Your Password">
                                @error('password_confirmation')
                                  <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="py-3">
                                <button class="btn btn-success" type="submit">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection