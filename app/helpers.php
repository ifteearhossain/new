<?php 

    function user_role()
    {
        return \Auth::user()->user_role;
    }

    function categories()
    {
        return \App\Category::orderBy('category_name')->get();
    }

    function productsByBrand()
    {
        return \App\Product::orderBy('product_brand', 'asc')->get();
    }

    function productElectronics()
    {
        return App\Product::where('category_id', 3)->get(); 
    }

    function productMens()
    {
        return App\Product::where('category_id', 1)->get(); 
    }

    function productWomens()
    {
        return App\Product::where('category_id', 12)->get();
    }

    function productSports()
    {
        return App\Product::where('category_id', 8)->get();
    }

    function productDiscount()
    {
        return App\Product::whereNotNull('discount_price')->get();
    }

    function checkSubscriber()
    {
        return App\Subscription::where('ip_address', request()->ip())->where('no-show', 1)->exists();
    }

    function cartTotal()
    {
        return App\Cart::where('ip_address', request()->ip())->count();
    }

    function wishlistTotal()
    {
        return App\Wishlist::where('ip_address', request()->ip())->count();
    }

    function cartItems()
    {
        return App\Cart::where('ip_address', request()->ip())->get();
    }

    function subTotal()
    {
        $sub_total = 0;
        foreach(cartItems() as $item)
        {
            if($item->cartProduct->discount_price != null)
            {
                $sub_total = $sub_total + ($item->quantity * $item->cartProduct->discount_price);
            }
            else 
            {
                $sub_total = $sub_total + ($item->quantity * $item->cartProduct->product_price);
            }
        }
        return $sub_total;
    }

    function coupon($coupon_name)
    {
        return App\Coupon::where('coupon_name', $coupon_name)->first();
    }

    function userOrders()
    {
       return App\Order::where('user_id', Auth::id())->count();
    }

    function productsCountByUser()
    {
        return App\Order_list::where('user_id', Auth::id())->count();
    }

    function userTotalSpent()
    {
        return App\Order::where('user_id', Auth::id())->sum('total');
    }

    function userPaidCod()
    {
        return App\Order::where('user_id', Auth::id())->where('payment_method', 1)->count();
    }

    function userPaidCard()
    {
        return App\Order::where('user_id', Auth::id())->where('payment_method', 2)->count();
    }

    function userPaidPayPal()
    {
        return App\Order::where('user_id', Auth::id())->where('payment_method', 3)->count();
    }

    function todaysSales()
    {
        return App\Order::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->sum('total');
    }

    function monthsSales()
    {
        return App\Order::whereMonth('created_at', \Carbon\Carbon::now()->format('m'))->sum('total');
    }

    function totalSales()
    {
        return App\Order::sum('total');
    }

    function todaysFees()
    {
        return  floor((5/100) * todaysSales()); 
    }

    function totalFees()
    {
        return  floor((5/100) * totalSales()); 
    }

    function totalReceived()
    {
        return App\Order::where('payment_status', 2)->sum('total');
    }

    function totalDue()
    {
        return App\Order::where('payment_status', 1)->sum('total');
    }

    function complains()
    {
        return App\Complain::where('status', 0)->get();
    }

    function withdraws()
    {
        return App\Withdraw::where('transfer', 0)->get();
    }

    function finduser($id)
    {
        return App\User::findOrFail($id);
    }

    function reviewCount($product_id)
    {
        return App\Order_list:: where('product_id', $product_id)->whereNotNull('star')->count();
    }

    function average_stars($product_id)
    {

        if(!App\Order_list::where('product_id', $product_id)->exists())
        {
            return 0;
        }
        if(App\Order_list::where('product_id', $product_id)->whereNotNull('star')->exists())
        {
            $average = App\Order_list::where('product_id', $product_id)->whereNotNull('star')->sum('star')/App\Order_list::where('product_id', $product_id)->whereNotNull('star')->count();
            return floor($average);
        }
        if(App\Order_list::where('product_id', $product_id)->whereNull('star')->exists())
        {
            return 0;
        }
        $average = App\Order_list::where('product_id', $product_id)->whereNotNull('star')->sum('star')/App\Order_list::where('product_id', $product_id)->whereNotNull('star')->count();
        return floor($average);

    }

    function naira()
    {
        return 390;
    }
    
    function euro()
    {
        return 0.90;
    }

    function kr()
    {
        return 10;
    }




