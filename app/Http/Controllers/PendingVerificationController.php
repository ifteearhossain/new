<?php

namespace App\Http\Controllers;

use App\PhoneVerify;
use Illuminate\Http\Request;

class PendingVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolepending');
    }

    public function index()
    {
        $verifies = PhoneVerify::all();
        return view('backend.pendingVerification.index', compact('verifies'));
    }
}
