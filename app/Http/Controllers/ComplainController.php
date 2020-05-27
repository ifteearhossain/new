<?php

namespace App\Http\Controllers;

use App\Complain;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
   public function index(Request $request)
   {

       Complain::insert($request->except('_token') + ['created_at' => Carbon::now(), 'user_id' => Auth::id()]);

       return redirect('/')->withSuccess('Complain has been placed. Our support agent will get in touch with you as soon as possible');
   }
   public function show($complain_id)
   {
       Complain::findOrFail($complain_id)->update([
          'status' => 1,
       ]);

       $complain = Complain::findOrFail($complain_id);
       return view('backend.complain.view', compact('complain'));
   }
}
