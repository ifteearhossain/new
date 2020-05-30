<?php

namespace App\Http\Controllers;

use App\Sms;
use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nexmo;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolesale');
    }

    public function index()
    {
        $orders = Order::latest()->get();
        return view('backend.sale.index',compact('orders'));
    }
    public function saleCod ()
    {
        $orders = Order::where('payment_method', 1)->latest()->get();
        return view('backend.sale.index',compact('orders'));
    }
    public function saleCard ()
    {
        $orders = Order::where('payment_method', 2)->latest()->get();
        return view('backend.sale.index',compact('orders'));
    }
    public function salePayPal ()
    {
        $orders = Order::where('payment_method', 3)->latest()->get();
        return view('backend.sale.index',compact('orders'));
    }
    public function saleWallet ()
    {
        $orders = Order::where('payment_method', 4)->latest()->get();
        return view('backend.sale.index',compact('orders'));
    }
    public function saleBank ()
    {
        $orders = Order::where('payment_method', 5)->latest()->get();
        return view('backend.sale.index',compact('orders'));
    }

    public function delivered($order_id)
    {
        Order::findOrFail($order_id)->update([
            'delivery_status' => 1,
            'payment_status'  => 2,
        ]);
        return back()->withSuccess('Order status changed to delivered');
    }
    public function receivedPayment($order_id)
    {
        Order::findOrFail($order_id)->update([
            'payment_status'  => 2,
        ]);
        return back()->withSuccess('Order status changed to paid');
    }

    public function sendsms(Request $request)
    {
        $phone = User::where('id', $request->user_id)->first();
        Sms::insert([
            'user_id'    => $request->user_id,
            'txt'        => $request->txt,
            'created_at' => Carbon::now(),
        ]);

        Nexmo::message()->send([
            'to'   =>  $phone->areacode.$phone->phone_number ,
            'from' => 'Ekomalls',
            'text' =>  $request->txt.' Thank you for shopping with Ekomalls',
          ]);
        return back()->withSuccess('Txt message sent successfully');
    }

    public function cancel($order_id)
    {
        Order::findOrFail($order_id)->delete();
        return back()->withSuccess('Order Cancelled');
    }

  // END  
}
