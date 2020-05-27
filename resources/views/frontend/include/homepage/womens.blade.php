<div class="ps-product-list ps-garden-kitchen">
    <div class="ps-container">
        <div class="ps-section__header">
            <h3>Women's Products</h3>
            <ul class="ps-section__links">
                <li><a href="{{ route('category.product', 12) }}">View All</a></li>
            </ul>
        </div>
        <div class="ps-section__content">
            <div class="ps-carousel--responsive owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach ($productsWomens as $womens)
                <div class="ps-product">
                    <div class="ps-product__thumbnail"><a href="{{ route('product.details', $womens->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $womens->product_thumbnail_image }}" alt=""></a>
                        @if($womens->discount_price != null)
                        <div class="ps-product__badge">-{{ floor(($womens->product_price - $womens->discount_price)/($womens->product_price) * 100) }}%</div>
                        @endif
                        <ul class="ps-product__actions">
                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Cart"><i class="icon-bag2"></i></a></li>
                            <li><a data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $womens->id }}"><i class="icon-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                        </ul>
                    </div>
                    <div class="ps-product__container"><a class="ps-product__vendor" href="
                        
                       @isset($womens->getshop->shop_name)
                            {{ route('single.store', $womens->getshop->shop_name) }}
                       @else 
                            {{ url('/') }}
                       @endisset
                        
                        ">
                        @if($womens->shop_id == null)
                            ekomalls
                         @else
                         {{ $womens->getshop->shop_name }}
                        @endif
                    </a>
                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $womens->product_slug) }}">{{ $womens->product_name }}</a>
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select><span>01</span>
                            </div>
                            <p class="ps-product__price sale">${{ ($womens->discount_price != null)? $womens->discount_price : $womens->product_price }} </p>   {{-- <del>$670.00 </del> discount thakle eita use hobe --}}
                        </div>
                        <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $womens->product_slug) }}">{{ $womens->product_name }}</a>
                            <p class="ps-product__price sale">${{ ($womens->discount_price != null) ? $womens->discount_price : $womens->product_price }} </p>
                             
                            @if($womens->discount_price != null)
                            <del>${{ $womens->product_price }} </del>
                            @endif
 
                        </div>
                    </div>
              </div>   
                @endforeach
            </div>
        </div>
    </div>
</div>

@foreach (productWomens() as $womens)
             
<div class="modal fade" id="product-quickview{{ $womens->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
            <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                <div class="ps-product__header">
                    <div class="text-center">
                        <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $womens->product_thumbnail_image }}" alt="">
                    </div>
                    <div class="ps-product__info">
                        <h1>{{ $womens->product_name }}</h1>
                        <div class="ps-product__meta">
                            <p>Brand:<a href="#">{{ $womens->product_brand }}</a></p>
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
                        <h4 class="ps-product__price sale">${{ ($womens->discount_price != null) ? $womens->discount_price : $womens->product_price }} 
                            @if($womens->discount_price != null)
                             <del>${{ $womens->product_price }} </del>
                            @endif
                            @if($womens->discount_price != null)
                            <small class="ml-5">{{ floor(($womens->product_price - $womens->discount_price) / ($womens->product_price) * 100)  }}% off</small>
                            @endif
                        </h4>
                        <div class="ps-product__desc">
                            <p>Sold By:<a href="
                                
                                @isset($womens->getshop->shop_name)
                                        {{ route('single.store', $womens->getshop->shop_name) }}
                                @else 
                                        {{ url('/') }}
                                @endisset
                                
                                "><strong> {{ $womens->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                             {!! $womens->product_short_description !!}
                        </div>
                        <div class="ps-product__shopping">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $womens->id }}" name="product_id">
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