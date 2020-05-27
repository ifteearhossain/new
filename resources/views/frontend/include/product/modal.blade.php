@foreach ($recommended_products as $recommended)
             
        <div class="modal fade" id="product-quickview{{ $recommended->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                    <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                        <div class="ps-product__header">
                            <div class="text-center">
                                <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $recommended->product_thumbnail_image }}" alt="">
                            </div>
                            <div class="ps-product__info">
                                <h1>{{ $recommended->product_name }}</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="#">{{ $recommended->product_brand }}</a></p>
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
                                <h4 class="ps-product__price sale">${{ $recommended->discount_price }} <del>${{ $recommended->product_price }} </del> <small class="ml-5">{{ floor(($recommended->product_price - $recommended->discount_price) / ($recommended->product_price) * 100)  }}% off</small></h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="
                                        
                                        @isset($recommended->getshop->shop_name)
                                                {{ route('single.store', $recommended->getshop->shop_name) }}
                                        @else 
                                                {{ url('/') }}
                                        @endisset
                                        
                                        "><strong> {{ $recommended->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                                     {!! $recommended->product_short_description !!}
                                </div>
                                <div class="ps-product__shopping">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $recommended->id }}" name="product_id">
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
@foreach ($all_products as $product)
             
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
                                    <p>Brand:<a href="#">{{ $product->product_brand }}</a></p>
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
                                    <p>Sold By:<a href="
                                        
                                        @isset($product->getshop->shop_name)
                                                {{ route('single.store', $product->getshop->shop_name) }}
                                        @else 
                                                {{ url('/') }}
                                        @endisset
                                        
                                        "><strong> {{ $product->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
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