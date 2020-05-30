@extends('layouts.frontend')

@section('title')
    Ekomalls | All Stores
@endsection

@section('content')
<div class="ps-page--single ps-page--vendor">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Store List</li>
            </ul>
        </div>
    </div>
    <section class="ps-store-list">
        <div class="container">
            <div class="ps-section__header">
                <h3>Store list</h3>
            </div>
            <div class="ps-section__wrapper">
                <div class="ps-section__right">
                    <section class="ps-store-box">
                        <div class="ps-section__header">
                            <p>Showing 1 -4 of 22 results</p>
                            <select class="ps-select" onchange="window.location.href=this.value">
                                <option value="">Sort By</option>
                                <option value="{{ route('all.storesold') }}">Oldest: Old to New</option>
                                <option value="{{ route('all.stores') }}">Newest: New to Old</option>
                            </select>
                        </div>
                        <div class="ps-section__content">
                            <div class="row">
                                  @forelse($stores as $store)                    
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                    <article class="ps-block--store">
                                        <div class="ps-block__thumbnail bg--cover" data-background="{{ asset('uploads/shops/cover') }}/{{ $store->shop_cover_image }}"></div>
                                        <div class="ps-block__content">
                                            <div class="ps-block__author"><a class="ps-block__user" href="#"><img src="

                                                    @if($store->getowner->provider != null)
                                                        {{ $store->getowner->profile_picture }}
                                                    @else 
                                                        {{ asset('uploads/users/') }}/{{ $store->getowner->profile_picture }}
                                                    @endif
                                                
                                                " alt=""></a><a class="ps-btn" href="{{ route('single.store', $store->shop_name) }}">Visit Store</a></div>
                                            <h4>{{ $store->shop_name }}</h4>
                                            <h6>Total Products: {{ $store->getproduct->count() }}</h6>
                                            <p>With Ekomalls since : {{ $store->created_at->format('d-M-Y') }}</p>
                                            <p>{!! $store->shop_address !!}</p>
                                            <div class="ps-block__inquiry"><a href="{{ route('frontend.contact') }}"><i class="icon-question-circle"></i> inquiry</a></div>
                                        </div>
                                    </article>
                                </div>
                                   @empty   
                                     <h5>No stores available at the moment.Please try again later.</h5>
                                  @endforelse
                            </div>
                            <div class="ps-pagination">
                                <ul class="pagination">
                                   {{ $stores->links() }}
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection