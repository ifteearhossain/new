<?php

namespace App\Http\Controllers;

use App\Faq;
use App\User;
use App\About;
use App\Policy;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FrontendController extends Controller
{
    public function index()
    {
        
        return view('frontend.index', [

         'categories'          => Category::orderBy('category_name')->get(),
         'productsElectronics' => Product::where('category_id', 3)->get(), 
         'productsMens'        => Product::where('category_id', 1)->get(), 
         'productsWomens'      => Product::where('category_id', 12)->get(),
         'productsSports'      => Product::where('category_id', 8)->get(),
         'discountProducts'    => Product::whereNotNull('discount_price')->latest()->get(), 
         'products'            => Product::latest()->limit(8)->get(),

        ]);
    }

    public function search()
    {
        $filtered_products = QueryBuilder::for(Product::class)
                                ->allowedFilters(['product_name', 'category_id'])
                                ->simplePaginate(12);

        return view('frontend.search_from_products', compact('filtered_products'));
    }

    public function about()
    {
        $about = About::first();
        $totalProducts   = Product::count();
        $totalSellers    = User::where('user_role', 2)->count(); 
        $totalCustomers  = User::where('user_role', 3)->count(); 
        return view('frontend.about', compact('about', 'totalProducts', 'totalSellers', 'totalCustomers'));
    }

    public function faq()
    {
        $faqs = Faq::latest()->get();
        return view('frontend.faq', compact('faqs'));
    }

    public function policy()
    {
        $policies = Policy::all();
        return view('frontend.policy', compact('policies'));
    }


    // END
}
