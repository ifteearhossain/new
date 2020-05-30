@extends('layouts.frontend')

@section('title')
    Ekomalls | Terms & Conditions
@endsection

@section('content')


<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Terms &  Conditions</li>
        </ul>
    </div>
</div>


    <!--  terms & Condition start-->

    <section id="terms">




        <div class="container">
            <div class="row">
                <div class="col-xs-12 py-5">
                    <div class="section-policy">


                        <h2 class="pb-5">Terms & Conditions</h2>

                        @foreach ($terms as $term)
                        <h3>{{ $term->toc_heading }}</h3>
                        <p>{{ $term->toc_details }}</p>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection