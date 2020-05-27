<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Product;
use App\Complain;
use Carbon\Carbon;
use App\Order_list;
use App\Charts\UserChart;
use App\Charts\ProductChart;
use Illuminate\Http\Request;
use App\Charts\SevenDaysSaleChart;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admincheck');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            $sales[] = Order::whereDate('created_at', Carbon::now()->subdays(7-$i)->format('Y-m-d'))->sum('total');

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
        $orders = Order::where('user_id', Auth::id())->get();
        $salesFromShops = Order_list::latest()->get();
        $complains    = Complain::latest()->paginate(5);
        return view('admin.index', compact('users','chart', 'product_chart', 'orders', 'seven_days_sale', 'salesFromShops', 'complains'));
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
        //
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
        //
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
}
