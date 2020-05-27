<?php
   
namespace App\Http\Controllers;
   
use Stripe;
use App\Cart;
use App\Order;
use App\Product;
use Carbon\Carbon;
use App\Order_list;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Auth;
   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
       if($request->has('deposit_amount'))
       {
            Stripe\Stripe::setApiKey('sk_live_CCiMR1dPNQCCC2uRcAVbGMEa00qR2AkMv0');
            // Stripe\Stripe::setApiKey('sk_test_firDb2BrvwKsLBZBcsv70lWJ00e8vefitV');
            Stripe\Charge::create ([
                    "amount" => $request->deposit_amount * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Payment from ekomalls.com." 
            ]);

            $user = Auth::user();
            $user->deposit($request->deposit_amount * 100);

            return redirect('/deposit/ekowallet')->withSuccess($request->deposit_amount.' USD deposited into your wallet.You can browse transaction history for more informations.Thank you.');
       }
       else 
       {
            Stripe\Stripe::setApiKey('sk_live_CCiMR1dPNQCCC2uRcAVbGMEa00qR2AkMv0');
            // Stripe\Stripe::setApiKey('sk_test_firDb2BrvwKsLBZBcsv70lWJ00e8vefitV');
            Stripe\Charge::create ([
                "amount" => $request->total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from ekomalls.com." 
        ]);

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
            'payment_status'            =>  2,
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

    
        return redirect('/')->withSuccess('Payment has been made successfully. Your Order number is #'.$order->id);

       }
    }
}