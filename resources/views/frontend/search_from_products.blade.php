@extends('layouts.frontend')

@section('title')
    Ekomalls | All Products
@endsection

@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Products</li>
        </ul>
    </div>
</div>
<div class="ps-page--shop">
    <div class="ps-container">

        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <aside class="widget widget_shop">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="ps-list--categories">
                      @foreach (categories() as $category)
                      <li class="current-menu-item menu-item-has-children"><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                        <ul class="sub-menu">
                         @foreach ($category->getSubCategory as $subCategory)
                         <li class="current-menu-item "><a href="{{ route('sub_category.product', $subCategory->id) }}">{{ $subCategory->sub_category_name }}</a>
                         </li>
                         @endforeach
                          
                        </ul>
                    </li>
                      @endforeach
                    </ul>
                </aside>
                  {{-- Product Search --}}
                    @include('frontend.include.product.product_search')
                {{-- Product Search --}}
            </div>
            <div class="ps-layout__right">

          
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong></strong> Products found</p>
                        <div class="ps-shopping__actions">
                            <div class="ps-shopping__view">
                                <p>View</p>
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                    <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product pb-0">
                                <div class="row">
                                    @forelse ($filtered_products as $product)
                                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                        <div class="ps-product">
                                            <div class="ps-product__thumbnail"><a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt=""></a>
                                                 @if($product->discount_price != null)
                                                 <div class="ps-product__badge">-{{ floor(($product->product_price - $product->discount_price)/($product->product_price) * 100) }}%</div>
                                                 @endif
                                                <ul class="ps-product__actions">
                                                    <li><a href="{{ route('product.details', $product->product_slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $product->id }}"><i class="icon-eye"></i></a></li>
                                                    <li><a href="{{ route('add.wish', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__container"><a class="ps-product__vendor" href="
                                                
                                                @isset($product->getshop->shop_name)
                                                        {{ route('single.store', $product->getshop->shop_name) }}
                                                @else 
                                                        {{ url('/') }}
                                                @endisset                                                
                                                
                                                
                                                ">{{ ($product->getshop) ? $product->getshop->shop_name : 'Ekomalls' }}</a>
                                                <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
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
                                                                <option value="2">5</option>
                                                            @endif
                                                        </select><span>({{ reviewCount($product->id) }} review)</span>
                                                    </div>
                                                    <p class="ps-product__price sale">${{ ($product->discount_price != null)? $product->discount_price : $product->product_price }} 
                                                        @if($product->discount_price != null)
                                                        <del>${{ $product->product_price }} </del>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    <p class="ps-product__price sale">${{ ($product->discount_price != null)? $product->discount_price : $product->product_price }} 
                                                        @if($product->discount_price != null)
                                                        <del>${{ $product->product_price }} </del>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty 
                                    <h5>There is no product match your search criteria. Please try again, Thank you</h5>
                                    @endforelse
                                </div>
                            </div>
                            
                            <div class="ps-pagination" style="padding-top:40px;">
                                <ul class="pagination">
                                    {{-- <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li> --}}
                                    {{ $filtered_products->appends(request()->toArray())->links() }}
                                </ul>
                            </div>
                        </div>
                        <div class="ps-tab" id="tab-2">
                            <div class="ps-shopping-product">
                                @forelse ($filtered_products as $product)
                                <div class="ps-product ps-product--wide">
                                    <div class="ps-product__thumbnail"><a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt=""></a>
                                        @if($product->discount_price != null)
                                         <div class="ps-product__badge">-{{ floor(($product->product_price - $product->discount_price)/($product->product_price) * 100) }}%</div>
                                        @endif
                                    </div>
                                    <div class="ps-product__container">
                                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
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
                                                        <option value="2">5</option>
                                                    @endif
                                                </select><span>({{ reviewCount($product->id) }} review)</span>
                                            </div>
                                            <p class="ps-product__vendor">Sold by:<a href="
                                                
                                                @isset($product->getshop->shop_name)
                                                        {{ route('single.store', $product->getshop->shop_name) }}
                                                @else 
                                                        {{ url('/') }}
                                                @endisset
                                                
                                                
                                                
                                                ">{{ ($product->getshop) ? $product->getshop->shop_name : 'Ekomalls' }}</a></p>
                                            <p>{{ $product->product_short_description }}</p>
                                            <p>{{ $product->product_long_description }}</p>
                                        </div>
                                        <div class="ps-product__shopping">
                                            <p class="ps-product__price sale">${{ ($product->discount_price != null)? $product->discount_price : $product->product_price }} 
                                                @if($product->discount_price != null)
                                                <del>${{ $product->product_price }} </del>
                                                @endif
                                            </p>
                                            
                                            <form action="{{ route('cart.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <button class="ps-btn" type="submit">Add to cart</button>
                                            </form>
                                            <ul class="ps-product__actions">
                                                <li><a href="{{ route('add.wish', $product->id) }}"><i class="icon-heart"></i> Wishlist</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @empty 
                                  <h5>There is no product match your search criteria. Please try again, Thank you</h5>
                                @endforelse 
                            </div>
                            <div class="ps-pagination" style="padding-top:40px;">
                                <ul class="pagination">
                                    {{-- <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li> --}}

                                    {{ $filtered_products->links() }}

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="shop-filter-lastest" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="list-group"><a class="list-group-item list-group-item-action" href="#">Sort by</a><a class="list-group-item list-group-item-action" href="#">Sort by average rating</a><a class="list-group-item list-group-item-action" href="#">Sort by latest</a><a class="list-group-item list-group-item-action" href="#">Sort by price: low to high</a><a class="list-group-item list-group-item-action" href="#">Sort by price: high to low</a><a class="list-group-item list-group-item-action text-center" href="#" data-dismiss="modal"><strong>Close</strong></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@foreach ($filtered_products as $product)
             
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
                                                <option value="2">5</option>
                                            @endif
                                        </select><span>({{ reviewCount($product->id) }} review)</span>
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
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
 @endforeach
@endsection