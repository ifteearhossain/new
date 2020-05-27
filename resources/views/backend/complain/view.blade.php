@extends('layouts.dashboard')

@section('title')
  Ekomalls | Complains   
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Complains</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="py-2">From : {{ \App\User::find($complain->user_id)->name }}</h6>
                        <p class="py-2">Order # : {{ $complain->order_id }}</p>
                        <p class="pt-2 pb-5">Subject : {{ $complain->complain }}</p>
                        <a href="mailto:{{ \App\User::find($complain->user_id)->email }}" class="btn btn-info">Reply now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection