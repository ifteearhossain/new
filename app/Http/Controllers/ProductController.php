<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use Image;
use App\Shop;
use App\User;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\ProductFee;
use App\SubCategory;
use Illuminate\Http\Request;
use App\ProductMultipleImage;
use App\Http\Requests\ProductRequests\ProductFormPost;
use App\Http\Requests\ProductRequests\ProductUpdateRequests;


class ProductController extends Controller
{ 
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('ifcustomer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->user_role == 2)
       {
           $products = Product::where('shop_id', Auth::user()->shop_id)->paginate(10);
           return view('backend.products.index', compact('products'));
       }
       else 
       {
        $products = Product::latest()->paginate(20); 
        return view('backend.products.index', compact('products'));
       }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(user_role() == 2)
        {
            $user = Auth::user();
            if($user->balanceFloat < 0.20)
            {
                return redirect('/deposit/ekowallet');
            }
            elseif($user->balanceFloat == 0)
            {
                return redirect('/deposit/ekowallet');
            }
            else
            {
                $categories = Category::OrderBy('category_name', 'asc')->get();
                $sub_categories = SubCategory::all();
                $shops = Shop::all();
                return view('backend.products.create', compact('categories', 'sub_categories', 'shops'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormPost $request)
    {
            $slug = Str::slug($request->product_name). '-' .Str::random(10);


            $product_id = Product::insertGetId([
                'product_name'              => $request->product_name,
                'product_price'             => $request->product_price,
                'discount_price'             => $request->discount_price,
                'product_brand'             => $request->product_brand,
                'category_id'               => $request->category_id,
                'sub_category_id'           => $request->sub_category_id,
                'product_quantity'          => $request->product_quantity,
                'shop_id'                   => $request->shop_id,
                'product_short_description' => $request->product_short_description,
                'product_long_description'  => $request->product_long_description,
                'product_thumbnail_image'   => 'default.jpg',
                'product_slug'              => $slug,
                'user_id'                   => Auth::id(),
                'created_at'                => Carbon::now()
            ]);
    
            $uploaded_image = $request->file('product_thumbnail_image');
            $file_name = $product_id. '.' .$uploaded_image->getClientOriginalExtension();
            $location = public_path('uploads/products/product_thumbnail_image/'.  $file_name);
            Image::make($uploaded_image)->resize(489, 489)->save($location);
    
            Product::find($product_id)->update([
                'product_thumbnail_image' => $file_name,
            ]);
    
            if($request->hasFile('product_multiple_image'))
            {
                $all_images = $request->file('product_multiple_image');
    
            $counter = 1;
            foreach($all_images as $single_image)
            {
                $filename = $product_id. '-' .$counter. '.' .$single_image->getClientOriginalExtension();
                $newlocation = public_path('uploads/products/product_multiple_image/' . $filename);
                Image::make($single_image)->resize(489, 489)->save($newlocation);
    
                ProductMultipleImage::insert([
                    'product_multiple_image' => $filename,
                    'product_id'             => $product_id,
                ]);
                $counter++;
            }
            }

             $user = Auth::user();
             $user->withdraw(20);

             ProductFee::insert([
                'amount'       => 0.20,
                'user_id'      => Auth::id(),
                'shop_id'      => Auth::user()->shop_id,
                'product_name' => $request->product_name,
                'created_at'   => Carbon::now(),
             ]);
    
            return redirect('products')->withSuccess('Products added successfully');
      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return view('backend.products.show')->with('product', $product);
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('view', $product);
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        $shops = Shop::all();
        return view('backend.products.create',compact('categories', 'sub_categories', 'shops'))->with('product', $product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequests $request, Product $product)
    {
        if($request->hasFile('product_thumbnail_image'))
        {
            $oldlocation = public_path('uploads/products/product_thumbnail_image/' . $product->product_thumbnail_image);
            unlink($oldlocation);
            $uploaded_image = $request->file('product_thumbnail_image');
            $file_name = $product->id. '.' .$uploaded_image->getClientOriginalExtension();
            $location = public_path('uploads/products/product_thumbnail_image/' . $file_name);
            Image::make($uploaded_image)->resize(300, 300)->save($location);

            $product->product_thumbnail_image = $file_name;
        }


        if($request->hasFile('product_multiple_image'))
        {
          foreach($product->getmultipleimage as $delete)
            {
                $oldlocation = public_path('uploads/products/product_multiple_image/' .$delete->product_multiple_image);
                unlink($oldlocation);
                ProductMultipleImage::where('product_id', $product->id)->delete();
            }

          $all_images = $request->file('product_multiple_image');
          $counter = 1; 
          foreach($all_images as $key => $single_image)
          {
              $file_name = $product->id. '-' .$counter. '.' .$single_image->extension();
              $location = public_path('uploads/products/product_multiple_image/' .$file_name);
              Image::make($single_image)->save($location);
              $counter++;
              ProductMultipleImage::insert([
                'product_multiple_image' => $file_name,
                'product_id'             => $product->id,
              ]);

          }
        }
        
            $product->product_name                  = $request->product_name;
            $product->product_price                 = $request->product_price;
            $product->discount_price                = $request->discount_price;
            $product->product_brand                 = $request->product_brand;
            $product->category_id                   = $request->category_id;
            $product->sub_category_id               = $request->sub_category_id;
            $product->product_quantity              = $request->product_quantity;
            $product->shop_id                       = $request->shop_id;
            $product->product_short_description     = $request->product_short_description;
            $product->product_long_description      = $request->product_long_description;
            $product->save();
  
            return redirect('products')->withSuccess('Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('view', $product);
       $oldlocation = public_path('uploads/products/product_thumbnail_image/' . $product->product_thumbnail_image);
       unlink($oldlocation);

       foreach($product->getmultipleimage as $delete)
       {
           $oldlocation = public_path('uploads/products/product_multiple_image/' .$delete->product_multiple_image);
           unlink($oldlocation);
           ProductMultipleImage::where('product_id', $product->id)->delete();
       }

       $product->delete();
       return back()->withFailed('Product deleted');
    }

    public function getsubcategory(Request $request)
    {
      $subcategories =  SubCategory::where('category_id', $request->category)->get();

        $dropdown = "";

        foreach($subcategories as $subcategory)
        {
            $dropdown .=  "<option value='".$subcategory->id."'>".$subcategory->sub_category_name."</option>";
        }

        echo $dropdown;
    }

    // END
}
