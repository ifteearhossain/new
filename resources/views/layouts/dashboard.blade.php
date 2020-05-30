
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@ekomalls">
    <meta name="twitter:creator" content="@ekomalls">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ekomalls">
    <meta name="twitter:description" content="Ekomalls - A Multi Vendor Ecommerce Site">
    <meta name="twitter:image" content="https://postimg.cc/CnLS7yWQ">

    <!-- Facebook -->
    <meta property="og:url" content="https://postimg.cc/CnLS7yWQ">
    <meta property="og:title" content="Ekomalls">
    <meta property="og:description" content="Ekomalls is the leading ecommerce online store."">

    <meta property="og:image" content="https://postimg.cc/CnLS7yWQ">
    <meta property="og:image:secure_url" content="https://postimg.cc/CnLS7yWQ">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Ekomalls is the leading ecommerce online store.">
    <meta name="author" content="Ekomalls">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- vendor css -->
    <link rel="icon" sizes="57x57" href="{{ asset('frontend_assets/apple-touch-icon-57x57.png') }}" />
    <link rel="shortcut icon" href="{{ asset('frontend_assets/favicon.ico') }}" />
    <link href="{{ asset('dashboard_assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/all.min.css') }}">
    @yield('css')


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/starlight.css') }}">
    @yield('top_scripts')
  </head>

  <body>
    @yield('inline-css')
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo">
    <a href="{{ route('home') }}">
      <img src="{{ asset('dashboard_assets/img/logo.png') }}" alt="Not found" width="120">
    </a>
    </div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">

        {{-- Master Admin Menu Starts --}}

        @if (Auth::user()->user_role == 0)
          <a href="{{ url('/') }}" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="fas fa-globe tx-22"></i>
              <span class="menu-item-label">Visit Site</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('home') }}" class="sl-menu-link @yield('dashboard-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="#" class="sl-menu-link @yield('sale-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Sale Reports</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('sale.index') }}" class="nav-link">All Sales</a></li>
            <li class="nav-item"><a href="{{ route('sale.cod') }}" class="nav-link">Cash on Delivery</a></li>
            <li class="nav-item"><a href="{{ route('sale.card') }}" class="nav-link">Paid with Card</a></li>
            <li class="nav-item"><a href="{{ route('sale.paypal') }}" class="nav-link">Paid by PayPal</a></li>
            <li class="nav-item"><a href="{{ route('sale.wallet') }}" class="nav-link">Paid by Ekowallet</a></li>
            <li class="nav-item"><a href="{{ route('sale.bank') }}" class="nav-link">Paid by Bank</a></li>
          </ul>
          <a href="#" class="sl-menu-link @yield('banner')">
            <div class="sl-menu-item">
              <i class="far fa-flag tx-24"></i>
              <span class="menu-item-label">All Banners</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('bannerHome.big') }}" class="nav-link">Homepage Big Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerHome.small') }}" class="nav-link">Homepage Small Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerHome.middle') }}" class="nav-link">Homepage Middle Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerFooter.big') }}" class="nav-link">Homepage Footer Big Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerFooter.small') }}" class="nav-link">Homepage Footer Small Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerProduct.big') }}" class="nav-link">Productpage Big Banners</a></li>
          </ul>

          <a href="{{ route('category.index') }}" class="sl-menu-link  @yield('category-active')">
            <div class="sl-menu-item">
              <i class="fa fa-tag tx-24"></i>
              <span class="menu-item-label">Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('sub_category.index') }}" class="sl-menu-link  @yield('sub_category-active')">
            <div class="sl-menu-item">
              <i class="fa fa-tags tx-24"></i>
              <span class="menu-item-label">Sub Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('products.index') }}" class="sl-menu-link  @yield('products-active')">
            <div class="sl-menu-item">
              <i class="fab fa-buffer tx-24"></i>
              <span class="menu-item-label">Products</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('shops.index') }}" class="sl-menu-link  @yield('shops-active')">
            <div class="sl-menu-item">
              <i class="fas fa-store-alt tx-24"></i>
              <span class="menu-item-label">Shops</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('coupon.index') }}" class="sl-menu-link  @yield('coupon')">
            <div class="sl-menu-item">
              <i class="fas fa-user-tag tx-24"></i>
              <span class="menu-item-label">Coupons</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('user.wallet') }}" class="sl-menu-link  @yield('wallet')">
            <div class="sl-menu-item">
              <i class="fas fa-wallet tx-24"></i>
              <span class="menu-item-label">User Wallets</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('contacts.index') }}" class="sl-menu-link  @yield('contact')">
            <div class="sl-menu-item">
              <i class="fas fa-envelope tx-24"></i>
              <span class="menu-item-label">Contact Page queries</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('verification.index') }}" class="sl-menu-link  @yield('verify')">
            <div class="sl-menu-item">
              <i class="fas fa-user-check tx-24"></i>
              <span class="menu-item-label">Pending Verifications</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('about.index') }}" class="sl-menu-link  @yield('about')">
            <div class="sl-menu-item">
              <i class="fas fa-info tx-24"></i>
              <span class="menu-item-label">About Ekomalls</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('faqs.index') }}" class="sl-menu-link  @yield('faqs')">
            <div class="sl-menu-item">
              <i class="fas fa-question tx-22"></i>
              <span class="menu-item-label">Frequently Asked Questions</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('policies.index') }}" class="sl-menu-link  @yield('policy')">
            <div class="sl-menu-item">
              <i class="fas fa-info tx-22"></i>
              <span class="menu-item-label">Policy</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('toc.index') }}" class="sl-menu-link  @yield('toc')">
            <div class="sl-menu-item">
              <i class="fab fa-centos tx-22"></i>
              <span class="menu-item-label">Terms & Conditions</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          {{-- Master Admin menu End --}}


          {{-- Admin Menu Starts --}}

        @elseif (Auth::user()->user_role == 1)
        <a href="{{ url('/') }}" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="fas fa-globe tx-22"></i>
            <span class="menu-item-label">Visit Site</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

          <a href="{{ route('admin.index') }}" class="sl-menu-link @yield('dashboard-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Admin Dashboard</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="#" class="sl-menu-link @yield('sale-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Sale Reports</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('sale.index') }}" class="nav-link">All Sales</a></li>
            <li class="nav-item"><a href="{{ route('sale.cod') }}" class="nav-link">Cash on Delivery</a></li>
            <li class="nav-item"><a href="{{ route('sale.card') }}" class="nav-link">Paid with Card</a></li>
            <li class="nav-item"><a href="{{ route('sale.paypal') }}" class="nav-link">Paid by PayPal</a></li>
            <li class="nav-item"><a href="{{ route('sale.wallet') }}" class="nav-link">Paid by Ekowallet</a></li>
            <li class="nav-item"><a href="{{ route('sale.bank') }}" class="nav-link">Paid by Bank</a></li>
          </ul>
          <a href="#" class="sl-menu-link @yield('banner')">
            <div class="sl-menu-item">
              <i class="far fa-flag tx-24"></i>
              <span class="menu-item-label">All Banners</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('bannerHome.big') }}" class="nav-link">Homepage Big Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerHome.small') }}" class="nav-link">Homepage Small Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerHome.middle') }}" class="nav-link">Homepage Middle Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerFooter.big') }}" class="nav-link">Homepage Footer Big Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerFooter.small') }}" class="nav-link">Homepage Footer Small Banners</a></li>
            <li class="nav-item"><a href="{{ route('bannerProduct.big') }}" class="nav-link">Productpage Big Banners</a></li>
          </ul>
          <a href="{{ route('category.index') }}" class="sl-menu-link @yield('category-active')">
            <div class="sl-menu-item">
                <i class="fa fa-tag tx-24"></i>
              <span class="menu-item-label">Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('sub_category.index') }}" class="sl-menu-link  @yield('sub_category-active')">
            <div class="sl-menu-item">
              <i class="fa fa-tags tx-24"></i>
              <span class="menu-item-label">Sub Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('products.index') }}" class="sl-menu-link  @yield('products-active')">
            <div class="sl-menu-item">
              <i class="fab fa-buffer tx-24"></i>
              <span class="menu-item-label">Products</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('shops.index') }}" class="sl-menu-link  @yield('shops-active')">
            <div class="sl-menu-item">
              <i class="fas fa-store-alt tx-24"></i>
              <span class="menu-item-label">Shops</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('coupon.index') }}" class="sl-menu-link  @yield('coupon')">
            <div class="sl-menu-item">
              <i class="fas fa-user-tag tx-24"></i>
              <span class="menu-item-label">Coupons</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('user.wallet') }}" class="sl-menu-link  @yield('wallet')">
            <div class="sl-menu-item">
              <i class="fas fa-wallet tx-24"></i>
              <span class="menu-item-label">User Wallets</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('contacts.index') }}" class="sl-menu-link  @yield('contact')">
            <div class="sl-menu-item">
              <i class="fas fa-envelope tx-24"></i>
              <span class="menu-item-label">Contact Page queries</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('verification.index') }}" class="sl-menu-link  @yield('verify')">
            <div class="sl-menu-item">
              <i class="fas fa-user-check tx-24"></i>
              <span class="menu-item-label">Pending Verifications</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('about.index') }}" class="sl-menu-link  @yield('about')">
            <div class="sl-menu-item">
              <i class="fas fa-info tx-24"></i>
              <span class="menu-item-label">About Ekomalls</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('faqs.index') }}" class="sl-menu-link  @yield('faqs')">
            <div class="sl-menu-item">
              <i class="fas fa-question tx-22"></i>
              <span class="menu-item-label">Frequently Asked Questions</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('policies.index') }}" class="sl-menu-link  @yield('policy')">
            <div class="sl-menu-item">
              <i class="fas fa-info tx-22"></i>
              <span class="menu-item-label">Policy</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('toc.index') }}" class="sl-menu-link  @yield('toc')">
            <div class="sl-menu-item">
              <i class="fab fa-centos tx-22"></i>
              <span class="menu-item-label">Terms & Conditions</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          {{-- Admin Menu Ends  --}}

          {{-- Seller Menu Starts  --}}

        @elseif (Auth::user()->user_role == 2)
        <a href="{{ url('/') }}" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="fas fa-globe tx-22"></i>
            <span class="menu-item-label">Visit Site</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

          <a href="{{ route('seller.index') }}" class="sl-menu-link @yield('dashboard-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Seller Dashboard</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('products.index') }}" class="sl-menu-link  @yield('products-active')">
            <div class="sl-menu-item">
              <i class="fab fa-buffer tx-24"></i>
              <span class="menu-item-label">Products</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('shops.index') }}" class="sl-menu-link  @yield('shops-active')">
            <div class="sl-menu-item">
              <i class="fas fa-store-alt tx-24"></i>
              <span class="menu-item-label">Shop</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          {{-- Seller Menu Ends  --}}


          {{-- Customer Menu Starts  --}}

        @elseif (Auth::user()->user_role == 3)
        
          <a href="{{ url('/') }}" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="fas fa-globe tx-22"></i>
              <span class="menu-item-label">Visit Site</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('customer.index') }}" class="sl-menu-link @yield('dashboard-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Customer Dashboard</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('shops.index') }}" class="sl-menu-link  @yield('shops-active')">
            <div class="sl-menu-item">
              <i class="fas fa-store-alt tx-24"></i>
              <span class="menu-item-label">Shop</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
        @endif

        {{--  Customer Menu Ends    --}}



      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}</span>
              @if(Auth::user()->access_token != null)
              <img src="{{ Auth::user()->profile_picture }}" alt="" class="wd-32 rounded-circle"><i class="fas fa-caret-down ml-2"></i>
            @else
            <img alt="" src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_picture }}" class="wd-32 rounded-circle"><i class="fas fa-caret-down ml-2"></i>
            @endif
              
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="fas fa-money-bill-alt mr-2"></i>Balance : {{ Auth::user()->balanceFloat }}</a></li>
                <li><a href="{{ route('deposit.ekowallet') }}"><i class="fa fa-credit-card mr-2"></i>Deposit funds</a></li>
                @if(user_role() != 3)
                <li><a href="{{ route('withdraw.ekowallet') }}"><i class="fas fa-dollar-sign mr-3"></i>Withdraw balance</a></li>
                @endif
                <li><a href="{{ route('transaction.ekowallet') }}"><i class="icon ion-clipboard"></i>Transaction history</a></li>
                <li><a href="{{ route('profile.edit') }}"><i class="icon ion-ios-person-outline"></i> Update Profile</a></li>
                <li><a href="{{ route('change.password') }}"><i class="icon ion-ios-person-outline"></i> Change Password</a></li>
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <i class="icon ion-power"></i> Sign Out
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          @if(user_role() == 1 || user_role() == 0)
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            @if(complains()->count() > 0 || withdraws()->count() > 0)
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
            @endif
          </a>
          @endif
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        @if(user_role() == 1 || user_role() == 0)
        <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages ({{ complains()->count() }})</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Withdraw({{ withdraws()->count() }})</a>
        </li>
        @endif
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            @foreach (complains() as $complain)
             @if(user_role() == 1 || user_role() == 0)
            <a href="{{ route('view.complain', $complain->id) }}" class="media-list-link">
              <div class="media">
                <img src="
                  @if(findUser($complain->user_id)->provider)
                    {{ findUser($complain->user_id)->profile_picture }}
                  @else 
                    {{ asset('uploads/users') }}/{{ findUser($complain->user_id)->profile_picture }}
                  @endif
                " class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">{{ findUser($complain->user_id)->name }}</p>
                  <span class="d-block tx-11 tx-gray-500">{{ $complain->created_at->diffForHumans() }}</span>
                  <p class="tx-13 mg-t-10 mg-b-0">{{ $complain->complain }}</p>
                </div>
              </div><!-- media -->
            </a>
              @endif
            @endforeach
            <!-- loop ends here -->
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="{{ url('/home') }}#message" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          <div class="media-list">
          @foreach (withdraws() as $withdraw)
             @if(user_role() == 1 || user_role() == 0)
                <!-- loop starts here -->
            <a href="{{ route('user.wallet') }}" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="
                @if(findUser($withdraw->user_id)->provider)
                {{ findUser($withdraw->user_id)->profile_picture }}
              @else 
                {{ asset('uploads/users') }}/{{ findUser($withdraw->user_id)->profile_picture }}
              @endif
                " class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">{{ findUser($withdraw->user_id)->name }}</strong> requested to withdraw ${{ $withdraw->withdraw_amount }}.</p>
                  <span class="tx-12">{{ $withdraw->created_at->format('d-M-Y') }}</span>
                </div>
              </div><!-- media -->
            </a>
             @endif
          @endforeach
            <!-- loop ends here -->
          </div><!-- media-list -->
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      @yield('breadcrumb')

      <div class="sl-pagebody">
        <div class="sl-page-title">
            @yield('content')
        </div><!-- sl-page-title -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('dashboard_assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <script src="{{ asset('dashboard_assets/js/starlight.js') }}"></script>
    @yield('scripts')

  </body>
</html>
