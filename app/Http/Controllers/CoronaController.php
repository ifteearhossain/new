<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoronaController extends Controller
{
    public function index()
    {
        return view('frontend.corona-update');
    }
}
