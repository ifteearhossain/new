<?php

namespace App\Http\Requests\OrderRequests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing_fullname'   =>   'required',
            'billing_email'      =>   'required',
            'country_id'         =>   'required',
            'state_id'           =>   'required',
            'areacode'           =>   'required',
            'phone_number'       =>   'required|numeric',
            'address'            =>   'required',
            'billing_zipcode'    =>   'required|numeric',
        ];
    }
}
