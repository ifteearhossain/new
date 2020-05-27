<?php

namespace App\Http\Requests\ShopRequests;

use Illuminate\Foundation\Http\FormRequest;

class ShopFormRequest extends FormRequest
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
            'shop_name'                => 'required',
            'shop_short_description'   => 'required',    
            'shop_address'             => 'required',
            'shop_phone_number'        => 'required|numeric',
            'shop_logo'                => 'required|mimes:png,jpeg,jpg',
            'shop_cover_image'         => 'required|mimes:png,jpeg,jpg',
            'shop_registration_number' => 'required',
            'shop_license'             => 'required|mimes:pdf|max:10000',
            'bank_name'                => 'required',
            'bank_account_number'      => 'required',
        ];
    }
}
