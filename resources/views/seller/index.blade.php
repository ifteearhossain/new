@extends('layouts.dashboard')

@section('top_scripts')
<script>
    const target = {
  clicked: 0,
  currentFollowers: 90,
  btn: document.querySelector("a.btn"),
  fw: document.querySelector("span.followers")
};

const follow = () => {
  target.clicked += 1;
  target.btn.innerHTML = 'Following <i class="fas fa-user-times"></i>';

  if (target.clicked % 2 === 0) {
    target.currentFollowers -= 1;
    target.btn.innerHTML = 'Follow <i class="fas fa-user-plus"></i>';
  }
  else {
    target.currentFollowers += 1;
  }

  target.fw.textContent = target.currentFollowers;
  target.btn.classList.toggle("following");
}
</script>
@endsection

@section('title')
   Seller  Dashboard
@endsection

@section('dashboard-active')
  active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('seller.index') }}">Seller Dashboard</a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a>
    <span class="breadcrumb-item active">Blank Page</span> --}}
  </nav>

@endsection

@section('inline-css')
    
    <style>

@import url('https://fonts.googleapis.com/css?family=Krub:400,700');

@import url("https://fonts.googleapis.com/css?family=Krub:400,700");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
}

body {
  background: #202020;
  font-family: 'Krub', sans-serif;
}

.a {
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 250px;
  height: 400px;
  border-radius: 10px;
  box-shadow: 0 10px 25px 5px rgba(0, 0, 0, 0.2);
  background: #151515;
  overflow: hidden;
}
.a .ds-top {
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  left: 0;
  width: 300px;
  height: 80px;
  background: crimson;
  animation: dsTop 1.5s;
}
.a .avatar-holder {
  position: absolute;
  margin: auto;
  top: 40px;
  right: 0;
  left: 0;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  box-shadow: 0 0 0 5px #151515, inset 0 0 0 5px #000000, inset 0 0 0 5px #000000, inset 0 0 0 5px #000000, inset 0 0 0 5px #000000;
  background: white;
  overflow: hidden;
  animation: mvTop 1.5s;
}
.a .avatar-holder img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.a .name {
  position: absolute;
  margin: auto;
  top: -60px;
  right: 0;
  bottom: 0;
  left: 0;
  width: inherit;
  height: 40px;
  text-align: center;
  animation: fadeIn 2s ease-in;
}
.a .name a {
  color: white;
  text-decoration: none;
  font-weight: 700;
  font-size: 18px;
}
.a .name a:hover {
  text-decoration: underline;
  color: crimson;
}
.a .name h6 {
  position: absolute;
  margin: auto;
  left: 0;
  right: 0;
  bottom: 0;
  color: white;
  width: 40px;
}
.a .button {
  position: absolute;
  margin: auto;
  padding: 8px;
  top: 20px;
  right: 0;
  bottom: 0;
  left: 0;
  width: inherit;
  height: 40px;
  text-align: center;
  animation: fadeIn 2s ease-in;
  outline: none;
}
.a .button a {
  padding: 5px 20px;
  border-radius: 10px;
  color: white;
  letter-spacing: 0.05em;
  text-decoration: none;
  font-size: 10px;
  transition: all 1s;
}
.a .button a:hover {
  color: white;
  background: crimson;
}
.a .ds-info {
  position: absolute;
  margin: auto;
  top: 120px;
  bottom: 0;
  right: 0;
  left: 0;
  width: inherit;
  height: 40px;
  display: flex;
}
.a .ds-info .pens, .a .ds-info .projects, .a .ds-info .posts {
  position: relative;
  left: -300px;
  width: calc(250px / 3);
  text-align: center;
  color: white;
  animation: fadeInMove 2s;
  animation-fill-mode: forwards;
}
.a .ds-info .pens h6, .a .ds-info .projects h6, .a .ds-info .posts h6 {
  text-transform: uppercase;
  color: crimson;
}
.a .ds-info .pens p, .a .ds-info .projects p, .a .ds-info .posts p {
  font-size: 12px;
}
.a .ds-info .ds:nth-of-type(2) {
  animation-delay: .5s;
}
.a .ds-info .ds:nth-of-type(1) {
  animation-delay: 1s;
}
.a .ds-skill {
  position: absolute;
  margin: auto;
  bottom: 10px;
  right: 0;
  left: 0;
  width: 200px;
  height: 100px;
  animation: mvBottom 1.5s;
}
.a .ds-skill h6 {
  margin-bottom: 5px;
  font-weight: 700;
  text-transform: uppercase;
  color: crimson;
}
.a .ds-skill .skill h6 {
  font-weight: 400;
  font-size: 8px;
  letter-spacing: 0.05em;
  margin: 4px 0;
  color: white;
}
.a .ds-skill .skill .fab {
  color: crimson;
  font-size: 14px;
}
.a .ds-skill .skill .bar {
  height: 5px;
  background: crimson;
  text-align: right;
}
.a .ds-skill .skill .bar p {
  color: white;
  font-size: 8px;
  padding-top: 5px;
  animation: fadeIn 5s;
}
.a .ds-skill .skill .bar:hover {
  background: white;
}
.a .ds-skill .skill .bar-html {
  width: 95%;
  animation: htmlSkill 1s;
  animation-delay: .4s;
}
.a .ds-skill .skill .bar-css {
  width: 90%;
  animation: cssSkill 2s;
  animation-delay: .4s;
}
.a .ds-skill .skill .bar-js {
  width: 75%;
  animation: jsSkill 3s;
  animation-delay: .4s;
}

@keyframes fadeInMove {
  0% {
    opacity: 0;
    left: -300px;
  }
  100% {
    opacity: 1;
    left: 0;
  }
}
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes htmlSkill {
  0% {
    width: 0;
  }
  100% {
    width: 95%;
  }
}
@keyframes cssSkill {
  0% {
    width: 0;
  }
  100% {
    width: 90%;
  }
}
@keyframes jsSkill {
  0% {
    width: 0;
  }
  100% {
    width: 75%;
  }
}
@keyframes mvBottom {
  0% {
    bottom: -150px;
  }
  100% {
    bottom: 10px;
  }
}
@keyframes mvTop {
  0% {
    top: -150px;
  }
  100% {
    top: 40px;
  }
}
@keyframes dsTop {
  0% {
    top: -150px;
  }
  100% {
    top: 0;
  }
}
.following {
  color: white;
  background: crimson;
}



    </style>

@endsection

@section('content')
      @if ($errors->all())
      <div class="alert alert-danger" role="alert">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </div>
      @endif
  <div class="container">

      <div class="row">
         <div class="col-lg-6 col-sm-12">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
          @endif
            <div class="card a">
                <div class="ds-top"></div>
                <div class="avatar-holder">
                    @if(Auth::user()->access_token != null)
                    <img src="{{ Auth::user()->profile_picture }}" alt="">
                  @else
                    <img alt="" src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_picture }}">
                  @endif
                </div>
                <div class="name">
                  <a href="#" target="_blank">{{ Auth::user()->name }}
                    @if(Auth::user()->email_verified_at && Auth::user()->phone_verified_at)
                    <i style="color:green;" class="fas fa-check"></i>
                    @else 
                       Not verified
                    @endif 
                  </a>
                </div>
                <div class="button">
                  @if (Auth::user()->phone_verified_at == null)
                  <a href="{{ route('shops.create') }}" class="btn" onmousedown="follow();">Verify Phone number<i class="fas fa-user-plus"></i></a>
                  @else 
                  <a href="{{ route('profile.edit') }}" class="btn" onmousedown="follow();">Update Profile <i class="fas fa-user-plus"></i></a>
                  @endif
                </div>
                <div class="ds-info">
                  <div class="ds pens">
                    <h6 title="Number of pens created by the user">Orders</h6>
                    <p>{{ userOrders() }}</p>
                  </div>
                  <div class="ds projects">
                    <h6 title="Number of projects created by the user">Products</h6>
                    <p>{{ productsCountByUser() }}</p>
                  </div>
                  <div class="ds posts">
                    <h6 title="Number of posts">Spent</h6>
                    <p>${{ userTotalSpent() }}</p>
                  </div>
                </div>
                <div class="ds-skill">
                  <h6>Payment Methods <i class="fas fa-money-check-alt" aria-hidden="true"></i></h6>
                  <div class="skill html ">
                    <h6><i class="fas fa-money-bill-alt"></i></i> Cash on Delivery</h6>
                    <div class="bar bar-html">
                      <p>{{ userPaidCod() }}</p>
                    </div>
                  </div>
                  <div class="skill css">
                    <h6><i class="fas fa-credit-card"></i>Card</h6>
                    <div class="bar bar-css">
                      <p>{{ userPaidCard() }}</p>
                    </div>
                  </div>
                  <div class="skill javascript">
                    <h6><i class="fab fa-paypal"></i>PayPal </h6>
                    <div class="bar bar-js">
                      <p>{{ userPaidPayPal() }}</p>
                    </div>
                  </div>
                </div>
              </div>
         </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header" style="background-color: #FCB800;">
                    <h5 class="card-title">Recent Products bought</h5>
                </div>
                <div class="card-body" style="height:400px;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                               <th>SL</th>
                               <th>Product name</th>
                               <th>Product image</th>
                               <th>Quantity</th>
                               <th>Order Date</th>
                            </tr>
                            @forelse($recentBuy as $recent)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $recent->get_product_info_via_order_list->product_name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $recent->get_product_info_via_order_list->product_thumbnail_image }}" alt="Not found" width="40">
                                    </td>
                                    <td>{{ $recent->quantity }}pcs</td>
                                    <td>{{ $recent->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr style="height:400px;">
                                    <td>No items found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>

                    
                </div>
            </div>
        </div> 
            <div class="col-lg-12 col-md-12 col-sm-12 m-auto py-5">
                <div class="card">
                    <div class="card-header" style="background-color: #FCB800;">
                        <h5>Your Sales #</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Order number</th>
                                    <th>Issue Date</th>
                                    <th>Product name</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @forelse($sales as $sale)
                                    <tr>
                                      <td>#{{ $sale->order_id }}</td>
                                      <td>{{ $sale->created_at->format('d-M-y') }}</td>    
                                      <td>{{ $sale->get_product_info_via_order_list->product_name }}</td>
                                      <td>{{ $sale->quantity }}</td>
                                      <td>Our support will get in touch with you regarding delivery.</td>
                                      <td>

                                        @if($sale->get_product_info_via_order_list->discount_price != null)
                                          ${{  $price =  $sale->get_product_info_via_order_list->discount_price - (($sale->get_product_info_via_order_list->discount_price * $sale->quantity) * 5 / 100) }}
                                        @else 
                                          ${{  $price = $sale->get_product_info_via_order_list->product_price - (($sale->get_product_info_via_order_list->product_price * $sale->quantity) * 5 / 100) }}
                                        @endif
                                      </td>
                                      <td>
                                        @if($sale->paid_seller == 0)
                                          <span class="badge badge-warning">Due</span>
                                        @else 
                                          <span class="badge badge-success">Paid</span>
                                        @endif
                                      </td>
                                    </tr>
                                    @php
                                     $total += $price
                                    @endphp
                                @empty
                                    <tr>
                                      <td>You do not have any sales yet.</td>
                                    </tr>
                                @endforelse
                                 <tr>
                                   <th>Total sales</th>
                                   <th>${{ $total }}</th>
                                 </tr>
                                <tfoot>
                                  Amount shown are after deducting ekomall fees.
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
                                            <a href="{{ route('download.invoiceseller', $order->id) }}" class="btn btn-success btn-sm">Download Invoice</a>
                                        </td>
                                        <td>
                                            <button onclick="reportHandler({{ $order->id }})" class="btn btn-danger btn-sm">Report to support</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                      <td>You did not place any orders yet.</td>
                                    </tr>
                                @endforelse
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
      </div>
  </div>
@endsection

@section('scripts')

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

