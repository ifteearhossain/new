@extends('layouts.dashboard')

@section('title')
   Admin Dashboard
@endsection

@section('dashboard-active')
  active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.index') }}">Admin Dashboard</a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a>
    <span class="breadcrumb-item active">Blank Page</span> --}}
  </nav>

@endsection
@section('inline-css')
    
    <style>
      .card {
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
}

.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 14px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {
    background-size: cover;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 14px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}


    </style>

@endsection

@section('content')


<div class="row row-sm">
    <div class="col-sm-6 col-xl-3">
      <div class="card pd-20 bg-primary">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ todaysSales() }}</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Total Sales</span>
            <h6 class="tx-white mg-b-0">${{ totalSales() }}</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Today's Ekomalls fees</span>
            <h6 class="tx-white mg-b-0">${{ todaysFees() }}</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
      <div class="card pd-20 bg-info">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total payment received</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ totalReceived() }}</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Total Sales</span>
            <h6 class="tx-white mg-b-0">${{ totalSales() }}</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Total Ekomalls fees</span>
            <h6 class="tx-white mg-b-0">${{ totalFees() }}</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card pd-20 bg-warning">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total due from customers</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ totalDue() }}</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
                <span class="tx-11 tx-white-6">Total Sales</span>
                <h6 class="tx-white mg-b-0">${{ totalSales() }}</h6>
              </div>
              <div>
                <span class="tx-11 tx-white-6">Total Ekomalls fees</span>
                <h6 class="tx-white mg-b-0">${{ totalFees() }}</h6>
              </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card pd-20 bg-secondary">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This month's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ monthsSales() }}</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
                <span class="tx-11 tx-white-6">Total Sales</span>
                <h6 class="tx-white mg-b-0">${{ totalSales() }}</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Total Ekomalls fees</span>
              <h6 class="tx-white mg-b-0">${{ totalFees() }}</h6>
            </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
  </div><!-- row -->
  <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 pb-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">One week Sales Reports</h5>
                </div>
                <div class="card-body">
                  {!! $seven_days_sale->container() !!}
                  {!! $seven_days_sale->script() !!}
                </div>
            </div>
        </div>
          <div class="col-lg-6 col-sm-6 pb-5">
              <div class="card">
                  <div class="card-header">
                      <h5 class="text-center">Users Registered in Last 3 days</h5>
                  </div>
                  <div class="card-body">
                    {!! $chart->container() !!}
                    {!! $chart->script() !!}
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 pb-5">
              <div class="card">
                  <div class="card-header">
                      <h5 class="text-center">Product Added in Last 7 days</h5>
                  </div>
                  <div class="card-body">
                    {!! $product_chart->container() !!}
                    {!! $product_chart->script() !!}
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-6 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader" style=" background:url({{ asset('uploads/bg.jpg') }});">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
                @endif
              
                </div>
                <div class="avatar">
                  @if(Auth::user()->access_token != null)
                    <img src="{{ Auth::user()->profile_picture }}" alt="">
                  @else
                  <img alt="" src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_picture }}">
                  @endif
                </div>
                <div class="info">
                    <div class="title text-left">
                        <span class="text-primary">Name : </span><a target="_blank" href="#">{{ Auth::user()->name }}</a>
                    </div>
                    <div class="desc text-left pt-2"> <span>Status : </span>
                      @if(user_role() == 0)
                        SuperAdmin
                      @elseif(user_role() == 1)
                        Admin
                      @elseif(user_role() == 2)
                        Seller 
                      @else 
                        Customer
                      @endif
                    </div>
                    <div class="desc text-left pt-2"> <span>Email : </span>{{ Auth::user()->email }}</div>
                    <div class="desc text-left pt-2"> <span>Phone : </span>+{{ Auth::user()->areacode }}{{ Auth::user()->phone_number }}</div>
                    <div class="desc text-left pt-2"> <span>Address : </span>{{ Auth::user()->address }}</div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-sm-6" id="message">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Messages</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-primary mg-b-0">
                      <tr>
                        <th>Sl.</th>
                        <th>Sender</th>
                        <th>Body</th>
                        <th>Date</th>
                      </tr>
                      @forelse ($complains as $index => $complain)
                         @if($complain->status == 0)
                          
                            <tr style="font-weight:bold; background:rgba(12, 67, 78, 0.5); color:white;" onclick="window.location=">
                              <td style="color:#fff;font-weight:bold;">{{ $complains -> firstItem() + $index }}</td>
                              <td style="color:#fff;font-weight:bold;"><a style="color:#fff;" href="{{ route('users.profile', $complain->user_id) }}">{{ \App\User::findOrFail($complain->user_id)->name }}</a></td>
                              <td style="color:#fff;font-weight:bold;"><a href="{{ route('view.complain', $complain->id) }}">{{ Str::limit($complain->complain, 5) }}</a></td>
                              <td style="color:#fff;font-weight:bold;">{{ $complain->created_at->format('d-M-Y') }}</td>
                            </tr>

                        @else
                            <tr>
                              <td>{{ $complains -> firstItem() + $index }}</td>
                              <td>{{ \App\User::findOrFail($complain->user_id)->name }}</td>
                              <td><a href="{{ route('view.complain', $complain->id) }}">{{ Str::limit($complain->complain, 5) }}</a></td>
                              <td>{{ $complain->created_at->format('d-M-Y') }}</td>
                            </tr>
                         @endif
                      @empty 
                        <tr>
                          <td>No complains</td>
                        </tr>
                      @endforelse
                    </table>
                    {{ $complains->links() }}
                  </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-12 col-sm-12">
              <div class="card">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
              @endif
              @if (session('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
              @endif
                  <div class="card-header text-center">
                    <h5 class="card-title d-inline-block">All Users | </h5> <p class="d-inline-block">Total Users : {{ $users->count() }} </p>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped">
                             <tr>
                                 <th>SL.</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Status</th>
                                 <th>Action</th>
                             </tr>
                             @forelse ($users as $index => $user)
                                 <tr>
                                     <td>{{ $users -> firstItem() + $index }}</td>
                                     <td>{{ $user->name }}</td>
                                     <td>{{ $user->email }}</td>
                                     <td>
                                         @if($user->user_role == 1)
                                             Admin
                                         @elseif($user->user_role == 2)
                                             Seller
                                         @else 
                                           Customer
                                         @endif
                                     </td>
                                     <td>
                                        <a href="{{ route('users.profile', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                        @if($user->user_role == 3)
                                          <a href="{{ route('make.admin', $user->id) }}" class="btn btn-success btn-sm">Make Admin</a>
                                        @endif
                                        <a href="{{ route('delete.user', $user->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                     </td>
                                 </tr>
                                 @empty 
                                 <tr>
                                     <td>No users available</td>
                                 </tr>
                             @endforelse
                         </table>

                         {{ $users->links() }}
                     </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 m-auto py-5">
            <div class="card">
                <div class="card-header" style="background-color: #FCB800;">
                    <h5>Your Sales by stores #</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Order number</th>
                                <th>Issue Date</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Shop name</th>
                                <th>Total</th>
                                <th>Ekomall fees</th>
                                <th>Pay Seller</th>
                            </tr>
                            @forelse($salesFromShops as $sale)
                                <tr>
                                  <td>#{{ $sale->order_id }}</td>
                                  <td>{{ $sale->created_at->format('d-M-y') }}</td>    
                                  <td>{{ $sale->get_product_info_via_order_list->product_name }}</td>
                                  <td>{{ $sale->quantity }}</td>
                                  <td>
                                    @if($sale->get_product_info_via_order_list->shop_id != null)
                                    {{ $sale->get_product_info_via_order_list->getshop->shop_name }}
                                    @else 
                                       Ekomall
                                    @endif
                                  </td>
                                  <td>

                                    @if($sale->get_product_info_via_order_list->discount_price != null)
                                      ${{ $total = $sale->get_product_info_via_order_list->discount_price - (($sale->get_product_info_via_order_list->discount_price * $sale->quantity) * 5 / 100) }}
                                    @else 
                                      ${{ $total = $sale->get_product_info_via_order_list->product_price - (($sale->get_product_info_via_order_list->product_price * $sale->quantity) * 5 / 100) }}
                                    @endif
                                  </td>
                                  <td>
                                    @if($sale->get_product_info_via_order_list->discount_price)
                                        ${{ ($sale->get_product_info_via_order_list->discount_price * $sale->quantity) * 5 / 100 }} 
                                    @else 
                                        ${{ ($sale->get_product_info_via_order_list->product_price * $sale->quantity) * 5 / 100 }}                                     
                                    @endif
                                  </td>
                                  <td>
                                    @if($sale->get_product_info_via_order_list->shop_id != null)
                                       @if($sale->paid_seller == 0)
                                       <form action="{{ route('pay.seller') }}" method="post">
                                        @csrf 
                                        <input type="hidden" value="{{ $sale->get_product_info_via_order_list->getshop->user_id }}" name="user_id">
                                        <input type="hidden" value="{{ $total }}" name="total">
                                        <input type="hidden" value="{{ $sale->order_id }}" name="order_id">
                                        <button type="submit" class="btn btn-success btn-sm">Pay now</button>
                                      </form>
                                      @else 
                                          Paid
                                       @endif
                                    @else 
                                     <a href="#" class="btn btn-info btn-sm">no store</a>  
                                    @endif
                                 </td>
                                </tr>
                            @empty
                                <tr>
                                  <td>You do not have any sales yet.</td>
                                </tr>
                            @endforelse
                            <tfoot>
                              Total amount are shown after deducting ekomall fees
                            </tfoot>
                        </table>
                         {{-- Report Handler Modal --}}
                         
                        <form action="" method="post" id = "complainForm">
                            @csrf
                          <div class="modal fade" id="complainModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel">Place Complain</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                        <input name="order_id" id="orderNumber" type="text" class="form-control" placeholder="Order Number" hidden>
                                    <div class="py-3">
                                        <label for="complain">Complain box : </label>
                                        <textarea id="complain" name="complain" type="text" class="form-control" placeholder="Write your issue here" required></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                  <button type="submit" class="btn btn-danger">Yes Submit</button>
                                  </div>
                              </div>
                              </div>
                          </div>
                        </form>
                        {{-- Report Handler Modal Ends --}}
                    </div>
                </div>
            </div>
        </div>
          <div class="col-lg-12 col-md-12 col-sm-12 m-auto py-5">
            <div class="card">
                <div class="card-header" style="background-color: #FCB800;">
                    <h5>Your Orders #</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Order number</th>
                                <th>Issue Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Invoice</th>
                                <th>Report</th>
                            </tr>
                            @forelse($orders as $order)
                                <tr>
                                  <td>#{{ $order->id }}</td>
                                  <td>{{ $order->created_at->format('d-M-y') }}</td>    
                                @if($order->payment_status == 1)
                                  <td> <span class="badge badge-warning">Due</span> </td>
                                @elseif($order->payment_status == 0)
                                   <td><span class="badge badge-danger">Failed</span></td>
                                @else
                                  <td> <span class="badge badge-success">Paid</span> </td>
                                @endif
                                @if($order->delivery_status == 0)
                                    <td> <span class="badge badge-info">Pending</span> </td>
                                @else 
                                    <td> <span class="badge badge-success">Delivered</span></td>
                                @endif 
                                    <td>
                                        <a href="{{ route('download.invoice', $order->id) }}" class="btn btn-success btn-sm">Download Invoice</a>
                                    </td>
                                    <td>
                                        <button onclick="reportHandler({{ $order->id }})" class="btn btn-danger btn-sm">Report to support</button>
                                    </td>
                                </tr>
                            @empty
                              <tr>
                                <td>You do not have any orders yet.</td>
                              </tr>
                            @endforelse
                        </table>
                        <form action="" method="post" id = "complainForm">
                            @csrf
                          <div class="modal fade" id="complainModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel">Place Complain</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                        <input name="order_id" id="orderNumber" type="text" class="form-control" placeholder="Order Number" hidden>
                                    <div class="py-3">
                                        <label for="complain">Complain box : </label>
                                        <textarea id="complain" name="complain" type="text" class="form-control" placeholder="Write your issue here" required></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                  <button type="submit" class="btn btn-danger">Yes Submit</button>
                                  </div>
                              </div>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                  </div>
              </div>
          </div>

      </div>




  </div>
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script>
    function reportHandler(id)
      {
          var form  = document.getElementById('complainForm')
              form.action = '/complain'

          document.getElementById('orderNumber').value = id
          $('#complainModal').modal('show')
      }
</script>

@endsection

