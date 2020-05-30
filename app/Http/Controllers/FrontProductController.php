<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Order_list;
use App\SubCategory;
use App\BannerProductBig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontProductController extends Controller
{
    public function index()
    {
        $all_products = Product::simplePaginate(12);
        $total_products = Product::all()->count();
        $categories = Category::latest()->limit(8)->get();
        $recommended_products = Product::whereNotNull('discount_price')->get();
        // $bestsellers = Order_list::with('get_product_info_via_order_list')->groupBy('id')->orderBy('product_id', 'desc')->get();
        $bestsellers = Order_list::with('get_product_info_via_order_list')
                    ->select('product_id', DB::raw('count(*) as total'))
                    ->groupBy('product_id')
                    ->orderBy('total', 'desc')
                    ->take(10)
                    ->get();
        $banners = BannerProductBig::latest()->get();
        return view('frontend.products', compact('all_products', 'categories', 'recommended_products','total_products', 'bestsellers', 'banners'));
    }
    public function indexAtoZ()
    {
        $all_products = Product::orderBy('product_name', 'asc')->simplePaginate(12);
        $total_products = Product::all()->count();
        $categories = Category::latest()->limit(8)->get();
        $recommended_products = Product::whereNotNull('discount_price')->get();
        return view('frontend.products', compact('all_products', 'categories', 'recommended_products','total_products'));
    }
    public function indexZtoA()
    {
        $all_products = Product::orderBy('product_name', 'desc')->simplePaginate(12);
        $total_products = Product::all()->count();
        $categories = Category::latest()->limit(8)->get();
        $recommended_products = Product::whereNotNull('discount_price')->get();
        return view('frontend.products', compact('all_products', 'categories', 'recommended_products','total_products'));
    }

    public function byCategory($category_id)
    {
        $all_products = Product::where('category_id', $category_id)->simplePaginate(12);
        $total_products = Product::where('category_id', $category_id)->count();
        $categories = Category::latest()->limit(8)->get();
        $category_name = Category::findOrFail($category_id)->category_name;
        $recommended_products = Product::whereNotNull('discount_price')->get();
        return view('frontend.products', compact('all_products','categories', 'recommended_products', 'total_products','category_name'));
    }
    public function bySubCategory($sub_category_id)
    {
        $all_products = Product::where('sub_category_id', $sub_category_id)->simplePaginate(12);
        $total_products = Product::where('sub_category_id', $sub_category_id)->count();
        $categories = Category::latest()->limit(8)->get();
        $sub_category_name = SubCategory::findOrFail($sub_category_id)->sub_category_name;
        $recommended_products = Product::whereNotNull('discount_price')->get();
        return view('frontend.products', compact('all_products','categories', 'recommended_products', 'total_products','sub_category_name'));
    }

    public function filter()
    {
       if(isset(request()->product_name))
       {
        $product_name = request()->product_name;
       }
       else 
       {
        $product_name = "";
       }
       if(isset(request()->product_brand))
       {
        $product_brand = request()->product_brand;
       }
       else 
       {
        $product_brand = "";
       }

        $min_price     = request()->min_price; 
        $max_price     = request()->max_price;


       if($product_name && $product_brand && $min_price && $max_price)
       {
           $filtered_products = Product::where('product_name', 'LIKE', '%'.$product_name.'%')
                                       ->where('product_brand', $product_brand)
                                       ->whereBetween('product_price', [$min_price, $max_price])
                                       ->orderBy('product_price', 'desc')
                                       ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($product_name && $product_brand)
       {
        $filtered_products = Product::where('product_name', 'LIKE', '%'.$product_name.'%')
                                    ->where('product_brand', $product_brand)
                                    ->orderBy('product_price', 'desc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }

       
       elseif($product_name && $min_price && $max_price)
       {
           $filtered_products = Product::where('product_name', 'LIKE', '%'.$product_name.'%')
           ->whereBetween('product_price', [$min_price, $max_price])
           ->orderBy('product_price', 'asc')
           ->simplePaginate(12);
           return view('frontend.search_from_products', compact('filtered_products'));
        }
        elseif($product_brand && $min_price && $max_price)

       {
        $filtered_products = Product::where('product_brand', $product_brand)
                                    ->whereBetween('product_price', [$min_price, $max_price])
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($min_price && $max_price)
       {
        $filtered_products = Product::whereBetween('product_price', [$min_price, $max_price])
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($product_name)
       {
        $filtered_products = Product::where('product_name', 'LIKE', '%'.$product_name.'%')
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($product_brand)
       {
        $filtered_products = Product::where('product_brand', $product_brand)
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($min_price)
       {
        $filtered_products = Product::whereBetween('product_price', [$min_price, '100000'])
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }
       elseif($max_price)
       {
        $filtered_products = Product::whereBetween('product_price', ['0', $max_price])
                                    ->orderBy('product_price', 'asc')
                                    ->simplePaginate(12);
                return view('frontend.search_from_products', compact('filtered_products'));
       }          
    } 

    public function productdetails($slug)
    {
        $product = Product::where('product_slug', $slug)->first();
        $sameBrand = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        return view('frontend.product_details', compact('product','sameBrand'));
    }

  // END  
}
