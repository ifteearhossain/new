@extends('layouts.frontend')

@section('title')
    Ekomalls | {{ $product->product_name }}
@endsection


@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('category.product', $product->getSubCategory->relationBetweenCategory->id) }}">{{ $product->getSubCategory->relationBetweenCategory->category_name }}</a></li>
            <li><a href="{{ route('sub_category.product', $product->getSubCategory->id) }}">{{ $product->getSubCategory->sub_category_name }}</a></li>
            <li>{{ $product->product_name }}</li>
        </ul>
    </div>
</div>
<div class="ps-page--product">
    <div class="ps-container">
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail ps-product--fullwidth">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">
                                        <div class="item text-center"><a href="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}"><img style="margin:0 auto;" src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt=""></a></div>
                                        @foreach ($product->getmultipleimage as $multi_image)
                                        <div class="item text-center"><a href="{{ asset('uploads/products/product_multiple_image') }}/{{ $multi_image->product_multiple_image }}"><img style="margin:0 auto;" src="{{ asset('uploads/products/product_multiple_image') }}/{{ $multi_image->product_multiple_image }}" alt=""></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <div class="item text-center"><a><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt=""></a></div>
                                @foreach ($product->getmultipleimage as $multi_image)
                                <div class="item text-center"><a><img src="{{ asset('uploads/products/product_multiple_image') }}/{{ $multi_image->product_multiple_image }}" alt=""></a></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ps-product__info">
                            @if(session('success'))
                                <div class="alert alert-success">
                                  {{ session('success') }} 
                                </div>
                            @endif
                            @if($errors->all())
                                <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       {{ $error }}
                                   @endforeach
                                </div>
                            @endif
                            <h1>{{ $product->product_name }}</h1>
                            <div class="ps-product__meta">
                                <p>Brand:<a href="#">{{ $product->product_brand }}</a></p>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                              @if(average_stars($product->id) == 1)
                                        <option value="1">1</option>  
                              @elseif(average_stars($product->id) == 2)
                                      <option value="1">1</option>
                                      <option value="1">2</option>
                              @elseif(average_stars($product->id) == 3)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                              @elseif(average_stars($product->id) == 4)
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                              @elseif(average_stars($product->id) == 5)
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="1">5</option>
                              @endif
                                </select><span>({{ reviewCount($product->id) }} review)</span>
                                </div>
                            </div>
                            <h4 class="ps-product__price sale">${{ ($product->discount_price != null)? $product->discount_price : $product->product_price }}
                                @if($product->discount_price  != null)
                                <del> ${{ $product->product_price }}</del><small> (-{{ floor(($product->product_price - $product->discount_price)/($product->product_price)* 100) }}%)</small>                                    
                                @endif
                            </h4>
                            <div class="ps-product__desc pb-5">
                                <p> Sold By:<a class="mr-20" href="
                                @if($product->shop_id != null)
                                     {{ route('single.store', $product->getshop->shop_name) }}
                                @else 
                                        {{ url('/') }}
                                @endif
                                    "><strong>
                                    @if($product->shop_id != null)
                                        {{ $product->getshop->shop_name }}
                                    @else 
                                        Ekomalls
                                    @endif    
                                </strong></a> Status:
                                        @if($product->product_quantity > 0)
                                        <strong class="ps-tag--in-stock">
                                            In-stock ( {{ $product->product_quantity }} pcs. available )
                                        </strong>
                                        @else 
                                        <strong class="ps-tag--out-stock">
                                            Out-of-stock
                                        </strong>
                                        @endif    
                               </p>
                                {!! $product->product_short_description !!}
                            </div>
                            <div class="ps-product__shopping">
                                <figure>
                                    <figcaption>Quantity</figcaption>
                                    <div class="form-group--number">
                                        <button onclick="incrementValue()" class="up"><i class="fa fa-plus"></i></button>
                                        <button onclick="incrementNegativeValue()" class="down"><i class="fa fa-minus"></i></button>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                        <input name="quantity" id="number" class="form-control" type="text" value="1">
                                    </div>
                                </figure>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="ps-btn ps-btn--black" href="#">Add to cart</button>
                         
                            </form>
                                  <div class="ps-product__actions"></div>
                            </div>
                            <div class="ps-product__specification">
                                <p><strong>Item Number:</strong> # {{ $product->id }}</p>
                                <p class="categories"><strong> Categories:</strong><a href="{{ route('category.product', $product->getSubCategory->relationBetweenCategory->id) }}">{{ $product->getSubCategory->relationBetweenCategory->category_name }}</a></p>
                            </div>
                            <div class="ps-product__sharing">
                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.details', $product->product_slug) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="twitter" href="https://twitter.com/intent/tweet?text={{ route('product.details', $product->product_slug) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a class="linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('product.details', $product->product_slug) }}" target="_blank"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="ps-product__content ps-tab-root">
                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">Description</a></li>
                            <li><a href="#tab-3">Vendor</a></li>
                            <li><a href="#tab-4">Reviews ({{ reviewCount($product->id) }})</a></li>
                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-document">
                                   {!! $product->product_long_description !!}
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-3">
                                <h4>
                                    @if($product->shop_id != null)
                                        {{ $product->getshop->shop_name }}
                                    @else 
                                        Ekomalls
                                    @endif
                                </h4>
                                <p>
                                    @if($product->shop_id != null)
                                        {!! $product->getshop->shop_short_description !!}
                                    @else 
                                    Ekomalls is the leading online marketplace in Europe & Africa connecting thousands of sellers with millions of customers all over the world.
                                    @endif    
                                </p>
                                @if($product->shop_id != null)
                                <a href="#">More Products from {{ $product->getshop->shop_name }}</a>
                                @endif
                            </div>
                            <div class="ps-tab" id="tab-4">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                        <div class="ps-block--average-rating">
                                            <div class="ps-block__header">
                                           <h3>{{ average_stars($product->id) }}.00</h3>
                                        <select class="ps-rating" data-read-only="true">
                                          @if(average_stars($product->id) == 1)
                                                    <option value="1">1</option>  
                                          @elseif(average_stars($product->id) == 2)
                                                  <option value="1">1</option>
                                                  <option value="1">2</option>
                                          @elseif(average_stars($product->id) == 3)
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                          @elseif(average_stars($product->id) == 4)
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                          @elseif(average_stars($product->id) == 5)
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="1">5</option>
                                          @endif
                                                </select><span>{{ reviewCount($product->id) }} Review</span>
                                            </div>
                                             <div class="card">
                                                 <div class="card-header">
                                                     All Reviews
                                                 </div>
                                                 <div class="card-body">
                                                    @forelse(App\Order_list::where('product_id', $product->id)->whereNotNull('review')->get() as $review)
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <th>{{ findUser($review->user_id)->name }} said</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $review->review }}</td>
                                                            </tr>
                                                        </table>
                                                    @empty
                                                       No reviews yet
                                                    @endforelse
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                    @auth
                                    @if(\App\Order_list::where('user_id', Auth::id())->where('product_id', $product->id)->whereNull('review')->exists())
                                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                        <form class="ps-form--review" action="{{ route('add.review') }}" method="post">
                                            @csrf
                                            <h4>Submit Your Review</h4>
                                            <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                                            <div class="form-group form-group__rating">
                                                <label>Your rating of this product</label>
                                                <select name="star" class="ps-rating" data-read-only="false">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="review" class="form-control" rows="6" placeholder="Write your review here"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" placeholder="Your Name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input class="form-control" type="email" placeholder="Your Email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group submit">
                                                <button type="submit" class="ps-btn">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                    @else 
                                    <h5>Only Customers who bought the product can review the items. Or you may have already reviewed the item</h5>
                                    @endif
                                    @else 
                                       Please <a href="{{ url('/login') }}">Login</a> to review this product
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-page__right">
                <aside class="widget widget_product widget_features">
                    <p><i class="icon-network"></i> Shipping worldwide</p>
                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                </aside>
                <aside class="widget widget_sell-on-site">
                    <p><i class="icon-store"></i> Sell on Ekomalls?<a href="#"> Register Now !</a></p>
                </aside>
                <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>
                <aside class="widget widget_same-brand">
                    <h3>Same Brand</h3>
                    <div class="widget__content">
                        @foreach ($sameBrand->take(2) as $brand)
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="{{ route('product.details', $brand->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $brand->product_thumbnail_image }}" alt=""></a>
                               @if($brand->discount_price != null)
                               <div class="ps-product__badge">-{{ floor(($brand->product_price - $brand->discount_price)/($brand->product_price) * 100) }}%</div>
                               @endif
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $brand->id }}"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container">
                                @if($brand->shop_id != null)
                                 <a class="ps-product__vendor" href="#">{{ $brand->getshop->shop_name }}</a>
                                @else 
                                 <a class="ps-product__vendor" href="{{ url('/') }}">Ekomalls</a>
                                @endif
                                <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $brand->product_slug) }}">{{ $brand->product_name }}</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                        @if(average_stars($brand->id) == 1)
                                            <option value="1">1</option>
                                        @elseif(average_stars($brand->id) == 2)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                        @elseif(average_stars($brand->id) == 3)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                        @elseif(average_stars($brand->id) == 4)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                        @elseif(average_stars($brand->id) == 5)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        @endif
                                    </select><span>({{ reviewCount($brand->id) }} review)</span>
                                    </div>
                                    <p class="ps-product__price sale">${{ ($brand->discount_price != null) ? $brand->discount_price : $brand->product_price }}
                                    @if($brand->discount_price != null)
                                      <del>${{ $brand->product_price }} </del>
                                    @endif
                                    </p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $brand->product_slug) }}">{{ $brand->product_name }}</a>
                                    <p class="ps-product__price sale">${{ ($brand->discount_price != null) ? $brand->discount_price : $brand->product_price }}
                                    @if($brand->discount_price != null)
                                        <del>${{ $brand->product_price }} </del>
                                    @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
               
                    </div>
                </aside>
            </div>
        </div>
        <div class="ps-section--default">
            <div class="ps-section__header">
                <h3>Related products</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    
                    @foreach ($sameBrand as $brand)
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="{{ route('product.details', $brand->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $brand->product_thumbnail_image }}" alt=""></a>
                           @if($brand->discount_price != null)
                           <div class="ps-product__badge">-{{ floor(($brand->product_price - $brand->discount_price)/($brand->product_price) * 100) }}%</div>
                           @endif
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $brand->id }}"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container">
                            @if($brand->shop_id != null)
                             <a class="ps-product__vendor" href="#">{{ $brand->getshop->shop_name }}</a>
                            @else 
                             <a class="ps-product__vendor" href="{{ url('/') }}">Ekomalls</a>
                            @endif
                            <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $brand->product_slug) }}">{{ $brand->product_name }}</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        @if(average_stars($brand->id) == 1)
                                            <option value="1">1</option>
                                        @elseif(average_stars($brand->id) == 2)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                        @elseif(average_stars($brand->id) == 3)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                        @elseif(average_stars($brand->id) == 4)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                        @elseif(average_stars($brand->id) == 5)
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        @endif
                                    </select><span>({{ reviewCount($brand->id) }} review)</span>
                                </div>
                                <p class="ps-product__price sale">${{ ($brand->discount_price != null) ? $brand->discount_price : $brand->product_price }}
                                @if($brand->discount_price != null)
                                  <del>${{ $brand->product_price }} </del>
                                @endif
                                </p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $brand->product_slug) }}">{{ $brand->product_name }}</a>
                                <p class="ps-product__price sale">${{ ($brand->discount_price != null) ? $brand->discount_price : $brand->product_price }}
                                @if($brand->discount_price != null)
                                    <del>${{ $brand->product_price }} </del>
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($sameBrand as $brand)
             
        <div class="modal fade" id="product-quickview{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                    <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                        <div class="ps-product__header">
                            <div class="text-center">
                                <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $brand->product_thumbnail_image }}" alt="">
                            </div>
                            <div class="ps-product__info">
                                <h1>{{ $brand->product_name }}</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="#">{{ $brand->product_brand }}</a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            @if(average_stars($brand->id) == 1)
                                                <option value="1">1</option>
                                            @elseif(average_stars($brand->id) == 2)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                            @elseif(average_stars($brand->id) == 3)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                            @elseif(average_stars($brand->id) == 4)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                            @elseif(average_stars($brand->id) == 5)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            @endif
                                        </select><span>({{ reviewCount($brand->id) }} review)</span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price sale">${{ ($brand->discount_price != null) ? $brand->discount_price : $brand->product_price }} 
                                    @if($product->discount_price != null)
                                     <del>${{ $brand->product_price }} </del>
                                    @endif
                                    @if($brand->discount_price != null)
                                    <small class="ml-5">{{ floor(($brand->product_price - $brand->discount_price) / ($brand->product_price) * 100)  }}% off</small>
                                    @endif
                                </h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="
                                        
                                        @isset($brand->getshop->shop_name)
                                           {{ route('single.store',$brand->getshop->shop_name) }}
                                        @else 
                                            {{ url('/') }}
                                        @endisset

                                        "><strong> {{ $brand->getshop->shop_name ?? "Ekomalls" }}</strong></a></p>
                                     {!! $brand->product_short_description !!}
                                </div>
                                <div class="ps-product__shopping">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $brand->id }}" name="product_id">
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
@endsection

@section('footer_script')
    <script>
        function incrementValue()
        {
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number').value = value;
        }
        function incrementNegativeValue()
        {
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value--;
            document.getElementById('number').value = value;
        }
    </script>
@endsection