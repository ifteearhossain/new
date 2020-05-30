@extends('layouts.dashboard')

@section('title')
  Ekomalls | Contact   
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
                        <h6 class="py-2">From : {{ $contact->name }}</h6>
                        <p class="py-2">From : {{ $contact->email }}</p>
                        <p class="pt-2 pb-5">Subject : {{ $contact->subject }}</p>
                        <p class="pt-2 pb-5">Message : {{ $contact->message }}</p>
                        <a href="mailto:{{ $contact->email }}" class="btn btn-info">Reply now</a>
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection