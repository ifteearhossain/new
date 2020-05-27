<?php

namespace App\Http\Controllers;

use App\User;
use App\Withdraw;
use Illuminate\Http\Request;

class UserWalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolewallet');
    }

    public function index()
    {
        $users = User::latest()->get();
        $withdraws = Withdraw::latest()->get();
        return view('backend.adminwallet.index', compact('users', 'withdraws'));
    }

    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'user'   => 'required',
        ]);

        $user = User::findOrFail($request->user);
        $user->deposit($request->amount * 100);
        return back()->withSuccess('Money deposited into users wallet');
    }
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'user'   => 'required',
        ]);

        $user = User::findOrFail($request->user);
        $user->withdraw($request->amount * 100);
        return back()->withSuccess('Money withdrawn from users wallet');
    }

    public function transferdone($withdraw_id)
    {
        Withdraw::findOrFail($withdraw_id)->update([
            'transfer'  => 1,
        ]);
        return back()->withSuccess('Bank/Paypal transfer done');
    }


}
