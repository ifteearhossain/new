@extends('layouts.frontend')

@section('title')
    Ekomalls | Policy
@endsection

@section('content')


<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Policy</li>
        </ul>
    </div>
</div>


    <!--  terms & Condition start-->

    <section id="terms">




        <div class="container">
            <div class="row">
                <div class="col-xs-12 py-5">
                    <div class="section-policy">


                        <h2 class="pb-5">Privacy Policy</h2>

                        @foreach ($policies as $policy)
                        <h3>{{ $policy->policy_heading }}</h3>
                        <p>{{ $policy->policy_details }}</p>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection