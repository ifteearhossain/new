<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Product;
use Illuminate\Http\Request;

class VendorController extends Controller
{
   public function index()
   {
       return view('frontend.vendors');
   }

   public function storelist()
   {
       $stores =Shop::where('is_active', 'active')->orderBy('id', 'desc')->simplePaginate(4);
       return view('frontend.storelist', compact('stores'));
   }
   public function storeoldtonew()
   {
       $stores =Shop::where('is_active', 'active')->orderBy('id', 'asc')->simplePaginate(4);
       return view('frontend.storelist', compact('stores'));
   }

   public function show($store_name)
   {
       $store = Shop::where('shop_name', $store_name)->first();
       return view('frontend.singleStore', compact('store'));
   }
   public function about($store_name)
   {
       $store = Shop::where('shop_name', $store_name)->first();
       return view('frontend.singleStoreAbout', compact('store'));
   }

   public function storesearch($store_name)
   {
      $store = Shop::where('shop_name', $store_name)->first();
      $products = Product::where('shop_id', $store->id)->where('product_name', 'LIKE', '%'.request('product_name').'%')->get();
      return view('frontend.searchStore', compact('store', 'products'));
   }



}
