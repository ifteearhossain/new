<?php

namespace App\Http\Controllers;

use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function deposit()
    {
        return view('backend.ekowallet.deposit');
    }

    public function depositPost(Request $request)
    {
        return view('frontend.stripe', [
            'deposit_amount' => $request->deposit_amount * 100
        ]);
    }
  
    public function transaction()
    {
        return view('backend.ekowallet.transactions',[
            'transactions' => Auth::user()->transactions
        ]);
    }

    public function withdraw()
    {
        if(user_role() == 3)
        {
            return back()->withErrors('Only sellers can withdraw balance from Ekowallet');
        }
        else 
        {
            return view('backend.ekowallet.withdraw');
        }
    }

    public function withdrawPost(Request $request)
    {
       $user = Auth::user();
       if($user->balanceFloat == 0)
       {
           return back()->withErrors('You have zero balance in your wallet. Please try again.');
       }
       elseif($user->balance < $request->withdraw_amount * 100)
       {
           return back()->withErrors('Insufficient funds in your wallet.Please try again');
       }
       else 
       {
        $request->validate([
            'withdraw_amount' => 'required',
        ]);
            
        $user->withdraw($request->withdraw_amount * 100);
        Withdraw::create([
            'user_id' => Auth::id(),
            'withdraw_amount' => $request->withdraw_amount,
            'method'          => $request->method,
            'created_at'      => Carbon::now(),
        ]);


        return back()->withSuccess('The amount has been withdrawn and you will receive in your banking account within 3-5 working days.');

       }
    }
  // END  
}
