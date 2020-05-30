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
        <div class="ps-shop-banner">
            <div class="ps-shop-banner">
                <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    @foreach ($banners as $banner)   
                    <a href="{{ route('front.product') }}"><img src="{{ asset('uploads/banners/productpageBig') }}/{{ $banner->banner_image }}" alt=""></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ps-shop-categories">
            <div class="row align-content-lg-stretch">
                @foreach ($categories as $category)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-block--category-2" data-mh="categories">
                        <div class="ps-block__thumbnail"><img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt=""></div>
                        <div class="ps-block__content">
                            <h4>{{ $category->category_name }}</h4>
                            <ul>
                                @foreach ($category->productFromCategory->take(5) as $product)
                                 <li><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></li>                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
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
                {{-- Best Sale Items --}}
                <div class="ps-block--shop-features">
                    <div class="ps-block__header">
                        <h3>Best Sale Items</h3>
                        <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended1"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended1"><i class="icon-chevron-right"></i></a></div>
                    </div>
                    <div class="ps-block__content">
                        <div class="owl-slider" id="recommended1" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                             @foreach ($bestsellers as $product)
                             <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->get_product_info_via_order_list->product_thumbnail_image }}" alt=""></a>
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('product.details', $product->get_product_info_via_order_list->product_slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $product->get_product_info_via_order_list->id }}"><i class="icon-eye"></i></a></li>
                                        <li><a href="{{ route('add.wish', $product->get_product_info_via_order_list->id) }}" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="
                                        @if($product->get_product_info_via_order_list->shop_id != null)
                                          {{ route('single.store', $product->get_product_info_via_order_list->getshop->shop_name) }}
                                        @else 
                                          {{ url('/') }}
                                        @endif
                                    ">{{ $product->get_product_info_via_order_list->getshop->shop_name ?? 'Ekomalls' }}</a>
                                    <div class="ps-product__content"><a class="ps-product__title"href="{{ route('product.details', $product->get_product_info_via_order_list->product_slug) }}">{{ $product->get_product_info_via_order_list->product_name }}</a>
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
                                        <p class="ps-product__price sale">${{ ($product->get_product_info_via_order_list->discount_price != null)? $product->get_product_info_via_order_list->discount_price : $product->get_product_info_via_order_list->product_price }} 
                                            @if($product->get_product_info_via_order_list->discount_price != null)
                                            <del>${{ $product->get_product_info_via_order_list->product_price }} </del>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product.details', $product->get_product_info_via_order_list->product_slug) }}">{{ $product->get_product_info_via_order_list->product_name }}</a>
                                        <p class="ps-product__price sale">${{ ($product->get_product_info_via_order_list->discount_price != null)? $product->get_product_info_via_order_list->discount_price : $product->get_product_info_via_order_list->product_price }} 
                                            @if($product->get_product_info_via_order_list->discount_price != null)
                                            <del>${{ $product->get_product_info_via_order_list->product_price }} </del>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                        </div>
                    </div>
                </div>
                {{-- Best Sale Items End --}}
                <div class="ps-block--shop-features">
                    <div class="ps-block__header">
                        <h3>Recommended Items</h3>
                        <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended"><i class="icon-chevron-right"></i></a></div>
                    </div>
                    <div class="ps-block__content">
                        <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                            {{-- Recommended Products --}}
                            @forelse ($recommended_products as $recommended)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail"><a href="{{ route('product.details', $recommended->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $recommended->product_thumbnail_image }}" alt=""></a>
                                    <div class="ps-product__badge">-{{ floor(($recommended->product_price - $recommended->discount_price) / ($recommended->product_price) * 100)  }}%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('product.details', $recommended->product_slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview{{ $recommended->id }}"><i class="icon-eye"></i></a></li>
                                        <li><a href="{{ route('add.wish', $recommended->id) }}" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <p class="ps-product__price sale">${{ $recommended->discount_price }} <del>${{ $recommended->product_price }} </del><small>{{ floor(($recommended->product_price - $recommended->discount_price) / ($recommended->product_price) * 100)  }}% off</small></p>
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $recommended->product_slug) }}">{{ $recommended->product_name }}</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                            @if(average_stars($recommended->id) == 1)
                                                <option value="1">1</option>
                                            @elseif(average_stars($recommended->id) == 2)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                            @elseif(average_stars($recommended->id) == 3)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                            @elseif(average_stars($recommended->id) == 4)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                            @elseif(average_stars($recommended->id) == 5)
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            @endif
                                        </select><span>({{ reviewCount($recommended->id) }} review)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty 
                              <p>No discounted product Available at the moment.</p>
                            @endforelse
                            {{-- Recommended Products --}}
                        </div>
                    </div>
                </div>
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong> {{ $total_products }} </strong> Products found</p>
                        {{-- Product Sorting --}}
                      @include('frontend.include.product.sorting')
                        {{-- Product Sorting --}}
                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product pb-0">
                                <div class="row">
                                    @forelse ($all_products as $product)
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
                                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">{{ ($product->getshop) ? $product->getshop->shop_name : 'Ekomalls' }}</a>
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
                                    {{ $all_products->links() }}
                                </ul>
                            </div>
                        </div>
                        <div class="ps-tab" id="tab-2">
                            <div class="ps-shopping-product">
                                @forelse ($all_products as $product)
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
                                    {{ $all_products->links() }}
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
@include('frontend.include.product.modal')
@endsection