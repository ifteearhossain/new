@extends('layouts.frontend')

@section('title')
 Ekomalls | {{ $store->shop_name }}   
@endsection

@section('content')
<div class="ps-page--single ps-page--vendor">
    <section class="ps-store-list">
        <div class="container">
            <aside class="ps-block--store-banner">
                <div class="ps-block__content bg--cover" data-background="{{ asset('uploads/shops/cover') }}/{{ $store->shop_cover_image }}">
                    <h3>{{ $store->shop_name }}</h3><a class="ps-block__inquiry" href="#"><i class="fa fa-question"></i> Inquiry</a>
                </div>
                <div class="ps-block__user">
                    <div class="ps-block__user-avatar"><img src="
                            @if($store->getowner->provider != null)
                               {{ $store->getowner->profile_picture }}
                            @else 
                               {{ asset('uploads/users') }}/{{ $store->getowner->profile_picture }}
                            @endif
                        " alt="">
                        {{-- <select class="ps-rating" data-read-only="true">
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                            <option value="2">5</option>
                        </select> --}}
                    </div>
                    <div class="ps-block__user-content">
                        <p style="text-white"><i class="icon-map-marker"></i>{{ strip_tags($store->shop_address) }}</p>
                        <p><i class="fa fa-home"></i>Total Products : {{ $store->getproduct->count() }}</p>
                    </div>
                </div>
            </aside>
            <div class="ps-section__wrapper">
                <div class="ps-section__left">
                    <aside class="widget widget--vendor">
                        <h3 class="widget-title">Product Search</h3>
                        <div class="form-group--icon">
                            <form action="{{ route('store.search', $store->shop_name) }}" method="GET">
                                <input name="product_name" class="form-control" type="text" placeholder="Search..."><i class="icon-magnifier"></i>
                            </form>
                        </div>
                    </aside>
                    <aside class="widget widget--vendor">
                        <h3 class="widget-title">Store Categories</h3>
                        <ul class="ps-list--arrow">
                            @foreach ($store->getproduct as $product)
                            <li class="menu-item-has-children"><a href="{{ route('sub_category.product', $product->getsubcategory->id) }}">{{ $product->getsubcategory->sub_category_name }}</a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </aside>
  
                        {{-- Store hours (not available at the moment) --}}

                    {{-- <aside class="widget widget--vendor widget--open-time">
                        <h3 class="widget-title"><i class="icon-clock3"></i> Store Hours</h3>
                        <ul>
                            <li><strong>Friday:</strong><span>8:00 am - 6:00 pm</span></li>
                            <li><strong>Monday:</strong><span>8:00 am - 6:00 pm</span></li>
                            <li><strong>Tuesday:</strong><span>8:00 am - 6:00 pm</span></li>
                            <li><strong>Wednesday:</strong><span>8:00 am - 6:00 pm</span></li>
                            <li><strong>Thursday:</strong><span>8:00 am - 6:00 pm</span></li>
                        </ul>
                    </aside> --}}
                </div>
                <div class="ps-section__right">
                    <nav class="ps-store-link">
                        <ul>
                            <li class="active"><a href="store-detail.html">Products</a></li>
                            <li><a href="store-detail-info.html">About</a></li>
                            {{-- <li><a href="store-detail.html">Reviews(0)</a></li> --}}
                        </ul>
                    </nav>
                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
                            <p><strong>{{ $store->getproduct->count() }}</strong> Products found</p>
                            <div class="ps-shopping__actions">
                                <div class="ps-shopping__view">
                                    <ul class="ps-tab-list">
                                        <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                        <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="row">
                                        @forelse ($store->getproduct as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="" /></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $product->id }}"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#"></a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>02</span>
                                                        </div>
                                                        <p class="ps-product__price sale">${{ ($product->discount_price != null) ? $product->discount_price : $product->product_price }}
                                                            @if($product->discount_price != null)
                                                            <del>${{ $product->product_price }}</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title"href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                                        <p class="ps-product__price sale">${{ ($product->discount_price != null) ? $product->discount_price : $product->product_price }}
                                                            @if($product->discount_price != null)
                                                            <del>${{ $product->product_price }}</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                          <h6>No Products found</h6>  
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-2">
                                <div class="ps-shopping-product">
                                    @forelse ($store->getproduct as $product)
                                        
                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="" /></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span></span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="{{ route('single.store', $store->shop_name) }}">{{ $store->shop_name }}</a></p>
                                                  
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price sale">${{ ($product->discount_price != null) ? $product->discount_price : $product->product_price }} 
                                               
                                                    @if($product->discount_price != null)
                                                    <del>${{ $product->product_price }}</del>
                                                    @endif
                                                
                                               </p>
                                            <form action="{{ route('cart.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <button class="ps-btn" type="submit">Add to cart</button>
                                            </form>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
                                                    <li><a href="#"><i class="icon-chart-bars"></i> Compare</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <h5>No products found</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@foreach ($store->getproduct as $product)
             
        <div class="modal fade" id="product-quickview{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                    <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                        <div class="ps-product__header">
                            <div class="text-center">
                                <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="">
                            </div>
                            <div class="ps-product__info">
                                <h1>{{ $product->product_name }}</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="shop-default.html">{{ $product->product_brand }}</a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>(1 review)</span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price sale">${{ ($product->discount_price != null) ? $product->discount_price : $product->product_price }} 
                                    @if($product->discount_price != null)
                                     <del>${{ $product->product_price }} </del>
                                    @endif
                                    @if($product->discount_price != null)
                                    <small class="ml-5">{{ floor(($product->product_price - $product->discount_price) / ($product->product_price) * 100)  }}% off</small>
                                    @endif
                                </h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="shop-default.html"><strong> {{ $product->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                                     {!! $product->product_short_description !!}
                                </div>
                                <div class="ps-product__shopping">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <button class="ps-btn ps-btn--black" type="submit">Add to cart</button>
                                    </form>
                                    <a class="ps-btn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
 @endforeach
@endsection