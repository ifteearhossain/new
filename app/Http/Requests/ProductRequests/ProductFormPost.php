<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormPost extends FormRequest
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
            'product_name'                   => 'required',
            'product_price'                  => 'numeric',
            'category_id'                    => 'required',
            'sub_category_id'                => 'required',
            'product_quantity'               => 'required|numeric',
            'product_short_description'      => 'required',
            'product_long_description'       => 'required',
            'product_thumbnail_image'        => 'required|mimes:jpeg,jpg,png',
            'product_multiple_image.*'       => 'mimes:jpg,jpeg,png',
            'product_multiple_image'         => 'required',

        ];
    }
}
