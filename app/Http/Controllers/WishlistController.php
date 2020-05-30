<?php

namespace App\Http\Controllers;

use App\Product;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::all();
        return view('frontend.wishlist', compact('wishlists'));
    }

    public function addwish($product_id)
    {
       if(!Wishlist::where('ip_address', request()->ip())->where('product_id', $product_id)->exists())
       {
        Wishlist::insert([
            'ip_address' => request()->ip(),
            'product_id' => $product_id,
            'created_at' => Carbon::now(),
           ]);
        return back()->withSuccess('Product added to wishlist');
       }
       else 
       {
           return back()->withSuccess('Product already exists in your wishlist');
       }
    }

    public function removewish($id)
    {
        Wishlist::findOrFail($id)->delete();
        return back()->withFailed('Product removed from wishlist');
    }
}
