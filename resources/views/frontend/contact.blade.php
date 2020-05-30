@extends('layouts.frontend')

@section('title')
    Ekomalls | Contact
@endsection

@section('content')
<div class="ps-page--single" id="contact-us">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <div class="ps-contact-form">
        <div class="container">
            @if($errors->all())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <form class="ps-form--contact-us" action="{{ route('frontend.contactPost') }}" method="post">
                @csrf
                <h3>Get In Touch</h3>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input name="name" class="form-control" type="text" placeholder="Name *" value="{{ Auth::user()->name ?? '' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input name="email" class="form-control" type="text" placeholder="Email *" value="{{ Auth::user()->email ?? '' }}">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input name="subject" class="form-control" type="text" placeholder="Subject *">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="5" placeholder="Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="ps-btn">Send message</button>
                </div>
                @if(session('success'))
                    <div class="alert success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection