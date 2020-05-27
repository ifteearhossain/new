<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Country;

class AjaxController extends Controller
{
    public function getstate(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        $dropdown = ""; 

        foreach ($states as $state) {
            $dropdown .= "<option value='".$state->id."'>".$state->name."</option>";
        }

          echo $dropdown;

    }
    public function getcode(Request $request)
    {
        $country = Country::where('id', $request->country_id)->first();
        $areacode = "<option value='".$country->phonecode."'>+".$country->phonecode."</option>";
        echo $areacode;
    }

    public function getcity(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        $dropdown = ""; 

        foreach ($cities as $city) {
            $dropdown .= "<option value='".$city->id."'>".$city->name."</option>";

          

        }
        echo $dropdown;
    }

}
