<div class="ps-product-list ps-clothings">
    <div class="ps-container">
        <div class="ps-section__header">
            <h3>Consumer Electronics</h3>
            <ul class="ps-section__links">
                <li><a href="{{ route('category.product', 3) }}">View All</a></li>
            </ul>
        </div>
        <div class="ps-section__content">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach ($productsElectronics as $electronics)
               
             <div class="ps-product">
                   <div class="ps-product__thumbnail"><a href="{{ route('product.details', $electronics->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $electronics->product_thumbnail_image }}" alt=""></a>
                       @if($electronics->discount_price != null)
                       <div class="ps-product__badge">-{{ floor(($electronics->product_price - $electronics->discount_price)/($electronics->product_price) * 100) }}%</div>
                       @endif
                       <ul class="ps-product__actions">
                           <li><a href="{{ route('product.details', $electronics->product_slug) }}" data-toggle="tooltip" data-placement="top" title="Read more"><i class="icon-bag2"></i></a></li>
                           <li><a data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $electronics->id }}"><i class="icon-eye"></i></a></li>
                           <li><a href="{{ route('add.wish', $electronics->id) }}" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                       </ul>
                   </div>
                   <div class="ps-product__container"><a class="ps-product__vendor" href="
                    
                       @isset($electronics->getshop->shop_name)
                            {{ route('single.store', $electronics->getshop->shop_name) }}
                       @else 
                            {{ url('/') }}
                       @endisset
                        
                    ">
                    @if($electronics->shop_id == null)
                             ekomalls
                    @else
                             {{ $electronics->getshop->shop_name }}
                    @endif
                   </a>
                       <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $electronics->product_slug) }}">{{ $electronics->product_name }}</a>
                           <div class="ps-product__rating">
                               <select class="ps-rating" data-read-only="true">
                                @if(average_stars($electronics->id) == 1)
                                    <option value="1">1</option>
                                @elseif(average_stars($electronics->id) == 2)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                @elseif(average_stars($electronics->id) == 3)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                @elseif(average_stars($electronics->id) == 4)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                @elseif(average_stars($electronics->id) == 5)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                @endif
                            </select><span>({{ reviewCount($electronics->id) }} review)</span>
                           </div>
                           <p class="ps-product__price sale">${{ ($electronics->discount_price != null)? $electronics->discount_price : $electronics->product_price }} </p>   {{-- <del>$670.00 </del> discount thakle eita use hobe --}}
                       </div>
                       <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $electronics->product_slug) }}">{{ $electronics->product_name }}</a>
                           <p class="ps-product__price sale">${{ ($electronics->discount_price != null) ? $electronics->discount_price : $electronics->product_price }} </p>
                            
                           @if($electronics->discount_price != null)
                           <del>${{ $electronics->product_price }} </del>
                           @endif

                       </div>
                   </div>
             </div>                   

               @endforeach
            </div>
        </div>
        </div>
    </div>  
</div>

@foreach (productElectronics() as $electronics)
             
<div class="modal fade" id="product-quickview{{ $electronics->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
            <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                <div class="ps-product__header">
                    <div class="text-center">
                        <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $electronics->product_thumbnail_image }}" alt="">
                    </div>
                    <div class="ps-product__info">
                        <h1>{{ $electronics->product_name }}</h1>
                        <div class="ps-product__meta">
                            <p>Brand:<a href="#">{{ $electronics->product_brand }}</a></p>
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    @if(average_stars($electronics->id) == 1)
                                    <option value="1">1</option>
                                @elseif(average_stars($electronics->id) == 2)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                @elseif(average_stars($electronics->id) == 3)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                @elseif(average_stars($electronics->id) == 4)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                @elseif(average_stars($electronics->id) == 5)
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                @endif
                            </select><span>({{ reviewCount($electronics->id) }} review)</span>
                            </div>
                        </div>
                        <h4 class="ps-product__price sale">${{ ($electronics->discount_price != null) ? $electronics->discount_price : $electronics->product_price }} 
                            @if($electronics->discount_price != null)
                             <del>${{ $electronics->product_price }} </del>
                            @endif
                            @if($electronics->discount_price != null)
                            <small class="ml-5">{{ floor(($electronics->product_price - $electronics->discount_price) / ($electronics->product_price) * 100)  }}% off</small>
                            @endif
                        </h4>
                        <div class="ps-product__desc">
                            <p>Sold By:<a href="
                                
                                @if($electronics->shop_id != null)
                                        {{ route('single.store', $electronics->getshop->shop_name) }}
                                @else 
                                        {{ url('/') }}
                                @endif
                                
                                "><strong> {{ $electronics->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                             {!! $electronics->product_short_description !!}
                        </div>
                        <div class="ps-product__shopping">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $electronics->id }}" name="product_id">
                                <button class="ps-btn ps-btn--black" type="submit">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
 @endforeach
