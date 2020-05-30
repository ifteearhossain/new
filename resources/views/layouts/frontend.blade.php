<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- Meta -->
    <meta property="og:title" content="Ekomalls" />
    <meta property="og:image" content="https://ekomalls.com/public/frontend_assets/ekomalls.jpg" />
    <meta property="og:url" content="https://ekomalls.com" /> 
    <meta property="og:type" content="Ekomalls is the leading ecommerce online store."/>
    <meta property="og:description" content="Ekomalls is the leading ecommerce online store." /> 
    <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Twitter -->
        <meta name="twitter:site" content="@ekomalls">
        <meta name="twitter:creator" content="@ekomalls">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Ekomalls">
        <meta name="twitter:description" content="Ekomalls - A Multi Vendor Ecommerce Site">
        <meta name="twitter:image" content="https://ekomalls.com/public/frontend_assets/ekomalls.jpg">
    
        <!-- Facebook -->
        <meta property="og:url" content="https://ekomalls.com/public/frontend_assets/ekomalls.jpg">
        <meta property="og:title" content="Ekomalls">
        <meta property="og:description" content="Ekomalls is the leading ecommerce online store.">
    
        <meta property="og:image" content="https://ekomalls.com/public/frontend_assets/ekomalls.jpg">
        <meta property="og:image:secure_url" content="https://ekomalls.com">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">
    




    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" sizes="57x57" href="{{ asset('frontend_assets/apple-touch-icon-57x57.png') }}" />
    <link rel="shortcut icon" href="{{ asset('frontend_assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/fonts/Linearicons/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/lightGallery-master/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5ece59f3c75cbf1769efdf73/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <script src="https://sleeknotestaticcontent.sleeknote.com/covid.js#headline=COVID-19%20informations&text=Due%20to%20COVID-19%20situation%20worldwide.%20Deliveries%20might%20delay%20due%20to%20lockdowns.But%20we%20are%20still%20on%20operations%20and%20working%20hard%20day%20and%20night%20so%20that%20our%20customers%20do%20not%20face%20the%20delays%20in%20deliveries.%20Stay%20home%20&%20Stay%20safe.%20We%20are%20here%20to%20fullfill%20your%20needs.&button=Read%20more&url=https://ekomalls.com/corona-update" async></script>
</head>

