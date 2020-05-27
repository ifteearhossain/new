<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Mail;
use Image;
use App\City;
use App\Shop;
use App\User;
use App\Order;
use App\State;
use App\Country;
use App\Product;
use App\Complain;
use Carbon\Carbon;
use App\Order_list;
use App\Charts\UserChart;
use App\Charts\ProductChart;
use Illuminate\Http\Request;
use App\ProductMultipleImage;
use Nexmo\Laravel\Facade\Nexmo;
use App\Charts\SevenDaysSaleChart;
use App\Mail\ChangePasswordMailer;
use App\Http\Requests\ChangePassword\ChangePasswordRequests;
use App\Http\Requests\ProfileRequests\ProfileUpdateRequests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole')->except(['profileedit', 'profileupdate', 'userprofile', 'makeadmin', 'deleteuser', 'changepassword', 'passwordchanged', 'payseller']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // User Chart 
        $chart = new UserChart;
        
        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        
        $chart = new UserChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Users', 'pie', [$users_2_days_ago, $yesterday_users, $today_users])->options([
            'backgroundColor' => [
                'red',
                '#5B93D3',
                '#FCB800',
            ],
        ]);
  
        // User Chart ends 
        
        // Product Chart Last 7 days 

        for ($i=1; $i <= 7 ; $i++) { 
            
            $date[] = Carbon::now()->subDays(7-$i)->format('d-M');
            $products[] = Product::whereDate('created_at', Carbon::now()->subdays(7-$i)->format('Y-m-d'))->count();

        }

        $product_chart = new ProductChart;
        $product_chart->labels($date);
        $product_chart->dataset('Total Products', 'bar', $products)->options([
            'backgroundColor' => [
                '#fc8210',
                'red',
                '#00263b',
                '#FCB800',
                '#5B93D3',
                '#fab7b7',
                '#6a097d',

            ],
        ]);
  

        // Product Chart Last 7 days ends 

     

        // Total Sale Chart Last 7 days Starts
        
        for ($i=1; $i <= 7 ; $i++) { 
            
            $dates[] = Carbon::now()->subDays(7-$i)->format('d-M');
            $sales[] = Order::whereDate('created_at', Carbon::now()->subDays(7-$i)->format('Y-m-d'))->sum('total');

        }

        $seven_days_sale = new SevenDaysSaleChart;
        $seven_days_sale->labels($dates);
        $seven_days_sale->dataset('Total Sales', 'line', $sales)->options([
            'backgroundColor' => [
                '#FCB800'

            ],
        ]);
        
        // Total Sale Chart Last 7 days Ends 

        $users = User::where('user_role', '!=', 0)->latest()->paginate(10);
        $salesFromShops = Order_list::latest()->get();
        $complains = Complain::latest()->paginate(5);
        return view('home', compact('users','chart', 'product_chart', 'seven_days_sale', 'salesFromShops', 'complains'));
    }

    public function profileedit()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('profile.update',compact('countries', 'states', 'cities'));
    }
    public function profileupdate(ProfileUpdateRequests $request)
    {
         if($request->hasFile('profile_picture'))
         {
             if(Auth::user()->profile_picture != 'default_profile_picture.jpg')
             {
                $existing_image = public_path('uploads/users/'. Auth::user()->profile_picture);
                unlink($existing_image);
             }
             $uploaded_image = $request->file('profile_picture');
             $filename = Auth::id(). '.' .$uploaded_image->extension();
             $location = public_path('uploads/users/' . $filename);
             Image::make($uploaded_image)->save($location);

             User::findOrFail(Auth::id())->update([
                 'profile_picture' => $filename,
             ]);
         }

          User::find(Auth::id())->update([

         'name'             => $request->name,
         'email'            => $request->email,
         'areacode'         => $request->areacode,
         'phone_number'     => $request->phone_number,
         'country_id'       => $request->country_id,
         'state_id'         => $request->state_id,
         'city_id'          => $request->city_id,
         'address'          => $request->address,
         'zip_code'         => $request->zip_code,

          ]);
         

         return back()->withSuccess('Profile Updated Successfully');
         
    }

    public function changepassword ()
    {
       return view('profile.changepassword');
    }

    public function passwordchanged(ChangePasswordRequests $request)
    {
       $db_password = Auth::user()->password;

       if($request->old_password != $request->password)
       {
        if(Hash::check($request->old_password, $db_password))
        {
            User::findOrFail(Auth::id())->update([
                'password' => Hash::make($request->password)
            ]);

            Mail::to(Auth::user()->email)->send(new ChangePasswordMailer());

            return back()->withSuccess('Your Password has been changed');
        }
        else
        {
            return back()->withFailed('You have entered an incorrect password');    
        }
       }
       else
       {
        return back()->withFailed('Old Password and New Password cannot be same. Please try again');
       }
    }

    
    public function userprofile($user_id)   
    {
        $user = User::findOrFail($user_id);
        return view('backend.profile.users', compact('user'));
    }

    public function makeadmin($user_id)
    {
        User::findOrFail($user_id)->update([
            'user_role' => 1, 
        ]);
        return back()->withSuccess('User Promoted to Admin');
    }
    public function deleteuser($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if($user->shop_id == 0)
        {
            User::findOrFail($user_id)->delete();
            return back()->withFailed('User deleted');
        }
        else 
        {
             $shop = Shop::where('id', $user->shop_id)->first();
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
            Shop::where('id', $user->shop_id)->delete();
            User::findOrFail($user_id)->delete();
            return back()->withFailed('User deleted');
        }
    }

    public function payseller(Request $request)
    {
       $user = User::findOrFail($request->user_id);
       $user->deposit($request->total * 100);
       Order_list::where('order_id', $request->order_id)->update([
        'paid_seller' => 1,
       ]);

       Nexmo::message()->send([
        'to'   =>  $user->areacode.$user->phone_number ,
        'from' => 'Ekomalls',
        'text' => 'Your Payment $'. $request->total .' for Order number #'.$request->order_id.' has been processed.Thank you for selling with Ekomalls',
     ]);
    
       return back()->withSuccess('Seller wallet has been debited');
    }


    // END
}













