<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CouponRequests\CouponFormPost;
use App\Coupon;
use Carbon\Carbon;
use App\User;
use App\Mail\DiscountCoupon;
use Mail;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolecoupon');
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('backend.coupon.index', compact('coupons'));
    }

    public function store(CouponFormPost $request)
    {
        Coupon::create([
            'coupon_name'     => strToUpper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'valid_till'      => $request->valid_till,
            'created_at'      => Carbon::now(),
          ]);

        $coupon_name = $request->coupon_name; 
        $valid_till  = $request->valid_till; 
        $customers   = User::where('user_role', 3)->get();
        $discount    = $request->coupon_discount;

        foreach ($customers as $customer) {
            $customer_name = $customer->name;
            Mail::to($customer->email)->send(new DiscountCoupon($coupon_name, $valid_till, $customer_name, $discount)); 
        }
        return back()->withSuccess('Coupon added');
    }

}
