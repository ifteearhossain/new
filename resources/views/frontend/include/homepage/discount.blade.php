<div class="ps-deal-of-day">
    <div class="ps-container">
        <div class="ps-section__header">
            <div class="ps-block--countdown-deal">
                <div class="ps-block__left">
                    <h3>Products on Discount</h3>
                </div>
                <div class="ps-block__right">
                    <figure>
                        <figcaption>End in:</figcaption>
                        <ul class="ps-countdown" data-time="July 21, 2020 15:37:25">
                            <li><span class="days"></span></li>
                            <li><span class="hours"></span></li>
                            <li><span class="minutes"></span></li>
                            <li><span class="seconds"></span></li>
                        </ul>
                    </figure>
                </div>
            </div><a href="{{ route('front.product') }}">View all</a>
        </div>
        <div class="ps-section__content">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                @forelse ($discountProducts as $discounted)
                <div class="ps-product ps-product--inner">
                    <div class="ps-product__thumbnail"><a href="{{ route('product.details', $discounted->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $discounted->product_thumbnail_image }}" alt=""></a>
                        <div class="ps-product__badge">-{{ floor(($discounted->product_price - $discounted->discount_price) / ($discounted->product_price) * 100)  }}%</div>
                        <ul class="ps-product__actions">
                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                            <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $discounted->id }}"><i class="icon-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                        </ul>
                    </div>
                    <div class="ps-product__container">
                        <p class="ps-product__price sale">${{ $discounted->discount_price }} <del>${{ $discounted->product_price }} </del><small>{{ floor(($discounted->product_price - $discounted->discount_price) / ($discounted->product_price) * 100)  }}% off</small></p>
                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $discounted->product_slug) }}">{{ $discounted->product_name }}</a>
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select><span>01</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty 
                  <p>No discounted product Available at the moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="ps-home-ads">
    <div class="ps-container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend_assets/img/collection/home-1/1.jpg') }}" alt=""></a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend_assets/img/collection/home-1/2.jpg') }}" alt=""></a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend_assets/img/collection/home-1/3.jpg') }}" alt=""></a>
            </div>
        </div>
    </div>
</div>

@foreach (productDiscount() as $discounted)
             
        <div class="modal fade" id="product-quickview{{ $discounted->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                    <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                        <div class="ps-product__header">
                            <div class="text-center">
                                <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $discounted->product_thumbnail_image }}" alt="">
                            </div>
                            <div class="ps-product__info">
                                <h1>{{ $discounted->product_name }}</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="#">{{ $discounted->product_brand }}</a></p>
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
                                <h4 class="ps-product__price sale">${{ $discounted->discount_price }} <del>${{ $discounted->product_price }} </del> <small class="ml-5">{{ floor(($discounted->product_price - $discounted->discount_price) / ($discounted->product_price) * 100)  }}% off</small></h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="
                                        
                                        @isset($discounted->getshop->shop_name)
                                                {{ route('single.store', $discounted->getshop->shop_name) }}
                                        @else 
                                                {{ url('/') }}
                                        @endisset
                                        
                                        "><strong> {{ $discounted->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                                     {!! $discounted->product_short_description !!}
                                </div>
                                <div class="ps-product__shopping">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $discounted->id }}" name="product_id">
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