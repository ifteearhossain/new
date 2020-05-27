<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequests\SubscriptionPostRequest;
use Carbon\Carbon;
use App\Mail\SubscriptionMailer;
use Mail;

class SubscriptionController extends Controller
{
    public function subscribe(SubscriptionPostRequest $request)
    {
        Subscription::insert([
            'email'      => $request->email,
            'ip_address' => $request->ip(),
            'no-show'    => 1,
            'created_at' => Carbon::now(),
        ]);
        
        $email = $request->email;
        Mail::to($request->email)->send(new SubscriptionMailer($email));
        
        return back();
    }
}
