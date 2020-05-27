<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Order_list;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('customercheck')->except(['addreview']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $recentBuy = Order_list::where('user_id', Auth::id())->latest()->limit(5)->get();
      $orders = Order::where('user_id', Auth::id())->get();
      return view('customer.index', compact('recentBuy', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadInvoice($order_id)
    {
        $order_details = Order::where('user_id', Auth::id())->where('id', $order_id)->first();
        $order_list = Order_list::where('user_id', $order_details->user_id)->where('order_id', $order_details->id)->get();

        $pdf = PDF::loadView('pdf.invoice', compact('order_details', 'order_list'));
        $invoice = 'invoice_order_number_'. $order_id .'_'.Carbon::now()->format('d-M-Y'). '.pdf';
        return $pdf->download($invoice);

    }

    function addreview(Request $request)
    {
      Order_list::where('user_id', Auth::id())->where('product_id', $request->product_id)->whereNull('review')->first()->update([
       'star'  =>  $request->star,
       'review' => $request->review,
      ]);
 
      return back()->withSuccess('Review Added');
    }

 // END    
}
