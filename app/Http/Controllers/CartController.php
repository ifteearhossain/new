<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Coupon;
use App\Product;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($coupon_name = "")
    {
        if(cartTotal() > 0)
        {
            if($coupon_name != "")
            {
                if(Coupon::where('coupon_name', $coupon_name)->exists())
                {
                    if(Coupon::where('coupon_name', $coupon_name)->where('valid_till', '>=', Carbon::now()->format('Y-m-d'))->exists())
                    {
                     if(!Order::where('user_id', Auth::id())->where('coupon_name', $coupon_name)->exists())
                     {
                        foreach(cartItems() as $item)
                        {
                            $id = Product::where('id', $item->product_id)
                                         ->whereNotNull('discount_price')->first();
    
                        }
                        if(!$id)
                        {
                            $coupon_discount = Coupon::where('coupon_name', $coupon_name)->first();
                            return view('frontend.cart', compact('coupon_discount'));
                        }
                        else 
                        {
                            return redirect('/cart')->withErrors('Coupons cannot be used on discounted products');
                        }
                     }
                     else 
                     {
                         return redirect('/cart')->withErrors('You have already used this coupon.Please try another coupon');
                     }
                    }
                    else 
                    {
                        return redirect('/cart')->withErrors('Coupon has expired');
                    }
                    
                }
                else 
                {
                    return redirect('/cart')->withErrors('Invalid coupon code');
                }
               
            }
            else 
            {
                return view('frontend.cart');
            }
             
             
        }
        else 
        {
           return redirect('/')->withSuccess('Please add products to cart in order to visit the cart page');
        }

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
        $product = Product::findOrFail($request->product_id);
        $cart = Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->first();


            if($product->product_quantity >= $request->quantity)
            {
                if(Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->exists())
                {
                    
                    if(($cart->quantity + $request->quantity) <= $product->product_quantity)
                    {
                    Cart::where('ip_address', $request->ip())
                        ->where('product_id', $request->product_id)
                        ->increment('quantity', $request->quantity);
                    }
                    else 
                    {
                        return back()->withErrors('Your desired amount is not available in stock at the moment');
                    }
                }
                else 
                {
                    Cart::insert([
                  
                        'ip_address' => $request->ip(),
                        'product_id' => $request->product_id,
                        'quantity'   => $request->quantity,
                        'created_at' => Carbon::now(),
                        
                     ]);
                }
        
               return back()->withSuccess('Product Added to Cart');
            }
            else
            {
                return back()->withErrors('Your desired amount is not available in stock at the moment');
            }

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
       foreach ($request->id as $key => $id) 
       {
            
           if(Product::findOrFail($id)->product_quantity >= $request->quantity[$key])
           {
            Cart::where('product_id', $id)->update([

                'quantity' => $request->quantity[$key]
    
              ]);
           }
           else 
           {
               return back()->withErrors('Your desired amount is not available in our stock.Please try again');
           }
       }

       return back()->withSuccess('Cart updated successfully');

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

    public function cartremove($cart_id)
    {
        Cart::findOrFail($cart_id)->delete();

        return back();
    }
}
