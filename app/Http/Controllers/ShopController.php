<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Image;
use App\Shop;
use App\User;
use App\Country;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ProductMultipleImage;
use App\Mail\ShopApproveMailer;
use App\Mail\ShopRequestMailer;
use Nexmo\Laravel\Facade\Nexmo;
use App\Http\Requests\ShopRequests\ShopFormRequest;
use App\Http\Requests\ShopRequests\ShopUpdateRequests;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->user_role == 0 || Auth::user()->user_role == 1)
       {
             $shops = Shop::latest()->paginate(20);
             return view('backend.shops.index', compact('shops'));
       }
       elseif(Auth::user()->shop_id != 0) 
       {
         $shops = Shop::where('id', Auth::user()->shop_id)->where('is_active', 'active')->paginate(20);
         return view('backend.shops.index', compact('shops'));
       }

       else 
       {
          if(Auth::user()->phone_verified_at != null)
          {
            return view('backend.shops.customer');
          }
          else 
          {
            return redirect('/customer')->withErrors('Please Verify your phone number in order to become a vendor with ekomalls');
          }
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop)
    {
        $this->authorize('create', $shop);
 
       if(Auth::user()->phone_verified_at != null)
       {
        return view('backend.shops.create');
       }
       else 
       {
           $countries = Country::all();
           return view('frontend.verifyNumber', compact('countries'));
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopFormRequest $request)
    {
      
        if(Auth::user()->phone_verified_at != null)
        {

        $after_create =  Shop::create($request->except('_token')+ ['user_id' => Auth::id(), 'created_at' => Carbon::now()]);
        
        $uploaded_image = $request->file('shop_logo');
        $filename = $after_create->shop_name. '_logo.' .$uploaded_image->extension();
        $location = public_path('uploads/shops/logo/'. $filename);
        Image::make($uploaded_image)->save($location, 100);
        
        $cover_image = $request->file('shop_cover_image');
        $file_name = $after_create->shop_name. '_cover_img.' .$cover_image->getClientOriginalExtension();
        $new_location = public_path('uploads/shops/cover/'. $file_name);
        Image::make($cover_image)->save($new_location, 100); 
        
        $shop_license = $request->file('shop_license');
        $file_name_shop = $after_create->shop_name. '_license_doc.' .$shop_license->extension();
        $new_loc = public_path('uploads/shops/documents/');
        $shop_license->move($new_loc, $file_name_shop);

        Shop::findOrFail($after_create->id)->update([
            'shop_logo'        => $filename,
            'shop_cover_image' => $file_name,
            'shop_license'     => $file_name_shop,
        ]);

        User::findOrFail(Auth::id())->update([
            'shop_id' => $after_create->id,
        ]);

        $superadmin = User::where('user_role', 0)->get();
        $admin = User::where('user_role', 1)->get();
        foreach($superadmin as $superad)
        {
            Mail::to($superad->email)->send(new ShopRequestMailer());
        }
        foreach($admin as $ad)
        {
            Mail::to($ad->email)->send(new ShopRequestMailer());
        }

        return redirect('/shops')->withSuccess('Shop is under review, You will be notified through email upon approval');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $this->authorize('view', $shop);
        return view('backend.shops.show')->with('shop', $shop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
      $this->authorize('update', $shop);
      return view('backend.shops.create')->with('shop', $shop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopUpdateRequests $request, Shop $shop)
    {
        if($request->hasFile('shop_logo'))
        {
            $oldlocation = public_path('uploads/shops/logo/' . $shop->shop_logo);
            unlink($oldlocation);
            $uploaded_image = $request->file('shop_logo');
            $file_name = $shop->shop_name. '_logo.' .$uploaded_image->extension();
            $location = public_path('uploads/shops/logo/' . $file_name);
            Image::make($uploaded_image)->save($location);

            $shop->shop_logo = $file_name;
        }
        if($request->hasFile('shop_cover_image'))
        {
            $oldlocation = public_path('uploads/shops/cover/' . $shop->shop_cover_image);
            unlink($oldlocation);
            $uploaded_image = $request->file('shop_cover_image');
            $file_name = $shop->shop_name. '_cover_img.' .$uploaded_image->getClientOriginalExtension();
            $location = public_path('uploads/shops/cover/' . $file_name);
            Image::make($uploaded_image)->save($location);

            $shop->shop_cover_image = $file_name;
        }
        if($request->hasFile('shop_license'))
        {
            $oldlocation = public_path('uploads/shops/documents/' . $shop->shop_license);
            unlink($oldlocation);
            $shop_license = $request->file('shop_license');
            $file_name_shop = $shop->shop_name. '_license_doc.' .$shop_license->extension();
            $new_loc = public_path('uploads/shops/documents/');
            $shop_license->move($new_loc, $file_name_shop);

            $shop->shop_cover_image = $file_name;
        }

          $shop->shop_name = $request->shop_name; 
          $shop->shop_short_description = $request->shop_short_description; 
          $shop->shop_long_description = $request->shop_long_description; 
          $shop->shop_address = $request->shop_address;
          $shop->areacode = $request->areacode;
          $shop->shop_phone_number = $request->shop_phone_number;
          $shop->shop_registration_number = $request->shop_registration_number;
          $shop->bank_name = $request->bank_name;
          $shop->bank_account_number = $request->bank_account_number;
          $shop->paypal_account_number = $request->paypal_account_number;
          $shop->save();

          return redirect('/shops')->withSuccess('Shop Details Updated');

    }

    public function approve($id)
    {    
        Shop::findOrFail($id)->update([
            'is_active' => 'active'
        ]);

       $user_id = Shop::where('id', $id)->first();

       if(User::where('id', $user_id->user_id)->first()->user_role == 0)
       {
        return back()->withSuccess('Shop is approved and now visible to the store owner');
       }
       User::findOrFail($user_id->user_id)->update([
        'user_role' => 2,
      ]);
      $shop_details = Shop::where('id', $id)->first();
      Mail::to(User::find($shop_details->user_id)->email)->send(new ShopApproveMailer($shop_details));

    
      Nexmo::message()->send([
        'to'   =>  $shop_details->areacode.$shop_details->shop_phone_number,
        'from' => 'Ekomalls',
        'text' => 'Your shop is now approved Thank you for selling with Ekomalls',
      ]);

      return back()->withSuccess('Shop is approved and now visible to the store owner');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
      if($shop->getproduct->count() >= 1)
      {
          foreach($shop->getproduct as $single_product)
          {
            $oldlocation = public_path('uploads/products/product_thumbnail_image/' . $single_product->product_thumbnail_image);
            unlink($oldlocation);
            foreach($single_product->getmultipleimage as $multi_delete)
            {
                $oldlocation = public_path('uploads/products/product_multiple_image/' .$multi_delete->product_multiple_image);
                unlink($oldlocation);
                ProductMultipleImage::where('product_id', $multi_delete->id)->delete();
            }
            Product::find($single_product->id)->delete();
          }
      }
       User::find($shop->user_id)->update([
         'user_role' => 3,
         'shop_id'   => 0,
       ]);
       $shop->delete();
       return back()->withFailed('Shop Deleted');
    }


    // END
}
