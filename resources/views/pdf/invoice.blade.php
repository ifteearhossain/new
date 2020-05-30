<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <style>

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: 'Arial';
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 95%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


    </style>


    <header class="clearfix">
      <div id="logo">
         <h1>Ekomalls</h1>
         <h2 class="name">Ekomalls</h2>
         <div>Krutthuset 8, 3030, Drammen Norway</div>
         <div>00 47 92117 840</div>
         <div><a href="mailto:info@ekomalls.com">info@ekomalls.com</a></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ Auth::user()->name }}</h2>
          <div class="address">{{ Auth::user()->address }}</div>
          <div class="email"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE 3-2-1</h1>
          <div class="date">Date of Invoice: {{ \Carbon\Carbon::now()->format('d-M-Y') }}</div>
          <div class="date">Order Date: {{ $order_details->created_at->format('d-M-Y') }}</div>
        </div>
      </div>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th class="no">#</th>
                <th class="desc">DESCRIPTION</th>
                <th class="unit">UNIT PRICE</th>
                <th class="qty">QUANTITY</th>
                <th class="total">TOTAL</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($order_list as $item)
             <tr>
                <td class="no">{{ $loop->index +1 }}</td>
                <td class="desc"><h3>{{ $item->get_product_info_via_order_list->product_name }}</h3></td>
                <td class="unit">
                    @if($item->get_product_info_via_order_list->discount_price != null)
                        ${{ $item->get_product_info_via_order_list->discount_price }}
                    @else 
                       ${{ $item->get_product_info_via_order_list->product_price }}
                    @endif
                </td>
                <td class="qty">{{ $item->quantity }}</td>
                <td class="total">
                    @if($item->get_product_info_via_order_list->discount_price != null)
                      {{ $item->get_product_info_via_order_list->discount_price * $item->quantity }}
                    @else 
                      {{ $item->get_product_info_via_order_list->product_price * $item->quantity }}
                    @endif 
                </td>
              </tr>
             @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">SUBTOTAL</td>
                <td>${{ $order_details->sub_total }}</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">GRAND TOTAL</td>
                <td>${{ $order_details->sub_total }}</td>
              </tr>
            </tfoot>
          </table>
    </div>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"> Invoice was created on a computer and is valid without the signature and seal.</div>
      </div>
    </main>
  </body>
</html>