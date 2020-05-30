@extends('layouts.frontend')

@section('title')
    Ekomalls | Phone Verification
@endsection

@section('content')

<div class="container">
    <div class="row py-5">
         @if($errors->all())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </div>
         @endif
        <div class="col-lg-6 col-sm-12 col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Please Verify Your Phone Number.</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('regular.verify') }}" method="post">
                        @csrf 
                        <div class="py-3">
                            {{-- <input name="areacode" type="text" class="form-control" placeholder="Country code"> --}}
                            <select class="form-control" name="areacode" id="">
                                <option value="">-Select Your Country code--</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->phonecode }}">{{ $country->name }} +{{ $country->phonecode }}</option>
                                @endforeach
                            </select>
                            <input name="phone_number" type="text" class="form-control" placeholder="Enter Phone number">
                        </div>
                        <div class="py-3">
                            <button type="submit" class="btn btn-primary">Send Verification Code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>

@endsection