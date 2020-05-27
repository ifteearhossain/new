<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Order;
use App\Product;
use Carbon\Carbon;
use App\Order_list;
use App\PhoneVerify;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use Nexmo\Laravel\Facade\Nexmo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequests\OrderFormRequests;

class VerifyPayPalController extends Controller
{
    public function verify(OrderFormRequests $request)
    {
         $db_otp = PhoneVerify::where('user_id', Auth::id())->first();

           // Check otp 
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

                // Place Order after checking otp 

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
                'payment_status'            =>  0,
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
                  }
    
                  Nexmo::message()->send([
                    'to'   =>  $request->areacode.$request->phone_number ,
                    'from' => 'Ekomalls',
                    'text' => 'Your Order number is #'.$order->id.'.Thank you for shopping with Ekomalls',
                  ]);
    
    

                  $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
    
                        'AU5mPp6j2MdYw87kE5NVN0MoyQaq9iI7qpnzScWildVPAuPuplsnwzTuSWTdJMAEz11uGOCAkxqdhRuE',     // ClientID
                        'ECYuy0oSx1kqxnGSWOCD1ZsVwEryOI-u_KcFIkXf7EFcQSeTiMkHD7TM2UDBmrwnkf4zTcRvAkYE5sxU'      // ClientSecret
                      )
                  );
    
                  $apiContext->setConfig(
                    array(
                      'log.LogEnabled' => true,
                      'log.FileName' => 'PayPal.log',
                      'log.LogLevel' => 'DEBUG',
                      'mode' => 'live'
                    )
                   );
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
    
    
            $item= new Item();
            $item->setName($order->id)
                       ->setCurrency('USD')
                       ->setQuantity(1)
                       ->setSku('12312312')
                       ->setPrice($request->total); 
    
            $itemList = new ItemList();
            $itemList->setItems([$item]);
      
    
            $details = new Details();
            $details->setShipping(0)
                    ->setTax(0)
                    ->setSubtotal($request->total);
    
            $amount = new Amount();
            $amount->setCurrency('USD')
                    ->setTotal($request->total)
                    ->setDetails($details);
    
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Payment description')
                    ->setInvoiceNumber(uniqid());
    
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl('https://ekomalls.com/execute-payment')
                         ->setCancelUrl('https://ekomalls.com/cancel');
    
            $payment = new Payment();
            $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);
    
            $payment->create($apiContext);
    
    
            return redirect($payment->getApprovalLink());
          
          }
          else 
          {
              return redirect('/checkout')->withErrors('Phone Verification failed please try again');
          }
    }

    public function execute(Request $request)
    {

        

      $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(

            'AU5mPp6j2MdYw87kE5NVN0MoyQaq9iI7qpnzScWildVPAuPuplsnwzTuSWTdJMAEz11uGOCAkxqdhRuE',     // ClientID
            'ECYuy0oSx1kqxnGSWOCD1ZsVwEryOI-u_KcFIkXf7EFcQSeTiMkHD7TM2UDBmrwnkf4zTcRvAkYE5sxU'      // ClientSecret
          )
      );

      $apiContext->setConfig(
        array(
          'log.LogEnabled' => true,
          'log.FileName' => 'PayPal.log',
          'log.LogLevel' => 'DEBUG',
          'mode' => 'live'
        )
       );

      $paymentId = request('paymentId');
      $payment = Payment::get($paymentId, $apiContext);

     // Execution

      $execution = new PaymentExecution();
      $execution->setPayerId(request('PayerID'));

 

      $result = $payment->execute($execution, $apiContext);

          $json = json_decode($result, true); 
          $pay_id = $json['transactions'][0]['item_list']['items'][0]['name'];



      
      if ($result->getState() == 'approved')
      {
         
         Order::where('id', $pay_id)->update([
             'payment_status'  => 2,
         ]);

         foreach(cartItems() as $item)
         {
           Cart::find($item->id)->delete();
           Product::where('id', $item->product_id)->decrement('product_quantity', $item->quantity);
         }
         return redirect('/')->withSuccess('Thank you for Shopping with ToHoney');
     }
     
    }

  // END   
}
