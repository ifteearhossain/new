<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Http\Requests\OrderRequests\OrderFormRequests;
use App\User;
use App\Order;
use App\Product;
use Carbon\Carbon;
use App\Order_list;
use App\PhoneVerify;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class VerifyController extends Controller
{
    public function verify(OrderFormRequests $request)
    {
         $db_otp = PhoneVerify::where('user_id', Auth::id())->first();
          if($db_otp->otp == $request->otp)
          {
             
             User::where('id', Auth::id())->update([

                 'areacode'     => $db_otp->areacode,
                 'phone_number' => $db_otp->phone_number,
                 'country_id'   => $request->country_id,
                 'state_id'     => $request->state_id,
                 'city_id'      => $request->city_id,
                 'address'      => $request->address,
                 'phone_verified_at' => Carbon::now(),
             ]);

             PhoneVerify::findOrFail($db_otp->id)->delete();

             if($request->payment_method == 1)
             {
              if(!$request->has('shipping_fullname'))
              {
                $order = Order::create([
                  'user_id'                   =>  Auth::id(),
                  'billing_fullname'          =>  $request->billing_fullname,         
                  'billing_email'             =>  $request->billing_email,    
                  'country_id'                =>  $request->country_id,
                  'state_id'                  =>  $request->state_id,
                  'city_id'                   =>  $request->city_id,
                  'areacode'                  =>  $request->areacode,
                  'phone_number'              =>  $request->phone_number,
                  'address'                   =>  $request->address,
                  'billing_zipcode'           =>  $request->billing_zipcode,
                  'shipping_fullname'         =>  $request->shipping_fullname,    
                  'shipping_email'            =>  $request->shipping_email, 
                  'shipping_country'          =>  $request->shipping_country,   
                  'shipping_phone_number'     =>  $request->shipping_phone_number,       
                  'shipping_address'          =>  $request->shipping_address,
                  'shipping_zipcode'          =>  $request->shipping_zipcode,   
                  'notes'                     =>  $request->notes,
                  'sub_total'                 =>  $request->sub_total,       
                  'coupon_name'               =>  $request->coupon_name,     
                  'total'                     =>  $request->total,           
                  'payment_method'            =>  $request->payment_method,
                  'payment_status'            =>  1,
                  'created_at'                =>  Carbon::now(),       
  
                ]);
  
                 foreach(cartItems() as $item)
                 {
                     Order_list::insert([
                      'user_id'     => Auth::id(),
                      'order_id'    => $order->id,
                      'product_id'  => $item->product_id,
                      'shop_id'     => $item->cartProduct->shop_id,
                      'quantity'    => $item->quantity,
                      'created_at'  => Carbon::now(),
                     ]);
                  
                     Cart::find($item->id)->delete();
  
                     Product::where('id', $item->product_id)->decrement('product_quantity', $item->quantity);
                 }
  
                 Nexmo::message()->send([
                  'to'   =>  $request->areacode.$request->phone_number ,
                  'from' => 'Ekomalls',
                  'text' => 'Your Order number is #'.$order->id.'.Thank you for shopping with Ekomalls',
              ]);
  
               return redirect('/')->withSuccess('Order has been placed.Our support will get in touch with you regarding the delivery. Thank you for shopping with ekomalls');
  
                 
              }
              else 
              {
                  $order = Order::create([
                      'user_id'                   =>  Auth::id(),
                      'billing_fullname'          =>  $request->billing_fullname,         
                      'billing_email'             =>  $request->billing_email,    
                      'country_id'                =>  $request->country_id,
                      'state_id'                  =>  $request->state_id,
                      'city_id'                   =>  $request->city_id,
                      'areacode'                  =>  $request->areacode,
                      'phone_number'              =>  $request->phone_number,
                      'address'                   =>  $request->address,
                      'billing_zipcode'           =>  $request->billing_zipcode,
                      'shipping_fullname'         =>  $request->billing_fullname,    
                      'shipping_email'            =>  $request->billing_email, 
                      'shipping_country'          =>  $request->shipping_country,   
                      'shipping_phone_number'     =>  $request->phone_number,       
                      'shipping_address'          =>  $request->address,   
                      'shipping_zipcode'          =>  $request->billing_zipcode,   
                      'notes'                     =>  $request->notes,
                      'sub_total'                 =>  $request->sub_total,       
                      'coupon_name'               =>  $request->coupon_name,     
                      'total'                     =>  $request->total,
                      'payment_method'            =>  $request->payment_method,
                      'payment_status'            =>  1,         
                      'created_at'                =>  Carbon::now(),         
      
                    ]);
                    
                 foreach(cartItems() as $item)
                 {
                     Order_list::insert([
                      'user_id'     => Auth::id(),
                      'order_id'    => $order->id,
                      'product_id'  => $item->product_id,
                      'quantity'    => $item->quantity,
                      'shop_id'     => $item->cartProduct->shop_id,
                      'created_at'  => Carbon::now(),
                     ]);
                  
                     Cart::find($item->id)->delete();
  
                     Product::where('id', $item->product_id)->decrement('product_quantity', $item->quantity);
                 }
  
                 Nexmo::message()->send([
                  'to'   =>  $request->areacode.$request->phone_number ,
                  'from' => 'Ekomalls',
                  'text' => 'Your Order number is '.$order->id.'.Thank you for shopping with Ekomalls',
              ]);
  
               return redirect('/')->withSuccess('Order has been placed.Our support will get in touch with you regarding the delivery. Thank you for shopping with ekomalls');
              }
             }
             elseif($request->payment_method == 2)
             {
                 return view('frontend.stripe', [
                     'user_id'                   =>  Auth::id(),   
                     'billing_fullname'          =>  $request->billing_fullname,         
                     'billing_email'             =>  $request->billing_email,    
                     'country_id'                =>  $request->country_id,
                     'state_id'                  =>  $request->state_id,
                     'city_id'                   =>  $request->city_id,
                     'areacode'                  =>  $request->areacode,
                     'phone_number'              =>  $request->phone_number,
                     'address'                   =>  $request->address,
                     'billing_zipcode'           =>  $request->billing_zipcode,
                     'shipping_fullname'         =>  $request->shipping_fullname,    
                     'shipping_email'            =>  $request->shipping_email, 
                     'shipping_country'          =>  $request->shipping_country,   
                     'shipping_phone_number'     =>  $request->shipping_phone_number,       
                     'shipping_address'          =>  $request->shipping_address,
                     'shipping_zipcode'          =>  $request->shipping_zipcode,   
                     'notes'                     =>  $request->notes,
                     'sub_total'                 =>  $request->sub_total,       
                     'coupon_name'               =>  $request->coupon_name,     
                     'total'                     =>  $request->total,           
                     'payment_method'            =>  $request->payment_method,
                     'created_at'                =>  Carbon::now(), 
     
                 ]);
             }
             
          }
          else 
          {
              return redirect('/checkout')->withErrors('Phone Verification failed please try again');
          }
    }

    public function userVerify(Request $request)
    {
        $request->validate([
            'areacode' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]); 

        $otp =  mt_rand(1000,10000);

         // Phone Verification  if number is changed but already exist

        if(Auth::user()->phone_verified_at == null)
        {
            if(PhoneVerify::where('user_id', Auth::id())->exists())
            {
                $phone_verify = PhoneVerify::where('user_id', Auth::id())->first();
                PhoneVerify::where('id', $phone_verify->id)->update([
                    'otp'  => $otp,
                ]);
                Nexmo::message()->send([
                    'to'   =>  $request->areacode.$request->phone_number ,
                    'from' => 'Ekomalls',
                    'text' => 'Your verification code is '.$otp,
                ]);

                // After Verification Proceeding to order 

                return view('frontend.normalVerify', [

                    'areacode'     => $request->areacode,
                    'phone_number' => $request->phone_number,
                ]);
            }
            else 
            {
                 // Phone verification of fresh number 

                PhoneVerify::insert([

                    'user_id'      => Auth::id(),
                    'areacode'     => $request->areacode,
                    'phone_number' => $request->phone_number,
                    'otp'          => $otp,
                    'created_at'   => Carbon::now(),
                ]);
            }
            Nexmo::message()->send([
                'to'   =>  $request->areacode.$request->phone_number ,
                'from' => 'Ekomalls',
                'text' => 'Your verification code is '.$otp,
            ]);


            return view('frontend.normalVerify', [

                'areacode'     => $request->areacode,
                'phone_number' => $request->phone_number,
            ]);
        }
         
    }

    public function verifyDone(Request $request)
    {
        $db_otp = PhoneVerify::where('user_id', Auth::id())->first();
        if($db_otp->otp == $request->otp)
        {
           
           User::where('id', Auth::id())->update([

               'areacode'     => $db_otp->areacode,
               'phone_number' => $db_otp->phone_number,
               'country_id'   => $request->country_id,
               'state_id'     => $request->state_id,
               'city_id'      => $request->city_id,
               'address'      => $request->address,
               'phone_verified_at' => Carbon::now(),
           ]);

           PhoneVerify::findOrFail($db_otp->id)->delete();

           return redirect('/shops/create');
        }
        else 
        {
            return redirect('/sell/with/ekomalls')->withErrors('Phone Verification failed.Please try again');
        }
    }

  // End   
}