<body>
    <header class="header header--1" data-sticky="true">
        <div class="header__top">
            <div class="ps-container">

                {{-- Sticky Categories  Starts --}}

                <div class="header__left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span>Shop by Department</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">

                            @forelse (categories() as $category)

                                <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a><span class="sub-toggle"></span>
                                    <div class="mega-menu">
                                        @foreach ($category->getSubCategory as $subCategory)
                                          <div class="mega-menu__column">
                                               <h4>{{ $subCategory->sub_category_name }}<span class="sub-toggle"></span></h4>
                                                <ul class="mega-menu__list">
                                               @foreach ($subCategory->getproduct->take(4) as $product)
                                                <li class="current-menu-item "><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></li>                                                   
                                               @endforeach     
                                                </ul>
                                            </div>
                                        @endforeach
                                    
                                    </div>
                                </li>
                            @empty
                               <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">No Categories Available</a><span class="sub-toggle"></li>
                            @endforelse
                              
                            </ul>
                        </div>
                    </div>
                      <a class="ps-logo" href="{{ route('frontend.index') }}">
                        <img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Not Found" style="width:150px;">
                    </a>
                </div>
                 
                {{-- Sticky Categories Ends --}}

                {{-- Sticky Search Starts --}}

                <div class="header__center">
                    <form class="ps-form--quick-search" action="{{ route('homePage.search') }}" method="get">
                        <div class="form-group--icon"><i class="icon-chevron-down"></i>
                            <select class="form-control" name="filter[category_id]">
                                <option value="" selected="selected">All</option>
                                @foreach (categories() as $category)
                                   <option value="{{ $category->id }}">{{ $category->category_name }}</option> 
                                @endforeach
                            </select>
                        </div>
                            <input name="filter[product_name]" class="form-control" type="text" placeholder="I'm shopping for...">
                            <button type="submit">Search</button>
                        </form>
                </div>

                {{-- Sticky Search Ends --}}

                {{-- Sticky Cart and Login Starts --}}

                <div class="header__right">
                    <div class="header__actions"><a class="header__extra" href="{{ route('wishlist.index') }}"><i class="icon-heart"></i><span><i>{{ wishlistTotal() }}</i></span></a>
                        <div class="ps-cart--mini"><a class="header__extra" href="{{ route('cart.index') }}"><i class="icon-bag2"></i><span><i>{{ cartTotal() }}</i></span></a>
                            <div class="ps-cart__content">
                                <div class="ps-cart__items">
                                    @forelse (cartItems() as $item)
                                    <div class="ps-product--cart-mobile">
                                     <div class="ps-product__thumbnail"><a href="#"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $item->cartProduct->product_thumbnail_image }}" alt=""></a></div>
                                     <div class="ps-product__content"><a class="ps-product__remove" href="{{ route('cart.remove', $item->id ) }}"><i class="icon-cross"></i></a>
                                        <a href="{{ route('product.details', $item->cartProduct->product_slug) }}">{{ $item->cartProduct->product_name }}</a>
                                         <p><strong>Sold by:</strong>
                                            @if($item->cartProduct->shop_id != null)
                                                {{ $item->cartProduct->getshop->shop_name }}
                                            @else 
                                                Ekomalls
                                            @endif
                                         </p><small>{{ $item->quantity }} x ${{ ($item->cartProduct->discount_price != null) ? $item->cartProduct->discount_price : $item->cartProduct->product_price }} </small>
                                     </div>
                                 </div>                      
                                     @empty 
                                      Your Cart is empty.
                                    @endforelse
                                </div>
                                <div class="ps-cart__footer">
                                   <h3>Sub Total:<strong>${{ subTotal() }}</strong></h3>
                                    <figure>
                                        <a class="ps-btn" href="{{ route('cart.index') }}">View Cart</a>
                                        <a class="ps-btn" href="{{ route('checkout.index') }}">Checkout</a>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="ps-block--user-header">
                            @guest
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                           <div class="ps-block__right"><a href="{{ url('/login') }}">Login</a><a href="{{ url('/register') }}">Register</a></div>   
                           @endguest
                           @auth
                           <div class="ps-block__left">
                               @if (Auth::user()->access_token != null)
                                  <img src="{{ Auth::user()->profile_picture }}" alt="Not found" style="width:40px; height:40px; border-radius:50%;">  
                                @else
                                <img src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_picture }}" alt="" style="width:40px; height:40px; border-radius:50%;">
                               @endif
                           </div>
                           <div class="ps-block__right" style="font-weight: bold;">{{ Auth::user()->name }}  ${{ Auth::user()->balanceFloat }}
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                               Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                           </div>
                           @endauth
                        </div>
                    </div>
                </div>

                {{-- Sticky Cart and Login/ Register ends --}}

            </div>
        </div>
        <nav class="navigation">
            <div class="ps-container">
                <div class="navigation__left">
                    {{-- Menu Category Starts --}}

                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Department</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">

                                @forelse (categories() as $category)

                                <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a><span class="sub-toggle"></span>
                                    <div class="mega-menu">
                                        @foreach ($category->getSubCategory as $subCategory)
                                          <div class="mega-menu__column">
                                               <h4>{{ $subCategory->sub_category_name }}<span class="sub-toggle"></span></h4>
                                                <ul class="mega-menu__list">
                                               @foreach ($subCategory->getproduct->take(4) as $product)
                                                <li class="current-menu-item "><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></li>                                                   
                                               @endforeach     
                                                </ul>
                                            </div>
                                        @endforeach
                                    
                                    </div>
                                </li>
                            @empty
                               <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">No Categories Available</a><span class="sub-toggle"></li>
                            @endforelse
                               
                            </ul>
                        </div>
                    </div>

                    {{-- Menu Category Ends --}}
                </div>
                <div class="navigation__right">
                    {{-- Menu Starts --}}

                    <ul class="menu">
                        <li class="menu-item-has-children"><a href="{{ route('frontend.index') }}">Home </a><span class="sub-toggle"></span>

                        </li>
                        <li class="menu-item-has-children"><a href="{{ route('front.product') }}">Products</a><span class="sub-toggle"></span>
                        </li>
                        <li class="menu-item-has-children has-mega-menu"><a href="#">About Ekomalls <i class="fa fa-sort-down"></i> </a><span class="sub-toggle"></span>
                            <div class="mega-menu">
                                <div class="mega-menu__column">
                                    <h4>About Ekomalls<span class="sub-toggle"></span></h4>
                                    <ul class="mega-menu__list">
                                        <li class="current-menu-item "><a href="{{ route('frontend.about') }}">About Us</a>
                                        </li>
                                        <li class="current-menu-item "><a href="{{ route('frontend.contact') }}">Contact</a>
                                        </li>
                                        <li class="current-menu-item "><a href="{{ route('frontend.faq') }}">Faqs</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="menu-item-has-children has-mega-menu"><a href="{{ route('vendor.index') }}">Become a Vendor</a><span class="sub-toggle"></span>
                        </li>
                        <li class="menu-item-has-children has-mega-menu"><a href="{{ route('all.stores') }}">All Stores</a><span class="sub-toggle"></span>
                        </li>
                        @auth
                        <li class="menu-item-has-children"><a href="{{ route('home') }}"> My Account </a><span class="sub-toggle"></span>
                        @endauth

                    </ul>
                    
                    <ul class="navigation__extra">
                        <li><a href="{{ route('vendor.index') }}">Sell on Ekomalls</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact support for full details</a></li>
                    </ul>
                    
                    {{-- Menu Ends --}}
                    
                </div>
            </div>
        </nav>
    </header>
    
    {{-- Mobile Menu Starts --}}

    <header class="header header--mobile" data-sticky="true">
        <div class="header__top">
            <div class="header__left">
                <p>Welcome to Ekomalls Online Shopping Store !</p>
            </div>
            <div class="header__right">
                <ul class="navigation__extra">
                    <li><a href="#">Sell on Ekomalls</a></li>
                    <li><a href="{{ route('frontend.contact') }}">Contact support for full details</a></li>

                </ul>
            </div>
        </div>
        <div class="navigation--mobile">
            <div class="navigation__left">
                  <a class="ps-logo" href="{{ url('/') }}">
                        <img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Not Found" style="width:150px;">
                    </a>
            </div>
            <div class="navigation__right">
                <div class="header__actions">
                    <div class="ps-cart--mini"><a class="header__extra" href="{{ route('cart.index') }}"><i class="icon-bag2"></i><span><i>{{ cartTotal() }}</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">
                           @foreach (cartItems() as $item)
                           <div class="ps-product--cart-mobile">
                            <div class="ps-product__thumbnail"><a href="{{ route('product.details', $item->cartProduct->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $item->cartProduct->product_thumbnail_image }}" alt=""></a></div>
                            <div class="ps-product__content"><a class="ps-product__remove" href="{{ route('cart.remove', $item->id) }}"><i class="icon-cross"></i></a><a href="{{ route('product.details', $item->cartProduct->product_slug) }}">{{ $item->cartProduct->product_name }}</a>
                                <p><strong>Sold by:</strong>
                                    @if($item->cartProduct->shop_id != null)
                                        {{ $item->cartProduct->getshop->shop_name }}
                                    @else 
                                        Ekomalls
                                    @endif
                                </p><small>{{ $item->quantity }} x ${{ ($item->cartProduct->discount_price != null) ? $item->cartProduct->discount_price : $item->cartProduct->product_price }}</small>
                            </div>
                        </div>
                           @endforeach
                            </div>
                            <div class="ps-cart__footer">
                                <h3>Sub Total:<strong>${{ subTotal() }}</strong></h3>
                                <figure><a class="ps-btn" href="{{ route('cart.index') }}">View Cart</a>
                                        <a class="ps-btn" href="{{ route('checkout.index') }}">Checkout</a></figure>
                            </div>
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        @guest   
                        <div class="ps-block__right"><a href="{{ url('/login') }}">Login</a><a href="{{ url('/register') }}">Register</a></div>
                        @endguest
                        @auth
                           <div class="ps-block__right" style="font-weight: bold;">{{ Auth::user()->name }} ${{ Auth::user()->balanceFloat }}
                               <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                               Sign Out
                               </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                           </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-search--mobile">
            <form class="ps-form--search-mobile" action="{{ route('homePage.search') }}" method="get">
                <div class="form-group--nest">
                    <input name="filter[product_name]" class="form-control" type="text" placeholder="Search something...">
                    <button><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
    </header>
    <div class="ps-panel--sidebar" id="cart-mobile">
        <div class="ps-panel__header">
            <h3>Shopping Cart</h3>
        </div>
        <div class="navigation__content">
            <div class="ps-cart--mobile">
                <div class="ps-cart__content">
                  @foreach (cartItems() as $item)
                  <div class="ps-product--cart-mobile">
                    <div class="ps-product__thumbnail"><a href="{{ route('product.details', $item->cartProduct->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $item->cartProduct->product_thumbnail_image }}" alt=""></a></div>
                    <div class="ps-product__content"><a class="ps-product__remove" href="{{ route('cart.remove', $item->id) }}"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                    <p><strong>Sold by:</strong>
                        @if($item->cartProduct->shop_id != null)
                            {{ $item->cartProduct->getshop->shop_name }}
                        @else 
                            Ekomalls
                        @endif
                    </p>
                    <small>{{ $item->quantity }} x ${{ ($item->cartProduct->discount_price != null) ? $item->cartProduct->discount_price : $item->cartProduct->product_price }}</small>
                    </div>
                </div>
                  @endforeach
                </div>
                <div class="ps-cart__footer">
                    <h3>Sub Total:<strong>${{ subTotal() }}</strong></h3>
                    <figure>
                        <a class="ps-btn" href="{{ route('cart.index') }}">View Cart</a>
                        <a class="ps-btn" href="{{ route('checkout.index') }}">Checkout</a></figure>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="navigation-mobile">
        <div class="ps-panel__header">
            <h3>Categories</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">

                @forelse (categories() as $category)

                <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a><span class="sub-toggle"></span>
                    <div class="mega-menu">
                        @foreach ($category->getSubCategory as $subCategory)
                          <div class="mega-menu__column">
                               <h4>{{ $subCategory->sub_category_name }}<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                               @foreach ($subCategory->getproduct->take(4) as $product)
                                <li class="current-menu-item "><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></li>                                                   
                               @endforeach     
                                </ul>
                            </div>
                        @endforeach
                    
                    </div>
                </li>
            @empty
               <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">No Categories Available</a><span class="sub-toggle"></li>
            @endforelse
            </ul>
        </div>
    </div>
    <div class="navigation--list">
        <div class="navigation__content"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a><a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a><a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a><a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a></div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
        <div class="ps-panel__header">
            <form class="ps-form--search-mobile" action="{{ route('homePage.search') }}" method="get">
                <div class="form-group--nest">
                    <input name="filter[product_name]" class="form-control" type="text" placeholder="Search something...">
                    <button><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
        <div class="navigation__content"></div>
    </div>
    <div class="ps-panel--sidebar" id="menu-mobile">
        <div class="ps-panel__header">
            <h3>Menu</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                <li class="menu-item-has-children"><a href="index.html">Home</a><span class="sub-toggle"></span>

                </li>
                <li class="menu-item-has-children"><a href="{{ route('front.product') }}">Products</a><span class="sub-toggle"></span>
                </li>
                <li class="menu-item-has-children has-mega-menu"><a href="#">About Ekomalls <i class="fa fa-sort-down"></i> </a><span class="sub-toggle"></span>
                    <div class="mega-menu">
                        <div class="mega-menu__column">
                            <h4>About Ekomalls<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li class="current-menu-item "><a href="{{ route('frontend.about') }}">About Us</a>
                                </li>
                                <li class="current-menu-item "><a href="{{ route('frontend.contact') }}">Contact</a>
                                </li>
                                <li class="current-menu-item "><a href="{{ route('frontend.faq') }}">Faqs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item-has-children has-mega-menu"><a href="{{ route('vendor.index') }}">Become a Vendor</a><span class="sub-toggle"></span>
                </li>
                <li class="menu-item-has-children has-mega-menu"><a href="{{ route('all.stores') }}">All Stores</a><span class="sub-toggle"></span>
                </li>
                @auth
                <li class="menu-item-has-children"><a href="{{ route('home') }}"> My Account </a><span class="sub-toggle"></span>
                @endauth
            </ul>
        </div>
    </div>

    {{-- Mobile Menu Ends --}}


    {{-- Content Starts --}}    
      


      
      @yield('content')
      
      
      {{-- Content Ends --}}
      
      {{-- NewsLetter & Footer Starts --}}



        <div class="ps-newsletter">
            <div class="ps-container">
                <form class="ps-form--newsletter" action="{{ route('subscribe') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-form__left">
                                <h3>Newsletter</h3>
                                <p>Subscribe to get information about products and coupons</p>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-form__right">
                                <div class="form-group--nest">
                                    <input name="email" class="form-control" type="email" placeholder="Email address">
                                    <button type="submit" class="ps-btn">Subscribe</button>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="ps-footer">
        <div class="ps-container">
            <div class="ps-footer__widgets">
                <aside class="widget widget_footer widget_contact-us">
                    <h4 class="widget-title">Contact us</h4>
                    <div class="widget_content">
                        <p>Call us 24/7</p>
                        <h3>00 47 92117 840</h3>
                        <p>Krutthuset 8, 3030, Drammen  Norway <br><a href="mailto::info@ekomalls.com">info@ekomalls.com</span></a></p>
                        <ul class="ps-list--social">
                            <li><a class="facebook" href="https://www.facebook.com/eko.malls.3" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Quick links</h4>
                    <ul class="ps-list--link">
                        <li><a href="{{ route('frontend.policy') }}">Policy</a></li>
                        <li><a href="{{ route('frontend.term') }}">Term & Condition</a></li>
                        <li><a href="{{ route('frontend.faq') }}">FAQs</a></li>
                    </ul>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Company</h4>
                    <ul class="ps-list--link">
                        <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                    </ul>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Business</h4>
                    <ul class="ps-list--link">
                        <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
                        <li><a href="{{ url('/home') }}">My account</a></li>
                        <li><a href="{{ route('all.stores') }}">Shop</a></li>
                    </ul>
                </aside>
            </div>
            <div class="ps-footer__links">
                @foreach (categories()->take(5) as $category)

                <p><strong>{{ $category->category_name }}:</strong>

                 @foreach ($category->getSubCategory->take(5) as $sub_category)          
                        <a href="#">{{ $sub_category->sub_category_name }}</a>
                 @endforeach

                </p>

                @endforeach
            </div>
            <div class="ps-footer__copyright">
                <p>© 2020 Ekomalls. All Rights Reserved | Developed by Farahnaz Ahmed</p>
                <p><span>We Using Safe Payment For:</span><a href="#">
                    
                    <img src="{{ asset('frontend_assets/img/payment-method/1.jpg') }}" alt="" width="60"></a><a href="#">
                    <img src="{{ asset('frontend_assets/img/payment-method/3.jpg') }}" alt=""></a><a href="#">
                    <img src="{{ asset('frontend_assets/img/payment-method/4.jpg') }}" alt="" width="60"></a><a href="#">
                    <img src="{{ asset('frontend_assets/img/payment-method/5.jpg') }}" alt=""></a></p>
        </div>
        </div>
    </footer>
    
      {{-- PopUp Email Subscription Starts --}}
     
    @if(!checkSubscriber())
    <div class="ps-popup" id="subscribe" data-time="500">
        <div class="ps-popup__content bg--cover" data-background="{{ asset('frontend_assets/img/bg/subscribe.jpg') }}"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
            <form class="ps-form--subscribe-popup" action="{{ route('subscribe') }}" method="post">
                @csrf
                <div class="ps-form__content">
                    <h4>Get <strong>25%</strong> Discount</h4>
                    <p>Subscribe to the Ekomalls mailing list <br /> to receive updates on new arrivals, special offers <br /> and our promotions.</p>
                    <div class="form-group">
                        <input name="email" class="form-control" type="text" placeholder="Email Address" required>
                        <button type="submit" class="ps-btn">Subscribe</button>
                    </div>
                    <div class="ps-checkbox">
                        <input class="form-control" type="checkbox" id="not-show" name="not-show" value="1">
                        <label for="not-show">Don't show this popup again</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

      {{-- PopUp Email Subscription Ends --}}

    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>

    <div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="#" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
     
      {{-- Modal --}}
{{-- 
    <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="false">
                            <div class="ps-product__images" data-arrow="true">
                                <div class="item"><img src="img/products/detail/fullwidth/1.jpg" alt=""></div>
                                <div class="item"><img src="img/products/detail/fullwidth/2.jpg" alt=""></div>
                                <div class="item"><img src="img/products/detail/fullwidth/3.jpg" alt=""></div>
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1>Marshall Kilburn Portable Wireless Speaker</h1>
                            <div class="ps-product__meta">
                                <p>Brand:<a href="shop-default.html">Sony</a></p>
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
                            <h4 class="ps-product__price">$36.78 – $56.99</h4>
                            <div class="ps-product__desc">
                                <p>Sold By:<a href="shop-default.html"><strong> Go Pro</strong></a></p>
                                <ul class="ps-list--dot">
                                    <li> Unrestrained and portable active stereo speaker</li>
                                    <li> Free from the confines of wires and chords</li>
                                    <li> 20 hours of portable capabilities</li>
                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                </ul>
                            </div>
                            <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                                <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div> --}}

    @yield('modal')


    
    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')"></script> --}}
    <script src="{{ asset('frontend_assets/plugins/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/slick-animation.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/plugins/gmap3.min.js') }}"></script>
    <!-- custom scripts-->
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
    @yield('footer_script')
</body>


</html>

{{-- NewsLetter & Footer Ends --}}
