@extends('layouts.frontend')

@section('title')
    Ekomalls | About us
@endsection

@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>About us</li>
        </ul>
    </div>
</div>
<div class="ps-page--single" id="about-us"><img src="{{ asset('uploads/about') }}/{{ $about->about_banner }}" alt="">
    <div class="ps-about-intro">
        <div class="container">
            <div class="ps-section__header">
                <h4>Welcome to Ekomalls</h4>
                <h3>{{ $about->about_short_description }}</h3>
                <p>{{ $about->about_long_description }}</p>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 ">
                        <div class="ps-block--icon-box"><i class="icon-cube"></i>
                            <h4>{{ $totalProducts }}</h4>
                            <p>Product for sale</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 ">
                        <div class="ps-block--icon-box"><i class="icon-store"></i>
                            <h4>{{ $totalSellers }}</h4>
                            <p>Sellers Active on Ekomalls</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 ">
                        <div class="ps-block--icon-box"><i class="icon-bag2"></i>
                            <h4>{{ $totalCustomers }}</h4>
                            <p>Buyer active on Ekomalls</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection