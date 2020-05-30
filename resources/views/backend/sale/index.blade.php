@extends('layouts.dashboard')

@section('title')
   Sales | All
@endsection

@section('sale-active')
  active
@endsection

@section('top_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (user_role() == 0)
       Master Admin Home
     @elseif (user_role() == 1)
       Admin Dashboard
     @elseif (user_role() == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Total Orders received</span>
  </nav>
@endsection
 
@section('content')
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
         @if(session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
        <h2>All Orders</h2>
        <p>Type order number to look for individual orders:</p>  
        <input class="form-control" id="myInput" type="text" placeholder="Order number..">
        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th># Order Number</th>
                    <th>Ordered by</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Issue date</th>
                    <th>Coupon</th>
                    <th>Total</th>
                    <th>View details</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Send Sms</th>
                    <th>Cancel</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                   @forelse ($orders as $order)
                   <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->ordered_by->name }}</td>
                    <td>{{ $order->ordered_by->email }}</td>
                    <td>{{ $order->ordered_by->areacode }} {{ $order->ordered_by->phone_number }}</td>
                    <td>{{ $order->created_at->format('d-M-Y')  }}</td>
                    <td>{{ $order->coupon_name ?? "No coupon used" }}</td>
                    <td>${{ $order->total }}</td>
                    <td>
                        <button style="cursor:pointer;" onclick="orderedProductHandler({{ $order->id }})" class="btn btn-info">Details</button>
                    </td>
                    <td>
                        @if($order->payment_status == 1)
                            Due
                        @elseif($order->payment_status == 0)
                           <a href="{{ route('sale.receivedPayment', $order->id) }}" class="btn btn-secondary">Confirm</a>
                        @else 
                            Paid
                        @endif
                    </td>
                    <td>
                       @if($order->delivery_status == 0)
                        <a href="{{ route('sale.delivered', $order->id) }}" class="btn btn-dark">Mark as Delivered</a>
                       @else 
                        <span class="badge badge-pill badge-success">Delivered</span>
                       @endif
                    </td>
                    <td> 
                            <button onclick="customerSmsHandler({{ $order->ordered_by->id }})" class="btn btn-warning">sms customer</button>
                    </td>
                    <td>
                      <a href="{{ route('sale.cancel', $order->id) }}" class="btn btn-danger">Cancel</a>
                    </td>
                  </tr>
                   @empty
                    <tr>
                        <td>Ekomalls have no sales till date</td>
                    </tr>
                   @endforelse
                </tbody>
              </table>
              {{-- Ordered Product Modal --}}
              @foreach ($orders as $order)
                            <div class="modal fade" id="orderProductModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Place Complain </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Product name</th>
                                                    <th>Product image</th>
                                                    <th>Product price</th>
                                                    <th>Product quantity</th>
                                                </tr>
                                                    @foreach ($order->get_order_list as $order_list)
                                                          <tr>
                                                             <td>{{ $order_list->get_product_info_via_order_list->product_name }}</td> 
                                                             <td>
                                                                  <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $order_list->get_product_info_via_order_list->product_thumbnail_image }}" alt="Not found" width="50">
                                                             </td> 
                                                             <td>
                                                                 @if($order_list->get_product_info_via_order_list->discount_price != null)
                                                                    ${{ $order_list->get_product_info_via_order_list->discount_price }}
                                                                 @else 
                                                                    ${{ $order_list->get_product_info_via_order_list->product_price }}
                                                                 @endif 
                                                             </td>
                                                             <td>{{ $order_list->quantity }}</td>
                                                          </tr>                                          
                                                    @endforeach
                                            </table>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Go Back</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    @endforeach
              {{-- Ordered Product Modal Ends --}}

              {{-- Sms Customer Modal --}}
              <form action="" method="post" id = "smsForm">
                @csrf
                   <div class="modal fade" id="customerSmsModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                       <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Send text message</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                            <input name="user_id" id="userId" type="text" class="form-control" placeholder="Order Number" hidden>
                        <div class="py-3">
                            <label for="complain">Send text message : </label>
                            <textarea id="complain" name="txt" type="text" class="form-control" placeholder="Write your message here" required></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                      <button type="submit" class="btn btn-success">Yes Send</button>
                      </div>
                  </div>
                  </div>
              </div>
            </form>
            {{-- Sms Customer Modal Ends --}}

        </div>
        
        <p>Note that we start the search in tbody, to prevent filtering the table headers.</p>
     </div>   
    </div> 

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
<script>
    
   function orderedProductHandler(id)
   {
     $('#orderProductModal' + id).modal('show')
   }

</script>
<script>
    function customerSmsHandler(id)
      {
          var form  = document.getElementById('smsForm')
              form.action = '/send/sms'

          document.getElementById('userId').value = id
          $('#customerSmsModal').modal('show')
      }
</script>
@endsection