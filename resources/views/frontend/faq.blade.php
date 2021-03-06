@extends('layouts.frontend')

@section('title')
    Ekomalls | Frequently Asked Question
@endsection

@section('content')
<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Frequently Asked Questions</li>
            </ul>
        </div>
    </div>
    <div class="ps-faqs">
        <div class="container">
            <div class="ps-section__header">
                <h1>Frequently Asked Questions</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--faqs">
                        <tbody>
                          @foreach ($faqs as $faq)
                          <tr>
                            <td class="question">{{ $faq->faq_question }}</td>
                            <td>{{ $faq->faq_answer }}</td>
                        </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-call-to-action">
        <div class="container">
            <h3>We’re Here to Help !<a href="#"> Contact us</a></h3>
        </div>
    </div>
</div>
@endsection